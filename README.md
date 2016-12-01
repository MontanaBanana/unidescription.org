# UniDescription

---
## UniDescription installation notes

Point your apache document root to the `public/` folder.

Copy the .env.example file to .env for your local installation. You'll need to update the following fields:

* APP_KEY (unique to your version of unidescription)
* DB_HOST
* DB_DATABASE
* DB_PASSWORD
* DB_PASSWORD
* MAIL_DRIVER
* MAIL_HOST
* MAIL_PORT
* MAIL_USERNAME
* MAIL_PASSWORD
* MAIL_ENCRYPTION
* MANDRILL_SECRET
* TWITTER_CLIENT_ID
* TWITTER_CLIENT_SECRET
* PHONEGAP_BUILD_CLIENT_ID
* PHONEGAP_BUILD_CLIENT_SECRET

*If you're working on the official unidescription.org site, contact Joe for the required .env entries*

The rest of the entries you can leave the same as they are in the example.

The following directories and the files inside need to be writable by your webserver:

~~~~
bootstrap/cache
resources
resources/assets
resources/lang
resources/views
storage
storage/app
storage/framework
storage/logs
public/assets
public/projects
public/images
~~~~


**Note** line 58 of config/database.php. If you're using MAMP on OSX, you'll want to include this:

            'unix_socket' => '/Applications/MAMP/tmp/mysql/mysql.sock',

Otherwise, you can remove that line if you're using the site on AWS or other typical LAMP servers.

## Frameworks used

* [National Park Service fork of Bootstrap](http://www.nps.gov/npmap/tools/bootstrap/)
* [Laravel](https://laravel.com/)
