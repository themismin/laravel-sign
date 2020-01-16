<?php
return [
    // 是否开启接口加密
    'enable' => env('SIGN_ENABLE', false),

    // 是否开启签名日志
    'log_enable' => env('SIGN_LOG_ENABLE', false),

    // 接口加密KEY
    'key' => env('SIGN_KEY', '1234567890'),

    // 加密时排除在外的参数
    'except' => [
        'upload_file'
    ]
];