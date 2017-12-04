<?php

$config = [
    'name'=>'Buka Pasar',
    'components' => [
        'urlManager' => [
          'class' => 'yii\web\UrlManager',
          // Disable index.php
          'showScriptName' => false,
          // Disable r= routes
          'enablePrettyUrl' => true,
          'rules' => array(
            '<controller:\w+>/<id:\d+>' => '<controller>/view',
            '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
            '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
          ),
        ],
        
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validatio
            'cookieValidationKey' => '2Lsa32Fr5ylV_yXC9gmzQRXIMPl8VwgR',
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
