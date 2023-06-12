# Installation

1. Git clone:
   `git clone https://github.com/chandraauliatama/parkironline.git`
2. Get into parkironline directory
   `cd parkironline`
3. Install dependencies via composer:
   `composer install`
4. Install Dependencies: You can use one of either pnpm, npm, or yarn.
   `npm install`
5. Build Manifest
   `npm run build`
6. Copy .env.example and configure your database:
   `cp .env.example .env`
7. Generate APP_KEY for Laravel:
   `php artisan key:generate`
8. Migrate the database tables and seed the data to your DB:
   `php artisan migrate --seed`
