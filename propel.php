<?php

return [
    'propel' => [
        'database' => [
            'connections' => [
                'bookstore' => [
                    'adapter'    => 'mysql',
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => 'mysql:host=localhost:3306;dbname=bookstore',
                    'user'       => 'root',
                    'password'   => '12345678',
                    'attributes' => []
                ],
                'wordpress' => [
                    'adapter'    => 'mysql',
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => 'mysql:host=localhost:3306;dbname=wordpress',
                    'user'       => 'root',
                    'password'   => '12345678',
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