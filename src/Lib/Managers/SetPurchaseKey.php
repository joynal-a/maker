<?php

namespace Abedin\Maker\Lib\Managers;

class SetPurchaseKey extends Manager
{
    public static function set(): void
    {
        $key = request()->purchase_code;
        if($key){
            parent::setPurchaseKey($key);
        }
    }
}
