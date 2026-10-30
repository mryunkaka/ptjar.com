<!DOCTYPE html>
<?php
  $seoMeta = frontend_seo_current(isset($seo_meta) ? $seo_meta : array());
  $this->config->load('analytics', true);
  $ga4MeasurementIds = (array) $this->config->item('ga4_measurement_ids', 'analytics');
  $gscVerificationTokens = (array) $this->config->item('gsc_verification_tokens', 'analytics');
  $seoDomain = frontend_seo_current_domain();
  $ga4MeasurementId = isset($ga4MeasurementIds[$seoDomain]) ? trim((string) $ga4MeasurementIds[$seoDomain]) : '';
  $gscVerificationToken = isset($gscVerificationTokens[$seoDomain]) ? trim((string) $gscVerificationTokens[$seoDomain]) : '';
  $isHomepage = count($this->uri->segment_array()) === 0;
  $ga4Enabled = preg_match('/^G-[A-Z0-9]+$/i', $ga4MeasurementId) === 1;
?>
<html lang="<?= html_escape($seoMeta['lang']) ?>">
 
 
<head>
  <?php if ($isHomepage && $gscVerificationToken !== '') { ?>
    <meta name="google-site-verification" content="<?= html_escape($gscVerificationToken) ?>">
  <?php } ?>
  <?php if ($ga4Enabled) { ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= rawurlencode($ga4MeasurementId) ?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', <?= json_encode($ga4MeasurementId) ?>);

      document.addEventListener('submit', function (event) {
        var form = event.target;
        var searchInput = form && form.querySelector ? form.querySelector('[name="search"]') : null;
        var actionPath;
        try {
          actionPath = new URL(form.action, window.location.href).pathname.replace(/\/+$/, '');
        } catch (error) {
          return;
        }
        if (!searchInput || !/\/Search$/i.test(actionPath)) {
          return;
        }
        var searchTerm = searchInput.value.trim().slice(0, 100);
        if (!searchTerm || /[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}/i.test(searchTerm) || /\+?\d[\d\s().-]{7,}\d/.test(searchTerm)) {
          return;
        }
        gtag('event', 'search', { search_term: searchTerm });
      });

      document.addEventListener('click', function (event) {
        var link = event.target.closest ? event.target.closest('a[href]') : null;
        var href = link ? (link.getAttribute('href') || '').trim() : '';
        if (!/^mailto:/i.test(href)) {
          return;
        }
        gtag('event', 'contact_click', { method: 'email' });
      });
    </script>
  <?php } ?>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= html_escape($seoMeta['title']) ?></title>
  <meta name="description" content="<?= html_escape($seoMeta['description']) ?>">
  <meta name="robots" content="<?= html_escape($seoMeta['robots']) ?>">
  <link rel="canonical" href="<?= html_escape($seoMeta['canonical']) ?>">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="PT Jhonlin Agro Raya Tbk">
  <meta property="og:title" content="<?= html_escape($seoMeta['title']) ?>">
  <meta property="og:description" content="<?= html_escape($seoMeta['description']) ?>">
  <meta property="og:url" content="<?= html_escape($seoMeta['canonical']) ?>">
  <meta property="og:locale" content="<?= $seoMeta['lang'] === 'en' ? 'en_US' : 'id_ID' ?>">
  <meta name="twitter:card" content="summary_large_image">
  <?php
    $organizationSchema = array(
      '@context' => 'https://schema.org',
      '@type' => 'Corporation',
      'name' => 'PT Jhonlin Agro Raya Tbk',
      'url' => frontend_seo_canonical_base(),
      'email' => 'corsec@ptjar.com',
      'logo' => frontend_seo_canonical_base() . 'assets/file/frontend/image/template/iconjar.png'
    );
  ?>
  <script type="application/ld+json"><?= json_encode($organizationSchema, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?></script>

  <!-- Favicons -->
  <link href="<?= base_url() ?>favicon.png?v=2" rel="icon" type="image/png">
  <!-- <link href="<?= base_url('assets/HeroBiz-pro') ?>/assets/img/favicon.png" rel="icon"> -->
  <!--<link href="<?= base_url('assets/HeroBiz-pro') ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">-->
    <link href="<?= base_url() ?>assets/file/frontend/image/template/iconjar.png" rel="apple-touch-icon">

  <!-- Local copies of the existing Google Fonts families -->
  <link href="<?= base_url('assets/Frontend/css/fonts.css') ?>" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('assets/HeroBiz-pro') ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/HeroBiz-pro') ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url('assets/HeroBiz-pro') ?>/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?= base_url('assets/HeroBiz-pro') ?>/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/HeroBiz-pro') ?>/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="<?= base_url('') ?>assets/NiceAdmin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= base_url('') ?>assets/NiceAdmin/assets/vendor/boxicons/css/boxicons.css" rel="stylesheet">

  <link href="<?= base_url('') ?>assets/Frontend/css/cos.css" rel="stylesheet">

  <!-- Variables CSS Files. Uncomment your preferred color scheme -->
  <link href="<?= base_url('assets/HeroBiz-pro') ?>/assets/css/variables.css" rel="stylesheet">
  <!-- <link href="assets/css/variables-blue.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/variables-green.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/variables-orange.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/variables-purple.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/variables-red.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/variables-pink.css" rel="stylesheet"> -->

  <!-- Template Main CSS File -->
  <?php $mainCssPath = FCPATH . 'assets/HeroBiz-pro/assets/css/main.css'; ?>
  <link href="<?= base_url('assets/HeroBiz-pro/assets/css/main.css') ?>?v=<?= is_file($mainCssPath) ? filemtime($mainCssPath) : '1' ?>" rel="stylesheet">
  <?php $responsiveCssPath = FCPATH . 'assets/Frontend/css/responsive.css'; ?>
  <link href="<?= base_url('assets/Frontend/css/responsive.css') ?>?v=<?= is_file($responsiveCssPath) ? filemtime($responsiveCssPath) : '1' ?>" rel="stylesheet">

  <!-- =======================================================
  * Template Name: HeroBiz - v2.1.0
  * Template URL: https://bootstrapmade.com/herobiz-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
