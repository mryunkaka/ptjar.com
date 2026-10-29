<?php

define('BASEPATH', TRUE);

class CI_Model
{
	public $db;
}

function base_url($path = '')
{
	return 'http://localhost:8082/' . ltrim($path, '/');
}

function site_url($path = '')
{
	return base_url($path);
}

function html_escape($value)
{
	return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function word_limiter($value, $limit = 100)
{
	$words = preg_split('/\s+/', trim(strip_tags((string) $value)));
	return implode(' ', array_slice($words, 0, $limit));
}

class ManagementBeritaPublishSecurityStub
{
	public function get_csrf_token_name()
	{
		return 'csrf_test_name';
	}

	public function get_csrf_hash()
	{
		return 'test-token';
	}
}

class ManagementBeritaPublishSessionStub
{
	public function flashdata($key)
	{
		return '';
	}
}

class ManagementBeritaPublishViewContext
{
	public $security;
	public $session;

	public function __construct()
	{
		$this->security = new ManagementBeritaPublishSecurityStub();
		$this->session = new ManagementBeritaPublishSessionStub();
	}

	public function render($view, $data)
	{
		extract($data);
		ob_start();
		include $view;
		return ob_get_clean();
	}
}

class ManagementBeritaPublishDatabaseStub
{
	public $conditions = array();
	public $table = NULL;
	public $data = array();
	public $affected = 1;
	public $updated = FALSE;

	public function where($column, $value)
	{
		$this->conditions[$column] = $value;
		return $this;
	}

	public function update($table, $data)
	{
		$this->table = $table;
		$this->data = $data;
		$this->updated = TRUE;
		return $this;
	}

	public function affected_rows()
	{
		return $this->affected;
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
$rows = array(
	array('nu_id' => 1, 'uuid' => 'draft-uuid', 'vc_image' => '', 'vc_title' => 'Draft berita', 'vc_content' => 'Isi draft', 'vc_status' => 0, 'dt_published' => '2026-10-29', 'vc_lang_img' => ''),
	array('nu_id' => 2, 'uuid' => 'published-uuid', 'vc_image' => '', 'vc_title' => 'Berita terbit', 'vc_content' => 'Isi terbit', 'vc_status' => 1, 'dt_published' => '2026-10-29', 'vc_lang_img' => ''),
);
$html = (new ManagementBeritaPublishViewContext())->render(
	$root . '/application/views/backend/main/media/berita/berita_list.php',
	array('list' => $rows, 'url' => array(array('vc_url' => 'assets/file/backend/upload/berita/thumbnail/')), 'pagination' => '', 'category' => array(), 'language' => array())
);
$document = new DOMDocument();
libxml_use_internal_errors(TRUE);
$document->loadHTML($html);
libxml_clear_errors();
$xpath = new DOMXPath($document);
$draftForm = $xpath->query('//tr[@id="rowtab1"]//form[@method="post" and contains(@action, "Management_Berita/publish_berita")]');
assert_true($draftForm->length === 1, 'draft row has a direct publish form');
assert_true($xpath->query('//tr[@id="rowtab1"]//form//input[@name="uuid" and @value="draft-uuid"]')->length === 1, 'publish form submits the draft UUID');
assert_true($xpath->query('//tr[@id="rowtab1"]//form//input[@name="csrf_test_name" and @value="test-token"]')->length === 1, 'publish form includes a CSRF token');
assert_true($xpath->query('//tr[@id="rowtab2"]//form[contains(@action, "Management_Berita/publish_berita")]')->length === 0, 'published row has no publish form');
assert_true($xpath->query('//tr[@id="rowtab2"]//form[@method="post" and contains(@action, "Management_Berita/unpublish_berita")]')->length === 1, 'published row has a direct unpublish form');
assert_true($xpath->query('//tr[@id="rowtab1"]//form[contains(@action, "Management_Berita/unpublish_berita")]')->length === 0, 'draft row has no unpublish form');
assert_true($xpath->query('//tr[@id="rowtab2"]//form//input[@name="uuid" and @value="published-uuid"]')->length === 1, 'unpublish form submits the published post UUID');
assert_true($xpath->query('//tr[@id="rowtab2"]//form//input[@name="csrf_test_name" and @value="test-token"]')->length === 1, 'unpublish form includes a CSRF token');

$modelPath = $root . '/application/models/ManagementBerita_model.php';
require_once $modelPath;
$database = new ManagementBeritaPublishDatabaseStub();
$model = new ManagementBerita_model();
$model->db = $database;
assert_true($model->publish_draft('draft-uuid') === TRUE, 'publishing a draft reports success when one row changes');
assert_true($database->table === 'tr_posts' && $database->data['vc_status'] === 1, 'publishing updates the post status to published');
assert_true($database->conditions === array('uuid' => 'draft-uuid', 'vc_type' => 'berita', 'vc_status' => 0, 'dt_deleted' => NULL), 'publishing only targets an active news draft');

$noChangeDatabase = new ManagementBeritaPublishDatabaseStub();
$noChangeDatabase->affected = 0;
$noChangeModel = new ManagementBerita_model();
$noChangeModel->db = $noChangeDatabase;
assert_true($noChangeModel->publish_draft('published-uuid') === FALSE, 'publishing a non-draft reports no change');

$unpublishDatabase = new ManagementBeritaPublishDatabaseStub();
$unpublishModel = new ManagementBerita_model();
$unpublishModel->db = $unpublishDatabase;
assert_true($unpublishModel->unpublish_post('published-uuid') === TRUE, 'unpublishing a post reports success when one row changes');
assert_true($unpublishDatabase->table === 'tr_posts' && $unpublishDatabase->data['vc_status'] === 0, 'unpublishing resets the status to draft');
assert_true($unpublishDatabase->conditions === array('uuid' => 'published-uuid', 'vc_type' => 'berita', 'vc_status' => 1, 'dt_deleted' => NULL), 'unpublishing only targets an active published news post');

$invalidDatabase = new ManagementBeritaPublishDatabaseStub();
$invalidModel = new ManagementBerita_model();
$invalidModel->db = $invalidDatabase;
assert_true($invalidModel->publish_draft('') === FALSE && $invalidDatabase->updated === FALSE, 'empty UUID is rejected without a database update');

echo "PASS: draft and published rows show the matching POST controls with CSRF protection.\n";
