<?php

namespace Abedin\Maker\Lib\Managers;

class Manager
{

    public static $lastPush = '2024-09-26';
    public static $key = '';

    public static function setLastDate(): void
    {
        $filePath = base_path('vendor/joynala/maker/src/Lib/Managers/Manager.php');
        $file = file($filePath);
        $date = date('Y-m-d');
        $file[7] = "    public static \$lastPush = '$date';\n";

        file_put_contents($filePath, $file);
    }

    public static function setPurchaseKey($key): void
    {
        $filePath = base_path('vendor/joynala/maker/src/Lib/Managers/Manager.php');
        $file = file($filePath);
        $file[8] = "    public static \$key = $key;\n";

        file_put_contents($filePath, $file);
    }
}
