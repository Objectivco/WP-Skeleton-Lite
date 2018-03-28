# WP-Skeleton
Basic layout of a WordPress Git repository using Composer for dependency management.

## Getting Started

Alright, developer. Sitting there. So smug. So confident. Thinking about how smart you must look.

This is a composer driven project skeleton. So this is the general setup:
1. Fork this repository to a new private repository.
2. Replace instances of example.app in `composer.json` with your local dev domain.
3. Run `composer install`
4. Copy `local-config-sample.php` to `local-config.php` and update with your DB credentials / information. Also replace `example.app` in this file. 
5. *Possibly* rename `wp-content/themes/objectiv-starter-theme` to the site name. However if you do this, you'll have to remove it from composer since it will redownload it if you don't.
6. Eventually update `wp-config.php` to include the necessary details for your production environment. You can define these credentials directly (less ideal) or do some type of find/replace on deploy. (more ideal)

## Premium Plugins

This project includes the composer repositories to download WP Migrate DB Pro, Advanced Custom Fields Pro, and Gravity Forms. You'll need to add your own values to make them work.

You'll also need to add one or more of these to the required packages:
```txt
        "deliciousbrains/wp-migrate-db-pro": "*",
        "deliciousbrains/wp-migrate-db-pro-media-files": "*",
        "deliciousbrains/wp-migrate-db-pro-cli": "*",
        "deliciousbrains/wp-migrate-db-pro-multisite-tools": "*",
        "gravityforms/gravityforms": "*",
        "advanced-custom-fields/advanced-custom-fields-pro": "*",
```

## Notes

Composer versions are set to `*` for every package. So you'll always get the latest version of everything. 

## Happy Hunting
