<?php
$host = $_ENV['DB_HOST'] ? $_ENV['DB_HOST'] : 'localhost';
$userdb = $_ENV['DB_USER'] ? $_ENV['DB_USER'] : 'root';
$passdb = $_ENV['DB_PASS'] ? $_ENV['DB_PASS'] : '';
$dbname = $_ENV['DB_NAME'] ? $_ENV['DB_NAME'] : 'yii2basic';
$dsn = 'mysql:host='.$host.';dbname='.$dbname;

return [
    'class' => 'yii\db\Connection',
    'dsn' => $dsn,
    'username' => $userdb,
    'password' => $passdb,
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
