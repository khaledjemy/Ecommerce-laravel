# Ecommerce Store (Laravel)

A configurable storefront and order-management starter. It is intended to be installed separately for each buyer. The buyer's name, content, currency, delivery methods and offline payment methods are configured per installation.

## Requirements and local setup

- PHP 8.2+, Composer, a supported database, and mail delivery for email verification and order notifications.
- Copy `.env.example` to `.env`, configure `APP_URL`, database and mail settings, then run:

```bash
composer install
php artisan key:generate
php artisan migrate
php artisan serve
```

In production, configure `MAIL_*`, `QUEUE_CONNECTION` and run a supervised queue worker (`php artisan queue:work`). Order emails are queued after the order is committed. A failed queue submission is logged and does not erase an already saved order; monitor the logs and failed jobs.

Use `APP_DEBUG=false` in production. Configure the web server document root to Laravel's `public/` directory; do not expose `.env` or the project root.

Register the first account, verify its email, then grant store-admin access from the server:

```bash
php artisan store:grant-admin admin@example.com
```

This command only grants access to an existing verified account. Do not expose it as a public web route. Admin pages are linked from the dashboard after login.

## Store configuration

In **Store settings**, set the store name, about text, optional public contact email and ISO currency code. Enable delivery (shipping and/or pickup) and payment (cash on delivery and/or bank transfer). Bank transfer is only offered after instructions are entered. Shipping fees are not calculated automatically: the customer is told they will be confirmed before fulfillment.

Catalog products and categories must be published to be visible. Set stock explicitly for each product; existing products receive stock `0` during migration and cannot be ordered until replenished. The customer can search and filter the catalog, add products to a private cart and place an order after verifying their email. Checkout rechecks stock and reduces it atomically in a database transaction. Orders are created as **unpaid**. Admins can review orders, update fulfillment and manually record payment after checking a real receipt. Cancelling an unpaid order restores stock once and cannot be reopened; paid orders must be resolved before cancellation. Order changes are logged. Customer messages and subscriptions appear in the admin inbox.

Optional sample data for an empty development database:

```bash
php artisan db:seed --class=DemoCatalogSeeder
```

The sample catalog is synthetic. Do not run the seeder against a buyer's live catalog without reviewing its contents first.

## Not connected yet

Card payments, wallets, automatic bank-transfer verification, shipping carriers, tax calculation, shipping rates and refunds are **not** integrated. Order placed/updated emails are queued but require working mail and queue infrastructure. The stock value is decremented at order placement, not reserved temporarily in the cart. Country-specific integrations must be implemented for the buyer's provider and business rules. Do not enable a payment method in the UI without a working server-side integration and verified webhook/callback. The public-facing template still needs buyer-specific branding and legal pages before production use.

Run the automated checks with `php artisan test`.
