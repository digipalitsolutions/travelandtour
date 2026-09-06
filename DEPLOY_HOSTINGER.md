# Hostinger Deployment Guide

Domain: `travelandtour.digipalitsolutions.com`

GitHub repository:
`https://github.com/digipalitsolutions/travelandtour.git`

## Requirements

- PHP 8.3 or newer
- Composer
- MySQL database
- PHP extensions: `openssl`, `pdo_mysql`, `mbstring`, `fileinfo`, `curl`, `zip`

## Recommended Hostinger Setup

1. In Hostinger hPanel, create or open the website for `travelandtour.digipalitsolutions.com`.
2. Set PHP version to PHP 8.3 or newer.
3. Create a MySQL database and database user.
4. Deploy the GitHub repository into the website root.
5. If the Laravel project files are placed directly in `public_html`, copy `hostinger-root.htaccess` to `.htaccess` in `public_html`.
6. Create a production `.env` file on Hostinger. Do not upload the local `.env`.

## Production `.env` Values

Use real Hostinger database credentials:

```env
APP_NAME="Aethereal Luxury Travel"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://travelandtour.digipalitsolutions.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_hostinger_database
DB_USERNAME=your_hostinger_username
DB_PASSWORD=your_hostinger_password

ADMIN_EMAIL=arnelmarquez1123@gmail.com
ADMIN_PASSWORD="Ppg12345678#"
```

After creating `.env`, run:

```bash
php artisan key:generate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Composer Install

Run this on Hostinger after cloning/uploading:

```bash
composer install --no-dev --optimize-autoloader
```

## Folder Notes

For shared hosting, Laravel should keep using its `public` folder as the web entry point. If Hostinger does not let you point the domain document root to `public`, keep the full app in `public_html` and use the `.htaccess` rewrite from `hostinger-root.htaccess`.

Do not upload these local-only files:

- `.env`
- `vendor` if Composer is available on Hostinger
- `storage/logs/*.log`
- `.git` if uploading manually by File Manager or SFTP
