<?php

namespace Modules\Payment\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProcessPersianArabicNumbers
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $request->merge($this->convertNumbers($request->all()));

        return $next($request);
    }

    protected function convertNumbers(array $input)
    {
        $persianArabicNumbers = [
            '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4',
            '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9',
            '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4',
            '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9'
        ];

        array_walk_recursive($input, function (&$item) use ($persianArabicNumbers) {
            $item = strtr($item, $persianArabicNumbers);
        });

        return $input;
    }
}
