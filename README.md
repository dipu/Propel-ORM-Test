# Propel-ORM-Test

Testing Propel ORM 2.0

Included: Pre generated models and schema from a Wordpress installation

**How to test:**

**Existing Model:**

1. Clone the repo
2. Update composer library

Then you are ready to use the already generated models.

**How to reverse generate schema:**

1. Give the following command from commandprompt/terminal
2. projectroot/vendor/bin/propel reverse "mysql:host=localhost;dbname=db;user=root;password=pwd"
3. The schema will be generated inside of a newly created directory named `generated-reversed-database`

**How to create a connection configuration file (propel.php):**

propel.php file need to be populated with connection information. See below for example:
```php
    <?php

return [
    'propel' => [
        'database' => [
            'connections' => [
                'bookstore' => [
                    'adapter'    => 'mysql',
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => 'mysql:host=localhost:3306;dbname=bookstore',
                    'user'       => 'username',
                    'password'   => 'password',
                    'attributes' => []
                ],
                'wordpress' => [
                    'adapter'    => 'mysql',
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => 'mysql:host=localhost:3306;dbname=wordpress',
                    'user'       => 'username',
                    'password'   => 'password',
                    'attributes' => []
                ]
            ]
        ],
        'runtime' => [
            'defaultConnection' => 'bookstore',
            'connections' => ['bookstore', 'wordpress']
        ],
        'generator' => [
            'defaultConnection' => 'bookstore',
            'connections' => ['bookstore','wordpress']
        ]
    ]
];
```
*Change database username and password according to your own installation*
*Notice that I created 2 connections. You can create as many as you want. Now if you have a schema file, put it on the same level as the propel.php file. I put both in the project root and on the same level as the vendor directory.*

**How to generate Models from generated schema:**

1. Copy the `schema.xml` to the project root
2. Create a directory named `models`
3. Create a connection config file aka propel.php
4. Give the following command from commandprompt/terminal
5. projectroot/vendor/bin/propel model:build --output-dir full-path-to-projectroot/models or projectroot/vendor/bin/propel build --output-dir full-path-to-projectroot/models
6. The Model classes will be generated and placed under the `models` directory
