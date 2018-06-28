<?php

namespace App\CustomStaff\Authorization;

use Illuminate\Support\Facades\Session;
use App\CustomStaff\Places\Coordinate;

/**
 * todo - сделать интерфейс UserCoordinatesProvider, от него реализовывать:
 * todo -       UserCoordinates_Google, UserCoordinates_Yandex
 * todo -       p.s. смотри, мож я ошибся ибо провайдер можно спутать с некоей фабрикой
 *
 * Class GoogleYandexCoordinates
 * @package App\CustomStaff\Authorization
 */
class GoogleYandexCoordinates
{

    /*Получение Основной информации о пользователи, производящим вход через вк*/
    public function getMainUserInfo()
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->get('https://geocode-maps.yandex.ru/1.x/?', [
            'query' => [
                'format' => 'json',
                'geocode' => 'Владивосток,%20улица%20Нерчинская,%20дом40'
            ]
        ]);

//        $resp = json_decode($response->getBody(), true);
//        var_dump($resp['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos']);
//            ->response->GeoObjectCollection->
//        featureMember->GeoObject); //->response
        die;


        return json_decode($response->getBody());
    }

    /*Получение Основной информации о пользователи, производящим вход через вк*/
    public function getGoogleCoordinates()
    {
        //Guzzle)
        $client = new \GuzzleHttp\Client();

        /*Внизу задается Город Улица номер дома*/
        $response = $client->get('http://maps.google.com/maps/api/geocode/json?', [
            'query' => [
                'address' => 'Москва композиторская 21'
            ]
        ]);

        $resp = json_decode($response->getBody(), true);
        $lat = $resp['results'][0]['geometry']['location']['lat'];
        $lng = $resp['results'][0]['geometry']['location']['lng'];
        
        $coordinate = new Coordinate($lat, $lng);

        return $coordinate;
    }
}