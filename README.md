## UniDescription installation notes

Edit the .env file. You'll need to update the DB related fields.

Note line 58 of config/database.php. If you're using MAMP on OSX, you'll want to include this:

            'unix_socket' => '/Applications/MAMP/tmp/mysql/mysql.sock',

Otherwise, you can remove that line if you're using the site on AWS or other typical LAMP servers.

