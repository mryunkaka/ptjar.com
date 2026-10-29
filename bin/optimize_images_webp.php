<?php

/**
 * Create WebP sidecars for JPEG and PNG assets without changing originals.
 * Run from the project root with: php bin/optimize_images_webp.php [quality]
 */

if (PHP_SAPI !== 'cli') {
    fwrite(STDERR, "This utility must be run from the command line.\n");
    exit(1);
}

if (!function_exists('imagewebp')) {
    fwrite(STDERR, "This PHP build does not include WebP support in GD.\n");
    exit(1);
}

$assetRoot = realpath(__DIR__ . '/../assets');
if ($assetRoot === false || !is_dir($assetRoot)) {
    fwrite(STDERR, "The assets directory was not found.\n");
    exit(1);
}

$quality = isset($argv[1]) ? (int) $argv[1] : 82;
$quality = max(50, min(95, $quality));
ini_set('memory_limit', '-1');
set_time_limit(0);

$processed = 0;
$created = 0;
$skipped = 0;
$failed = 0;
$sourceBytes = 0;
$webpBytes = 0;
$convertedSourceBytes = 0;

function jpegExifUint16($value, $littleEndian)
{
    $parts = unpack($littleEndian ? 'vvalue' : 'nvalue', $value);
    return isset($parts['value']) ? (int) $parts['value'] : 0;
}

function jpegExifUint32($value, $littleEndian)
{
    $parts = unpack($littleEndian ? 'Vvalue' : 'Nvalue', $value);
    return isset($parts['value']) ? (int) $parts['value'] : 0;
}

function readJpegOrientation($path)
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
        $length = jpegExifUint16($lengthBytes, false);
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
        if (jpegExifUint16(substr($tiff, 2, 2), $littleEndian) !== 42) {
            continue;
        }

        $ifdOffset = jpegExifUint32(substr($tiff, 4, 4), $littleEndian);
        $entryCount = jpegExifUint16(substr($tiff, $ifdOffset, 2), $littleEndian);
        for ($index = 0; $index < $entryCount; $index++) {
            $entryOffset = $ifdOffset + 2 + ($index * 12);
            $entry = substr($tiff, $entryOffset, 12);
            if (strlen($entry) !== 12 || jpegExifUint16(substr($entry, 0, 2), $littleEndian) !== 0x0112) {
                continue;
            }

            if (jpegExifUint16(substr($entry, 2, 2), $littleEndian) === 3
                && jpegExifUint32(substr($entry, 4, 4), $littleEndian) >= 1) {
                $orientation = jpegExifUint16(substr($entry, 8, 2), $littleEndian);
                fclose($handle);
                return ($orientation >= 1 && $orientation <= 8) ? $orientation : 1;
            }
        }
    }

    fclose($handle);
    return 1;
}

function orientJpegForWebp($image, $path)
{
    $orientation = readJpegOrientation($path);

    switch ($orientation) {
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

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($assetRoot, FilesystemIterator::SKIP_DOTS)
);

foreach ($iterator as $fileInfo) {
    if (!$fileInfo->isFile() || $fileInfo->isLink()) {
        continue;
    }

    $path = $fileInfo->getPathname();
    $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    if ($extension !== 'jpg' && $extension !== 'jpeg' && $extension !== 'png') {
        continue;
    }

    $processed++;
    $sourceBytes += $fileInfo->getSize();
    $target = $path . '.webp';

    // Never replace a WebP that already exists; it may have been prepared by hand.
    if (is_file($target)) {
        $skipped++;
        continue;
    }

    $image = $extension === 'png' ? @imagecreatefrompng($path) : @imagecreatefromjpeg($path);
    if ($image === false) {
        $failed++;
        fwrite(STDERR, "Could not decode: " . substr($path, strlen($assetRoot) + 1) . "\n");
        continue;
    }

    if ($extension !== 'png') {
        $image = orientJpegForWebp($image, $path);
    } else {
        imagealphablending($image, false);
        imagesavealpha($image, true);
    }

    $temporary = $target . '.tmp-' . getmypid();
    $ok = @imagewebp($image, $temporary, $quality);
    imagedestroy($image);

    clearstatcache(true, $temporary);
    if (!$ok || !is_file($temporary)) {
        @unlink($temporary);
        $failed++;
        fwrite(STDERR, "Could not encode: " . substr($path, strlen($assetRoot) + 1) . "\n");
        continue;
    }

    $encodedBytes = filesize($temporary);
    if ($encodedBytes === false || $encodedBytes >= $fileInfo->getSize()) {
        @unlink($temporary);
        $skipped++;
        continue;
    }

    if (!@rename($temporary, $target)) {
        @unlink($temporary);
        $failed++;
        fwrite(STDERR, "Could not write: " . substr($path, strlen($assetRoot) + 1) . "\n");
        continue;
    }

    $created++;
    $webpBytes += $encodedBytes;
    $convertedSourceBytes += $fileInfo->getSize();
}

$savedBytes = $convertedSourceBytes - $webpBytes;
$savedPercent = $convertedSourceBytes > 0 ? round(($savedBytes / $convertedSourceBytes) * 100, 1) : 0;

echo "Raster files checked: {$processed}\n";
echo "WebP sidecars created: {$created}\n";
echo "Skipped (existing or no size benefit): {$skipped}\n";
echo "Failed: {$failed}\n";
echo "New WebP total: " . number_format($webpBytes / 1048576, 2) . " MiB\n";
echo "Space saved across converted files: " . number_format($savedBytes / 1048576, 2) . " MiB ({$savedPercent}%)\n";

exit($failed === 0 ? 0 : 1);
