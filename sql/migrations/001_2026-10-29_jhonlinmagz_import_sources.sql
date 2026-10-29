CREATE TABLE IF NOT EXISTS `tr_post_external_sources` (
    `nu_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `vc_source` VARCHAR(64) NOT NULL,
    `vc_source_id` VARCHAR(64) NOT NULL,
    `nu_post_id` BIGINT UNSIGNED NOT NULL,
    `vc_source_url` VARCHAR(2048) NOT NULL,
    `dt_created` DATETIME NOT NULL,
    PRIMARY KEY (`nu_id`),
    UNIQUE KEY `uq_post_external_source` (`vc_source`, `vc_source_id`),
    KEY `idx_external_source_post` (`nu_post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
