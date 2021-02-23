<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'name' => 'Mymovietravel',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'baseUrl' => ''
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
      
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                'blog' => 'blog/index',
                'tours' => 'tours/index',
                'accommodations' => 'accommodations/index',
                'guides' => 'site/guides',
                'verify-email/<token>' => 'site/verify-email',
                'my-movie' => 'site/my-movie',
                '<action>'=>'site/<action>',
                 [
                    'class' => 'app\components\ToursUrlRule',
                ],
                 [
                    'class' => 'app\components\BlogUrlRule',
                ],
                [
                    'class' => 'app\components\AccommodationsUrlRule',
                ],
            ],
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'ssl://mail.gspa.sch.id',
                'username' => 'dhika@gspa.sch.id',
                'password' => '90R_0+[p92FF',
                'port' => '465',
               // 'encryption' => 'tls',
            ],
        ],
      
    ],

    'params' => $params,
];