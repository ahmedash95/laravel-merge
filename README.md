# Laravel-Merged
### installation

#### install dependencies
- `composer install`

#### copy `.env` file
- `cp .env.example .env`
- insert your db / other  credentials into `.env` file

#### generate key
- `php artisan key:generate`

#### install hub
- `sudo add-apt-repository ppa:cpick/hub && sudo apt-get update && sudo apt-get install hub`
- configure `hub` by  `hub clone github/hub ` and add your github credentials 


#### migrate database
- `php artisan migrate`

#### link storage
- `php artisan storage:link`

#### laravel merge commands
- `php artisan laravel:update`
- `php artisan pr:fetch`
#### serve application
- `php artisan serve`

## Links
- https://twitter.com/LaravelMerged
