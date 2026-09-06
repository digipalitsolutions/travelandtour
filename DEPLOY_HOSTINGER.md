# Hostinger Deployment Guide

Domain: `travelandtour.digipalitsolutions.com`

GitHub repository:
`https://github.com/digipalitsolutions/travelandtour.git`

## Requirements

- PHP 8.4 or newer
- Composer
- MySQL database
- PHP extensions: `openssl`, `pdo_mysql`, `mbstring`, `fileinfo`, `curl`, `zip`

## Recommended Hostinger Setup

1. In Hostinger hPanel, create or open the website for `travelandtour.digipalitsolutions.com`.
2. Set PHP version to PHP 8.3 or newer.
3. Create a MySQL database and database user.
4. Deploy the GitHub repository into the website root.
5. If Hostinger serves the project root instead of Laravel's `public` folder, copy `hostinger-root-index.php` to `index.php`, copy `hostinger-root.htaccess` to `.htaccess`, and copy the contents of `public/` (including `assets/`) into that served directory.
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

For shared hosting, Laravel should ideally use its `public` folder as the web entry point. If Hostinger only serves the project root, the tracked root entry files above provide the compatible layout while keeping `app/`, `config/`, `routes/`, `storage/`, and `vendor/` outside the public web path.

Do not upload these local-only files:

- `.env`
- `vendor` if Composer is available on Hostinger
- `storage/logs/*.log`
- `.git` if uploading manually by File Manager or SFTP
