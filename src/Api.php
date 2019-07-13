<?php
/**
 * Created by Nguyen Van Tinh
 * Date: 7/12/19
 * Time: 11:44 PM
 */

namespace Zira\Api;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class Api
{
    public static function get($url, $data = [])
    {
        return self::sendRequest($url, 'get', $data);
    }

    public static function post($url, $data = [])
    {
        return self::sendRequest($url, 'post', $data);
    }

    public static function put($url, $data = [])
    {
        return self::sendRequest($url, 'put', $data);
    }

    public static function delete($url, $data = [])
    {
        return self::sendRequest($url, 'delete', $data);
    }

    public static function sendRequest($url, $method, $data = [])
    {
        $client = new Client();
        switch (strtolower($method)) {
            case 'post':
                $method = 'post';
                break;
            case 'put':
                $method = 'put';
                break;
            case 'delete':
                $method = 'delete';
                break;
            default:
                $method = 'get';
        }
        /**@var $response Response**/
        $response = $client->$method($url, $data);
        return [
            'status' => $response->getStatusCode(),
            'data' => json_decode($response->getBody()),
        ];
    }

}