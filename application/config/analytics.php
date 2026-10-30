<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Configure these values through the hosting environment or an ignored
// application/config/analytics.local.php file in the deployment document root.
$ga4ComMeasurementId = getenv('PTJAR_GA4_MEASUREMENT_ID_COM');
$ga4CoIdMeasurementId = getenv('PTJAR_GA4_MEASUREMENT_ID_CO_ID');
$config['ga4_measurement_ids'] = array(
    'ptjar.com' => $ga4ComMeasurementId ? $ga4ComMeasurementId : 'G-1440CE5TEW',
    'ptjar.co.id' => $ga4CoIdMeasurementId ? $ga4CoIdMeasurementId : 'G-9J06K956P6'
);
$config['gsc_verification_tokens'] = array(
    'ptjar.com' => getenv('PTJAR_GSC_VERIFY_COM') ? getenv('PTJAR_GSC_VERIFY_COM') : '',
    'ptjar.co.id' => getenv('PTJAR_GSC_VERIFY_CO_ID') ? getenv('PTJAR_GSC_VERIFY_CO_ID') : ''
);

$localAnalyticsConfig = APPPATH . 'config/analytics.local.php';
if (is_file($localAnalyticsConfig)) {
    include $localAnalyticsConfig;
}
