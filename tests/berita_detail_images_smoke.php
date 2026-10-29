<?php

define('BASEPATH', TRUE);

class CI_Model
{
	public $db;
}

class BeritaDetailImagesQueryStub
{
	private $rows;
	private $row;

	public function __construct($rows = array(), $row = NULL)
	{
		$this->rows = $rows;
		$this->row = $row;
	}

	public function row_array()
	{
		return $this->row;
	}

	public function result_array()
	{
		return $this->rows;
	}
}

class BeritaDetailImagesDatabaseStub
{
	public $images = array();

	public function get_where($table, $where)
	{
		return new BeritaDetailImagesQueryStub(array(), array('nu_id' => 20));
	}

	public function query($sql, $params = array())
	{
		return new BeritaDetailImagesQueryStub($this->images);
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
require_once $root . '/application/models/ManagementBerita_model.php';
require_once $root . '/application/models/Jhonlinmagz_import_model.php';
$database = new BeritaDetailImagesDatabaseStub();
$database->images = array(
	array('nu_id' => 1, 'vc_image' => 'jhonlinmagz_9151_9152.jpg', 'int_thumbnail' => 1),
	array('nu_id' => 2, 'vc_image' => 'jhonlinmagz_9151_9152.jpg', 'int_thumbnail' => 0),
	array('nu_id' => 3, 'vc_image' => 'jhonlinmagz_9151_other.jpg', 'int_thumbnail' => 0),
);
$model = new ManagementBerita_model();
$model->db = $database;
$photos = $model->get_detail_photo('test-uuid');
assert_true(count($photos) === 2, 'detail gallery returns only one row for each image filename');
assert_true($photos[0]['int_thumbnail'] === 1, 'deduplication keeps the thumbnail row first');

$imageNameMethod = new ReflectionMethod('Jhonlinmagz_import_model', 'source_image_name_key');
$imageNameMethod->setAccessible(TRUE);
$importer = (new ReflectionClass('Jhonlinmagz_import_model'))->newInstanceWithoutConstructor();
$featuredName = $imageNameMethod->invoke($importer, 'https://www.jhonlinmagz.com/wp-content/uploads/2026/09/photo.jpeg');
$resizedName = $imageNameMethod->invoke($importer, 'https://www.jhonlinmagz.com/wp-content/uploads/2026/09/photo-300x200.jpeg');
assert_true($featuredName === 'photo.jpeg' && $resizedName === $featuredName, 'WordPress resized variants share the original image name for deduplication');

$css = file_get_contents($root . '/assets/HeroBiz-pro/assets/css/main.css');
assert_true(strpos($css, '.blog .blog-details .content img') !== FALSE, 'article content images have a scoped responsive rule');
assert_true(strpos($css, 'max-width: 100%') !== FALSE, 'article image width is constrained to its content card');

echo "PASS: berita detail images stay within the card and duplicate gallery filenames are removed.\n";
