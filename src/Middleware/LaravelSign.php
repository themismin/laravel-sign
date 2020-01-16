<?php

namespace ThemisMin\LaravelSign\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

/**
 * Class LaravelSign: 接口参数加密校验
 * @package ThemisMin\LaravelSign\Middleware
 */
class LaravelSign
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (config('laravel-sign.enable')) {

            $logEnable = config('laravel-sign.log_enable');

            $key = config('laravel-sign.key');

            $sign = $request->get('sign');

            $except = config('laravel-sign.except');

            $data = $request->except(array_merge($except, ['sign']));

            if (is_array($data)) {
                if ($logEnable) {
                    Log::info('sign str:' . $this->sortToStr($data));
                }
                $resultSign = md5($this->sortToStr($data) . $key);
            } else {
                $resultSign = md5($key);
            }

            if ($sign != $resultSign) {
                Log::error('sign error', $request->all());
                return response_json('sign error', 500);
            }
        }
        return $next($request);
    }

    protected function sortToStr($data = null)
    {
        $str = '';
        if (is_array($data)) {
            ksort($data);
            foreach ($data as $key => $val) {
                $str .= $key . $this->sortToStr($val);
            }
        } else {
            $str = $data;
        }
        return $str;
    }
}
