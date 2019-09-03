### PS: This project is no longer under development and hence feature request won't be fulfilled. Major issues if found, may be fixed. Feel free to fork and continue development!

# Running the project on Windows

* Download and install [XAMPP with PHP 7.2](https://www.apachefriends.org/xampp-files/7.2.18/xampp-windows-x64-7.2.18-1-VC15-installer.exe).
* Download and install [ODBC Drivers](https://www.microsoft.com/en-us/download/details.aspx?id=36434).
* Download [PHP 7.2 MSSQL Drivers](https://github.com/microsoft/msphpsql/releases/download/v5.6.1/Windows-7.2.zip). 
  and copy `php_pdo_sqlsrv_72_ts.dll` as well as `php_sqlsrv_72_ts.dll` found inside `x86` folder of the downloaded
  zip file to `XamppInstallationDrive:\xampp\php\ext` folder.
* Open the file `XamppInstallationDrive:\xampp\php\php.ini` and append the following config into it

````
extension=php_sqlsrv_72_ts.dll
extension=php_pdo_sqlsrv_72_ts.dll
````
* Restart Apache web server using XAMPP control panel.
* Configure MSSQL server to listen to port `1433` under `IPAll` section by [checking this guide](https://docs.microsoft.com/en-us/sql/database-engine/configure-windows/configure-a-server-to-listen-on-a-specific-tcp-port).
* Download and install [Composer](https://getcomposer.org/Composer-Setup.exe).
* Run the command `composer install -vvv` in PowerShell under project directory.
* Append the following virtual host config to the file `XamppInstallationDrive:\xampp\apache\conf\extra\httpd-vhosts.conf`

````
<VirtualHost *:80>
    ServerName 127.0.0.1,localhost,server-domain.com,www.server-domain.com
    DocumentRoot "/path/to/yii2-acp/frontend/web/"
    
    <Directory "/path/to/yii2-acp/frontend/web/">
        # use mod_rewrite for pretty URL support
        RewriteEngine on
        # If a directory or a file exists, use the request directly
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        # Otherwise forward the request to index.php
        RewriteRule . index.php

        # use index.php as index file
        DirectoryIndex index.php

        # ...other settings...
        Header always append X-Frame-Options SAMEORIGIN
        # Apache 2.4
        Require all granted
        
        ## Apache 2.2
        # Order allow,deny
        # Allow from all
    </Directory>
</VirtualHost>
<VirtualHost *:80>
    ServerName admin.server-domain.com
    DocumentRoot "/path/to/yii2-acp/backend/web/"
    
    <Directory "/path/to/yii2-acp/backend/web/">
        # use mod_rewrite for pretty URL support
        RewriteEngine on
        # If a directory or a file exists, use the request directly
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        # Otherwise forward the request to index.php
        RewriteRule . index.php

        # use index.php as index file
        DirectoryIndex index.php

        # ...other settings...
        Header always append X-Frame-Options SAMEORIGIN
        # Apache 2.4
        Require all granted
        
        ## Apache 2.2
        # Order allow,deny
        # Allow from all
    </Directory>
</VirtualHost>
````
    
   Replace project path and server domain with proper values. 
* Run the command `./init` in PowerShell  under project directory and choose production configuration.
* Update database credentials in the files `common\config\main-local.php`.
* Run the command `./yii migrate` in PowerShell under project directory.

