<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=localhost;dbname=exercicio',
    'username' => 'postgres',
    'password' => 'tralala',
    'charset' => 'utf8',
    'on afterOpen' => function($event) {
        $event->sender->createCommand("SET timezone = 'America/Manaus'")->execute();
    }
];
