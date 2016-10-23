<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=localhost;port=5432;dbname=rns-test-task',
    'username' => 'dev',
    'password' => '123456',
    'charset' => 'utf8',
    'schemaMap' => [
        'pgsql'=> [
            'class'=>'yii\db\pgsql\Schema',
            'defaultSchema' => 'public' //specify your schema here
        ]
    ],
    'enableSchemaCache' => true,

    // Duration of schema cache.
    'schemaCacheDuration' => 3600,

    // Name of the cache component used to store schema information
    'schemaCache' => 'cache',
];
