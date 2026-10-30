# Analytics and Search Console

The frontend uses a separate GA4 Measurement ID for each domain: `ptjar.com` and `ptjar.co.id`. It emits page views through the Google tag, a `search` event for the public news search, and a `contact_click` event when a visitor clicks an email link. The email event measures contact intent; it does not confirm that an email was sent. GA4 Enhanced Measurement can also collect file download events when enabled in each web stream's settings. Each domain sends data to the GA4 stream/property associated with its ID; cross-domain visitor journeys are not linked by this code.

Both domains keep their own canonical URLs and sitemap. Since you chose to keep the domains independent, identical pages may appear as duplicate content to search engines.

## Configure the site

Set these environment variables in the web PHP environment, or create the ignored file `application/config/analytics.local.php` in the deployment document root:

```php
<?php
$config['ga4_measurement_ids'] = array(
    'ptjar.com' => 'G-1440CE5TEW',
    'ptjar.co.id' => 'G-9J06K956P6'
);
$config['gsc_verification_tokens'] = array(
    'ptjar.com' => 'verification-token-for-ptjar.com',
    'ptjar.co.id' => 'verification-token-for-ptjar.co.id'
);
```

Environment variable names:

- `PTJAR_GA4_MEASUREMENT_ID_COM`
- `PTJAR_GA4_MEASUREMENT_ID_CO_ID`
- `PTJAR_GSC_VERIFY_COM`
- `PTJAR_GSC_VERIFY_CO_ID`

The Search Console tokens are optional when verifying ownership with DNS TXT records. For HTML tag verification, put each URL-prefix property's token in the matching domain entry. The tag is rendered on that domain's homepage only. No tracking script is sent until a valid GA4 measurement ID is configured.

## Finish setup in Google

1. Create or choose a GA4 web data stream for each domain and enter the matching Measurement ID.
3. Verify both Search Console properties. Submit `https://ptjar.com/sitemap.xml` to the `.com` property and `https://ptjar.co.id/sitemap.xml` to the `.co.id` property.
4. Enable Enhanced Measurement's file downloads option if PDF/report download tracking is required.
5. Mark `contact_click` as a key event in GA4 if email clicks are the conversion signal you want reported.

The Google tag loads from Google's service when GA4 is configured. Page styles, fonts, and other frontend assets remain locally hosted.
