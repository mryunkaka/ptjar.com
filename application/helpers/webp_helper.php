<?php

if (!function_exists('webp_read_uint16')) {
    function webp_read_uint16($value, $littleEndian)
    {
        $parts = unpack($littleEndian ? 'vvalue' : 'nvalue', $value);
        return isset($parts['value']) ? (int) $parts['value'] : 0;
    }
}

if (!function_exists('webp_read_uint32')) {
    function webp_read_uint32($value, $littleEndian)
    {
        $parts = unpack($littleEndian ? 'Vvalue' : 'Nvalue', $value);
        return isset($parts['value']) ? (int) $parts['value'] : 0;
    }
}

if (!function_exists('webp_jpeg_orientation')) {
    function webp_jpeg_orientation($path)
    {
        $handle = @fopen($path, 'rb');
        if ($handle === false) {
            return 1;
        }

        if (fread($handle, 2) !== "\xFF\xD8") {
            fclose($handle);
            return 1;
        }

        while (!feof($handle)) {
            $byte = fread($handle, 1);
            if ($byte === '' || ord($byte) !== 0xFF) {
                continue;
            }

            do {
                $byte = fread($handle, 1);
            } while ($byte !== '' && ord($byte) === 0xFF);

            if ($byte === '') {
                break;
            }

            $marker = ord($byte);
            if ($marker === 0xDA || $marker === 0xD9) {
                break;
            }
            if ($marker === 0x01 || ($marker >= 0xD0 && $marker <= 0xD7)) {
                continue;
            }

            $lengthBytes = fread($handle, 2);
            if (strlen($lengthBytes) !== 2) {
                break;
            }
            $length = webp_read_uint16($lengthBytes, false);
            if ($length < 2) {
                break;
            }

            if ($marker !== 0xE1) {
                fseek($handle, $length - 2, SEEK_CUR);
                continue;
            }

            $segment = fread($handle, $length - 2);
            if (substr($segment, 0, 6) !== "Exif\0\0") {
                continue;
            }

            $tiff = substr($segment, 6);
            $byteOrder = substr($tiff, 0, 2);
            if ($byteOrder !== 'II' && $byteOrder !== 'MM') {
                continue;
            }

            $littleEndian = $byteOrder === 'II';
            if (webp_read_uint16(substr($tiff, 2, 2), $littleEndian) !== 42) {
                continue;
            }

            $ifdOffset = webp_read_uint32(substr($tiff, 4, 4), $littleEndian);
            $entryCount = webp_read_uint16(substr($tiff, $ifdOffset, 2), $littleEndian);
            for ($index = 0; $index < $entryCount; $index++) {
                $entryOffset = $ifdOffset + 2 + ($index * 12);
                $entry = substr($tiff, $entryOffset, 12);
                if (strlen($entry) !== 12 || webp_read_uint16(substr($entry, 0, 2), $littleEndian) !== 0x0112) {
                    continue;
                }

                if (webp_read_uint16(substr($entry, 2, 2), $littleEndian) === 3
                    && webp_read_uint32(substr($entry, 4, 4), $littleEndian) >= 1) {
                    $orientation = webp_read_uint16(substr($entry, 8, 2), $littleEndian);
                    fclose($handle);
                    return ($orientation >= 1 && $orientation <= 8) ? $orientation : 1;
                }
            }
        }

        fclose($handle);
        return 1;
    }
}

if (!function_exists('webp_apply_jpeg_orientation')) {
    function webp_apply_jpeg_orientation($image, $path)
    {
        switch (webp_jpeg_orientation($path)) {
            case 2:
                imageflip($image, IMG_FLIP_HORIZONTAL);
                break;
            case 3:
                $image = imagerotate($image, 180, 0);
                break;
            case 4:
                imageflip($image, IMG_FLIP_VERTICAL);
                break;
            case 5:
                $image = imagerotate($image, -90, 0);
                imageflip($image, IMG_FLIP_HORIZONTAL);
                break;
            case 6:
                $image = imagerotate($image, -90, 0);
                break;
            case 7:
                $image = imagerotate($image, 90, 0);
                imageflip($image, IMG_FLIP_HORIZONTAL);
                break;
            case 8:
                $image = imagerotate($image, 90, 0);
                break;
        }

        return $image;
    }
}

if (!function_exists('create_webp_sidecar')) {
    function create_webp_sidecar($sourcePath, $quality = 82)
    {
        if (!function_exists('imagewebp') || !is_file($sourcePath)) {
            return false;
        }

        $extension = strtolower(pathinfo($sourcePath, PATHINFO_EXTENSION));
        if ($extension !== 'jpg' && $extension !== 'jpeg' && $extension !== 'png') {
            return false;
        }

        $targetPath = $sourcePath . '.webp';
        if (is_file($targetPath)) {
            return true;
        }

        $image = $extension === 'png'
            ? @imagecreatefrompng($sourcePath)
            : @imagecreatefromjpeg($sourcePath);
        if ($image === false) {
            return false;
        }

        if ($extension === 'png') {
            if (!imageistruecolor($image)) {
                imagepalettetotruecolor($image);
            }
            imagealphablending($image, false);
            imagesavealpha($image, true);
        } else {
            $image = webp_apply_jpeg_orientation($image, $sourcePath);
        }

        $temporaryPath = $targetPath . '.tmp-' . getmypid();
        $ok = @imagewebp($image, $temporaryPath, max(50, min(95, (int) $quality)));
        imagedestroy($image);

        clearstatcache(true, $temporaryPath);
        if (!$ok || !is_file($temporaryPath)) {
            @unlink($temporaryPath);
            return false;
        }

        if (filesize($temporaryPath) >= filesize($sourcePath)) {
            @unlink($temporaryPath);
            return false;
        }

        if (!@rename($temporaryPath, $targetPath)) {
            @unlink($temporaryPath);
            return false;
        }

        return true;
    }
}

if (!function_exists('webp_sidecar_url')) {
    function webp_sidecar_url($url)
    {
        $url = (string) $url;
        $parts = parse_url($url);
        if (!is_array($parts) || empty($parts['path'])) {
            return '';
        }

        $path = $parts['path'];
        if (!preg_match('/\.(?:jpe?g|png)$/i', $path)) {
            return '';
        }

        $urlHost = isset($parts['host']) ? strtolower($parts['host']) : '';
        $baseParts = parse_url(base_url());
        $baseHost = is_array($baseParts) && isset($baseParts['host']) ? strtolower($baseParts['host']) : '';
        if ($urlHost !== '' && $baseHost !== '' && $urlHost !== $baseHost) {
            return '';
        }

        $basePath = is_array($baseParts) && isset($baseParts['path']) ? rawurldecode($baseParts['path']) : '/';
        $diskPath = rawurldecode($path);
        if ($basePath !== '/' && strpos($diskPath, $basePath) === 0) {
            $diskPath = substr($diskPath, strlen($basePath));
        }

        $diskPath = rtrim(FCPATH, '/\\') . DIRECTORY_SEPARATOR
            . str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, ltrim($diskPath, '/\\')) . '.webp';
        if (!is_file($diskPath)) {
            return '';
        }

        $suffixPosition = strcspn($url, '?#');
        return substr($url, 0, $suffixPosition) . '.webp' . substr($url, $suffixPosition);
    }
}

if (!function_exists('webp_picture_tag')) {
    function webp_picture_tag($url, $alt = '', $attributes = array())
    {
        $escapedUrl = htmlspecialchars((string) $url, ENT_QUOTES, 'UTF-8');
        $escapedAlt = htmlspecialchars((string) $alt, ENT_QUOTES, 'UTF-8');
        $sidecarUrl = webp_sidecar_url($url);
        $html = '<picture style="display:contents">';

        if ($sidecarUrl !== '') {
            $html .= '<source srcset="' . htmlspecialchars($sidecarUrl, ENT_QUOTES, 'UTF-8') . '" type="image/webp">';
        }

        $html .= '<img src="' . $escapedUrl . '" alt="' . $escapedAlt . '"';
        foreach ((array) $attributes as $name => $value) {
            if (!preg_match('/^[a-zA-Z_:][a-zA-Z0-9:_.-]*$/', (string) $name) || is_array($value) || is_object($value)) {
                continue;
            }
            $html .= ' ' . $name . '="' . htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8') . '"';
        }

        return $html . '></picture>';
    }
}
