### laravel5.5
composer create-project --prefer-dist laravel/laravel laravel "5.5.*"

### composer
composer dump-autoload

### migration
php artisan make:migration create_users_table --create=users

php artisan make:migration alter_users_table --table=users

php artisan migrate

php artisan make:seeder UserTableSeeder

php artisan db:seed

php artisan db:seed --class=UserTableSeeder

php artisan make:factory UserFactory --model=User

### model
php artisan make:model Models\User

### dingo-api
composer require dingo/api "2.0.*"

php artisan vendor:publish --provider="Dingo\Api\Provider\LaravelServiceProvider"

### dingo-jwt
composer require tymon/jwt-auth:dev-develop --prefer-source

php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"

php artisan jwt:secret

### passport
composer require paragonie/random_compat:2.*

composer require laravel/passport "4.0.*"

### repository
composer require prettus/l5-repository

### laraval-admin
composer require encore/laravel-admin

php artisan vendor:publish --provider="Encore\Admin\AdminServiceProvider"