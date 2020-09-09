# PortfolioBlog
Just repository for demonstrate my skill. This project is a simple blog made on laravel framework.


### Require
- PHP 7.4
- MySQL
- Nginx (Recomented) or Apcahe


### Installing 

##### step 1:
CMD:
```
git clone https://github.com/AkioSarkiz/PortfolioBlog.git
cd PortfolioBlog
composer install --optimize-autoloader --no-dev
php artisan key:generate
```
##### step 2:
Copy env.example as .env and set your params.

##### step 3:
Run nginx or apache.

##### Example serve for nginx.
```
server {
    listen 80;
    server_name example.com;
    root /srv/example.com/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

##### Demo
link: https://portfolio_blog.webvost.info/?page=2  
login: testuser@g.com  
password: password
