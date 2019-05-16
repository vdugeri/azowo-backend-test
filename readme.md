### Install
- `composer install`
- Update `.env` with your environment setting
- Run `php artisan migrate` to create database tables


### Running
- `php artisan serve`

### API Endpoints
- ```GET /subscriptions```
- ```POST /subscriptions; payload => ['email' => 'email_address']```
- ```POST /subscriptions/confirm; payload ['email' => 'email_address', 'token' => 'token']```
- ```DELETE /subscriptions/{id}; Path Params => id```
