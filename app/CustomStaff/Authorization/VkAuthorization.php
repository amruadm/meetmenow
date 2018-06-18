<?php

namespace App\CustomStaff\Authorization;

use Illuminate\Support\Facades\Session;

class VkAuthorization {

    protected $proxy = '109.126.12.58:3128';
    /*connect через curl/file_get_contents для получения token*/
    public function get_curl($url) {
        if(function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            //curl_setopt($ch, CURLOPT_PROXY, $this->proxy);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $output = curl_exec($ch);
            echo curl_error($ch);
            curl_close($ch);
            return $output;
        } else {
            $aContext = array(
//                'http' => array(
//                    'proxy' =>  $this->proxy,
//                    'request_fulluri' => true,
//                ),
            );
            $cxContext = stream_context_create($aContext);
            return file_get_contents($url, false, $cxContext);
        }
    }

    /*Функция на запрос Access token*/
    public function getAccessToken($request) {
        $dlurl = "https://geocode-maps.yandex.ru/1.x/?format=json&geocode=Moscow,%20street%20new%20Arbat,%20house";
        $dlurl = str_replace(' ', '', $dlurl); // remove spaces
        $dlurl = str_replace("\t", '', $dlurl); // remove tabs
        $dlurl = str_replace("\n", '', $dlurl); // remove new lines
        $dlurl = str_replace("\r", '', $dlurl); // remove carriage returns
        $contents = $this->get_curl($dlurl);

        var_dump($contents);
        die;

        $request_access_token = json_decode($contents);

        var_dump($request_access_token);
        die;
        return $request_access_token;
    }

    /*Зарегистрирован ли через Вк уже пользователь, если да возвращаем access_token*/
    public function isAlreadyRegistered($request, $access_token) {
        $request_access_token = null;

        if(!isset($access_token)) {
            $request_access_token = $this->getAccessToken($request);
        }

        return $request_access_token;
    }

    /*Получение Основной информации о пользователи, производящим вход через вк*/
    public function getMainUserInfo()
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->get('https://geocode-maps.yandex.ru/1.x/?', [
            'query' => [
                'format' => 'json',
                'geocode' => 'Moscow,%20street%20new%20Arbat,%20house'
            ]
        ]);

//        $token = $response->getBody()->getContents()
//
//            $url = 'https://geocode-maps.yandex.ru/1.x/?format=json&geocode=Moscow,%20street%20new%20Arbat,%20house';
//            $client = new \GuzzleHttp\Client();
//            $response = $client->request('GET', $url, [
////                'proxy' => [
////                    'http' => 'tcp://'.$this->proxy, //
////                    'https' => 'tcp://'.$this->proxy, //
////                ],
//                'form_params' => [
//                    'format' => 'json',
//                    'geocode' => 'Moscow,%20street%20new%20Arbat,%20house'
//                ],
//                'verify' => false
//
//            ]);
        $resp = json_decode($response->getBody(), true);
        var_dump($resp);
        die;
            return json_decode($response->getBody());
    }

    /*Получение Основной информации о пользователи, производящим вход через вк*/
    public function getGoogleCoordinates()
    {
        //Guzzle)
        $client = new \GuzzleHttp\Client();

        $response = $client->get('http://maps.google.com/maps/api/geocode/json?', [
            'query' => [
                    'address' => '1600+Amphitheatre+Parkway,+Mountain+View,+CA
'
            ]
        ]);

//        $token = $response->getBody()->getContents()
//
//            $url = 'https://geocode-maps.yandex.ru/1.x/?format=json&geocode=Moscow,%20street%20new%20Arbat,%20house';
//            $client = new \GuzzleHttp\Client();
//            $response = $client->request('GET', $url, [
////                'proxy' => [
////                    'http' => 'tcp://'.$this->proxy, //
////                    'https' => 'tcp://'.$this->proxy, //
////                ],
//                'form_params' => [
//                    'format' => 'json',
//                    'geocode' => 'Moscow,%20street%20new%20Arbat,%20house'
//                ],
//                'verify' => false
//
//            ]);
        $resp = json_decode($response->getBody(), true);
        var_dump($resp);
        die;
        return json_decode($response->getBody());
    }



    /*Получение информации друзьях пользователя*/
    public function getUserFriendsInfo($request_access_token, $access_token)
    {
        if (isset($request_access_token['access_token']) || isset($access_token)) {
            if (!isset($access_token)) {
                $token = $request_access_token['access_token'];
                Session::put('access_token', $token);
            } else {
                $token = Session::get('access_token');
            }

            $url = 'https://api.vk.com/method/friends.get';
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', $url, [
//                'proxy' => [
//                    'http' => 'tcp://'.$this->proxy, //
//                    'https' => 'tcp://'.$this->proxy, //
//                ],
                'form_params' => [
                    'fields' => 'photo_50',
                    'order' => 'random',
                    'count' => 5,
                    'name_case' => 'Nom',
                    'access_token' => $token,
                    'v' => '5.74'
                ],
                'verify' => false
            ]);

            return json_decode($response->getBody());
        }
    }


}