<?php
/**
 * Created by PhpStorm.
 * User: Hong
 * Date: 2018/3/9
 * Time: 11:45
 * Function:
 */
return [
    /**
     * 项目名
     */
    'name' => '管理后台',

    /*
     * Logo
     */
    'logo'      => '<b>Admin</b>LTE',

    /*
     * Mini-logo
     */
    'logo-mini' => '<b>A</b>LT',

    /**
     * 超级管理员ID，最高权限
     */
    'administrators' => [1],

    /*
     * 后台安装路径
     */
    'directory' => app_path('Admin'),

    /**
     * 管理后台命名空间
     */
    'namespace' => 'App\Admin\Controllers\\',

    /**
     * 默认标题
     */
    'header' => '标题',

    /**
     * 默认描述
     */
    'description' => '描述...',

    /*
     * Use `https`.
     */
    'secure' => false,

    /*
     * 认证配置，与config/auth.php合并
     */
    'auth' => [
        'guards' => [
            'admin' => [
                'driver'   => 'session',
                'provider' => 'admin',
            ],
        ],

        'providers' => [
            'admin' => [
                'driver' => 'eloquent',
                'model'  => Tanmo\Admin\Models\Administrator::class
            ],
        ],
    ],

    /**
     * 数据库配置
     */
    'database' => [
        'connection' => '',

        'administrator' => [
            'table' => 'admins'
        ],

        'menu' => [
            'table' => 'admin_menu'
        ],

        'operation_log' => [
            'table' => 'admin_operation_log'
        ],

        'permission' => [
            'table' => 'admin_permissions'
        ],

        'role' => [
            'table' => 'admin_roles'
        ],

        'role_permission' => [
            'table' => 'admin_role_permissions'
        ],

        'role_user' => [
            'table' => 'admin_role_users'
        ]
    ],

    /**
     * 上传配置
     */
    'upload' => [
        'disk' => [
            'avatar' => 'public'
        ]
    ],

    /**
     * 操作日志配置
     */
    'operation_log'   => [
        /**
         * 是否开启操作日志记录
         */
        'enable' => true,

        /**
         * 不需要记录日志的路由
         *
         * 过滤所有的请求方式: admin/auth/logs
         * 过滤单个请求方式: get:admin/auth/logs
         */
        'except' => [
            'admin/system/logs*',
        ],
    ],

    /**
     * 技术支持
     */
    'power_by' => [
        'url' => '#',
        'title' => 'Company'
    ],

    /**
     * 版权
     */
    'copyright' => [
        'year' => '2018',
        'url' => '#',
        'company' => 'Company'
    ]
];