Install the database `ue34_tp2` and configure the connection in `model/const.php`.  
Use project root at the root of your domains.  
A default account with full permissions is `root root`.  
Use Apache, or configure another `.htaccess`.  

> The entry point of this website is the `index.php` file.  
> All the necessary files are required or imported through `bootstrap.php`, which loads `autoload.php` from all important folders.  
> All routes for the files are managed in `route.php`.  

> The `_class` directory contains the database management.  
> `LanguageManager` is not fully enabled at this time, but it works!


**create an .htaccess file, and add :**
```
RewriteEngine On

# Exclude /public directory from redirects
RewriteCond %{REQUEST_URI} !^/public

# Exclude direct access to index.php file to avoid infinite loops ahahahahahha (30min debug, thanks Apache :) )
RewriteCond %{REQUEST_URI} !^/index\.php

# All redirected to index.php
RewriteRule ^(.*)$ /index.php [L,QSA]
```
