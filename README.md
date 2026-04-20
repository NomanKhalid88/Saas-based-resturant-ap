## Restaurant SaaS API

Multi-tenant Laravel 11 backend for restaurant management system.

### Features
- Multi-tenant architecture (merchant_uuid)
- Product CRUD with variations & addons
- Order system with pricing engine
- Sanctum authentication
- Caching & optimization

### Setup
- composer install
- cp .env.example .env
- php artisan migrate --seed
- php artisan serve