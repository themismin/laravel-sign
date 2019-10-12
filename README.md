# laravel-sign

Laravel sign 接口加密验证扩展包

### 安装

```bash
composer require themismin/laravel-sign

php artisan vendor:publish --provider="ThemisMin\LaravelSign\ServiceProvider"
```

### 配置
> laravel-sign.php 修改配置文件参数


### 加密方式
1. 请求参数按key排序
2. 拼接所有请求参数 $k1 + $v1 + $k2 + $v2 + SIGN_KEY
3. 对拼接对参数进行MD5加密，sign
4. 验证sign参数是否一致

```php
$params = $request->except(['sign']);
ksort($params);
$str = ''
foreach($params as $k => $v) {
    // $v 为 array 递归拼接
    $str .= $k . $v;
}
$str .= SIGN_KEY
$sign = md5($str);

if ($sign === $request->get(sign)) {
    return true;
}
return false;
```