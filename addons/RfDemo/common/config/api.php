<?php

return [

    // ----------------------- 参数配置 ----------------------- //
    'config' => [
        // 菜单配置
        'menu' => [
            'location' => 'addons', // default:系统顶部菜单;addons:应用中心菜单
            'icon' => 'fa fa-puzzle-piece',
            'pattern' => [], // 可见开发模式 b2c、b2b2c、saas 不填默认全部可见, 可设置为 blank 为全部不可见
        ],
        // 子模块配置
        'modules' => [
            'v1' => [
                'class' => 'addons\RfDemo\api\modules\v1\Module',
            ],
            'v2' => [
                'class' => 'addons\RfDemo\api\modules\v2\Module',
            ],
            'merV1' => [
                'class' => 'addons\RfDemo\api\modules\merV1\Module',
            ],
        ],
    ],

    // ----------------------- 菜单配置 ----------------------- //

    'menu' => [

    ],

    // ----------------------- 权限配置 ----------------------- //

    'authItem' => [
    ],
];
