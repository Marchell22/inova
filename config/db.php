<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=localhost;port=5433;dbname=medika-solusi',
    'username' => 'postgres',
    'password' => 'Manurung22',
    'charset' => 'utf8',
    'schemaMap' => [
        'pgsql' => [
            'class' => 'yii\db\pgsql\Schema',
            'defaultSchema' => 'public' // specify your schema here
        ]
    ],
];
