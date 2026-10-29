<?php

define('BASEPATH', TRUE);

function base_url($path = '')
{
	return '/'.ltrim($path, '/');
}

class RecruitmentNoticeLanguageStub
{
	public function line($key)
	{
		return '';
	}
}

class RecruitmentNoticeViewContext
{
	public $lang;

	public function __construct()
	{
		$this->lang = new RecruitmentNoticeLanguageStub();
	}

	public function render($view)
	{
		ob_start();
		include $view;
		return ob_get_clean();
	}
}

function assert_true($condition, $message)
{
	if (!$condition)
	{
		fwrite(STDERR, "FAIL: {$message}\n");
		exit(1);
	}
}

$root = dirname(__DIR__);
$html = (new RecruitmentNoticeViewContext())->render($root.'/application/views/frontend/home/index.php');
$document = new DOMDocument();
libxml_use_internal_errors(TRUE);
$document->loadHTML($html);
libxml_clear_errors();
$xpath = new DOMXPath($document);

assert_true($xpath->query('//*[@id="recruitment-warning-modal" and contains(concat(" ", normalize-space(@class), " "), " modal ")]')->length === 1, 'homepage renders the recruitment warning as a modal');

$modal = $xpath->query('//*[@id="recruitment-warning-modal"]')->item(0);
assert_true($modal->getAttribute('aria-label') === 'Pengumuman resmi: Waspada Penipuan Rekrutmen', 'modal has an accessible name without a visible header');
assert_true($xpath->query('//*[@id="recruitment-warning-modal"]//*[@data-bs-dismiss="modal"]')->length === 1, 'modal has a close control');
assert_true($xpath->query('//*[@id="recruitment-warning-modal"]//*[contains(concat(" ", normalize-space(@class), " "), " modal-header ")]')->length === 0, 'modal has no header text block');
assert_true($xpath->query('//*[@id="recruitment-warning-modal"]//*[contains(concat(" ", normalize-space(@class), " "), " recruitment-notice-modal__caption ")]')->length === 0, 'modal has no poster caption footer');
assert_true($xpath->query('//*[@id="recruitment-notice-carousel"]//*[contains(concat(" ", normalize-space(@class), " "), " carousel-indicators ")]')->length === 0, 'modal has no carousel footer');
assert_true(strpos($html, 'modal-backdrop.recruitment-notice-backdrop.show') !== FALSE && strpos($html, 'opacity: .9') !== FALSE, 'modal backdrop is extra dark');
assert_true(strpos($html, 'width: min(92vw, 1060px)') !== FALSE, 'poster modal uses a wide layout');
assert_true(strpos($html, 'overflow-y: auto') !== FALSE, 'poster area can scroll vertically');
assert_true(strpos($html, 'position: fixed') !== FALSE && strpos($html, 'top: 50%') !== FALSE, 'carousel controls remain fixed while the poster scrolls');
assert_true(strpos($html, 'scrollbar-width: none') !== FALSE && strpos($html, '::-webkit-scrollbar') !== FALSE, 'poster scrollbars are visually hidden');

$carousel = $xpath->query('//*[@id="recruitment-notice-carousel"]')->item(0);
assert_true($carousel !== NULL, 'modal contains the poster carousel');
assert_true($carousel->getAttribute('role') === 'region', 'carousel is exposed as a named region');
assert_true($carousel->getAttribute('aria-roledescription') === 'carousel', 'carousel role is described for assistive technology');
assert_true($carousel->getAttribute('data-bs-touch') === 'true', 'carousel supports touch swipes');
assert_true($carousel->getAttribute('data-bs-wrap') === 'true', 'carousel loops between posters');
assert_true($xpath->query('//*[@id="recruitment-notice-carousel"]//button[@data-bs-slide="prev"]')->length === 1, 'carousel has a previous control');
assert_true($xpath->query('//*[@id="recruitment-notice-carousel"]//button[@data-bs-slide="next"]')->length === 1, 'carousel has a next control');
assert_true($xpath->query('//*[@id="recruitment-notice-carousel"]//*[contains(concat(" ", normalize-space(@class), " "), " carousel-item ")]')->length === 2, 'carousel renders both poster slides');
assert_true($xpath->query('//*[@id="recruitment-notice-carousel"]//*[contains(concat(" ", normalize-space(@class), " "), " carousel-item ") and @aria-roledescription="slide"]')->length === 2, 'each poster slide has an accessible description');
assert_true($xpath->query('//*[@id="recruitment-notice-carousel"]//*[contains(concat(" ", normalize-space(@class), " "), " carousel-item ") and contains(concat(" ", normalize-space(@class), " "), " active ")]')->length === 1, 'carousel starts on exactly one active slide');
assert_true(strpos($html, 'bootstrap.Modal.getOrCreateInstance') !== FALSE, 'modal is shown automatically on page load');

$images = $xpath->query('//*[@id="recruitment-warning-modal"]//img');
assert_true($images->length === 2, 'modal renders both poster images');

$expectedAssets = array(
	'assets/file/frontend/image/recruitment/klarifikasi-rekrutmen-1.jpeg',
	'assets/file/frontend/image/recruitment/klarifikasi-rekrutmen-2.jpeg'
);

foreach ($images as $index => $image)
{
	$src = $image->getAttribute('src');
	$relativePath = ltrim(parse_url($src, PHP_URL_PATH), '/');
	assert_true($relativePath === $expectedAssets[$index], 'poster is in the expected sequence');
	assert_true($image->getAttribute('alt') !== '', 'poster has descriptive alternative text');
	assert_true(is_file($root.'/'.$relativePath), 'poster asset exists: '.$relativePath);
	$links = $xpath->query('ancestor::a[1]', $image);
	assert_true($links->length === 1, 'poster opens its full-size source image');
	assert_true($links->item(0)->getAttribute('href') === $src, 'full-size link matches poster source');
	assert_true(strpos($links->item(0)->getAttribute('rel'), 'noopener') !== FALSE, 'new-tab link uses noopener');
}

echo "PASS: recruitment warning renders two accessible, openable posters.\n";
