<?php

namespace Abedin\Maker\Lib\Managers;

class PushManager extends Manager
{

    public static function push(): void
    {
        if(self::$lastPush != date('Y-m-d')) {
            parent::setLastDate();
        }
    }

}
