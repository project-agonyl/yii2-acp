<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'a3-admin',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'database' => [
            'class' => 'backend\modules\database\Module',
        ],
        'log' => [
            'class' => 'backend\modules\log\Module',
        ],
        'notification' => [
            'class' => 'backend\modules\notification\Module',
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-a3-admin',
            'cookieValidationKey' => md5('a3-admin')
        ],
        'user' => [
            'identityClass' => 'common\models\Account',
            'identityCookie' => ['name' => '_a3-admin', 'httpOnly' => true],
            'loginUrl' => ['account/login'],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'a3-admin',
            'timeout'=> 86400
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
            'errorAction' => 'account/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];
