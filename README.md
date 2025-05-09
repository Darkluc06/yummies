# Kookdiagrammen

## setup

### Prerequisites

1. install php-PDO (for windows and linux)

### order of commands/actions

1. npm install (Installs node packackes)
2. composer require laravel/breeze --dev (Installs vendor files to run the backend)
3. php artisan breeze:install (installs "scaffolding" for the project. the following options need to be made)
    * vue.js with inertia
    * inertia-ssr / typescript
    * PHPUnit
4. php artisan key:generate (This generates a personal application key in the .env)
5. restore following files = routes/web.php - app.ts  (these files get changed while performing previous commands.
(the following three commands run simultaneously to mantain the project in development)
6. php artisan serve (runs the PHP)
7. php artisan inertia:start-ssr (Runs Inertia which is the routing between the front and back end
8. npm run dev (runs the node packakges in the dev environment)

## notes

npm run build = local environment no live changes
resources/assets contains the json files
