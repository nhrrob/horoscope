## NHR Horoscope
Filter by year and Zodiac Sign and get results in calendar view

### Install

- Clone project
- install or update composer: <code>composer update</code>
- Copy .env.example to .env and add database settings (show hidden files if .env.example is not found)
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=horoscope
DB_USERNAME=root
DB_PASSWORD=
```
- Generate key: <code>php artisan key:generate</code>
- run migration command: <code>php artisan migrate:fresh --seed</code>
- run serve command: <code>php artisan serve</code>

### Loom Video 
https://www.loom.com/share/56a2a25f9ac940f4a62699f36cf064be 

#### Demo Credentials:
- Admin
    admin@admin.com
    password
- Normal User
    user@admin.com
    password

## 
Feel free to contact:  
<a href="https://www.nazmulrobin.com/">nazmulrobin.com</a> | <a href="https://twitter.com/nhr_rob">Twitter</a> | <a href="https://www.linkedin.com/in/nhrrob/">Linkedin</a> | <a href="mailto:robin.sust08@gmail.com">Email</a>


## 
#### Bonus 
Laravel 8 auth using laravel/ui:
- <code>composer require laravel/ui</code>
- <code>php artisan ui bootstrap</code>
- <code>php artisan ui bootstrap --auth</code>
- <code>npm install && npm run dev</code>
- <code>php artisan migrate</code>