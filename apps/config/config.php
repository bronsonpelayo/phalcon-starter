<?php
return new \Phalcon\Config(array(
    'database' => array(
        "default" =>
            array(
                'adapter'  => 'Mysql',
                'driver'  => 'pdo_mysql',
                'host'     => 'localhost',
                'username' => 'root',
                'password' => '',
                'dbname'     => 'phalcon',
                'modelPath'     => '../core/entities',
                'modelNamespace'     => 'Core\Entities'

            ),
        "db1" =>
            array(
                'adapter'  => 'Mysql',
                'driver'  => 'pdo_mysql',
                'host'     => 'localhost',
                'username' => 'root',
                'password' => '',
                'dbname'     => 'db1',
                'modelPath'     => '../core/entities',
                'modelNamespace'     => 'Core\Entities'
            ))

));
