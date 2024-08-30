CREATE TEMPORARY TABLE temp_invoices (
    id bigint unsigned NOT NULL AUTO_INCREMENT,
    reference varchar(40) NOT NULL,
    amount bigint unsigned NOT NULL,
    currency enum('COP','USD') NOT NULL,
    customer_name varchar(100) NOT NULL,
    dni varchar(40) NOT NULL,
    description varchar(512) NOT NULL,
    import_id bigint unsigned NOT NULL,
    expired_at date NOT NULL,
    created_at date NOT NULL,
    line int unsigned NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY temp_invoices_reference_unique (reference),
    INDEX (import_id)
) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;