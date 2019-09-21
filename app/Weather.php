<?php


namespace App;


use GuzzleHttp\Client;

class Weather
{
    private $token = '';

    protected $lang = 'ru_RU';

    protected $lat = '';

    protected $lon = '';

    public $status = null;

//    protected $url = 'https://api.weather.yandex.ru/v1/informers?';
    protected $url = 'https://api.weather.yandex.ru/v1/forecast/';

    public $data;

    /**
     * Weather constructor.
     * @param string $lat
     * @param string $lon
     */
    public function __construct($lat, $lon)
    {
        $this->lat = $lat;
        $this->lon = $lon;

        $this->token = env('YANDEX_API_KEY', false);
    }

    public function loadData()
    {
        $url =  '?lat=' . $this->lat . '&lon=' . $this->lon . '&lang=' . $this->lang;

        $client = new Client([
            'base_uri'=>$this->url
        ]);

        $response = $client->request('GET', $url, [
            'headers'=> [
                'X-Yandex-API-Key' => $this->token
            ]
        ]);

        $this->status = $response->getStatusCode();

        if ($this->status==200) {
            $this->data = json_decode($response->getBody()->getContents());
        }
    }

    /**
     * @return string
     */
    public function getLang(): string
    {
        return $this->lang;
    }

    /**
     * @param string $lang
     */
    public function setLang(string $lang)
    {
        $this->lang = $lang;
    }

    /**
     * @return null
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param null $lat
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * @return null
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * @param null $lon
     */
    public function setLon($lon)
    {
        $this->lon = $lon;
    }

    /**
     * Возвращаем температуру
     * @return mixed
     */
    public function getCurrentTemp()
    {
        return $this->data->fact->temp;
    }

    /**
     * Возвращаем направление ветра
     * @return mixed|string
     */
    public function getWindDirection()
    {
        $data = [
            'nw'=>'северо-западное',
            'n'=>'северное',
            'ne'=>'северо-восточное',
            'e'=>'восточное',
            'se'=>'юго-восточное',
            's'=>'южное',
            'sw'=>'юго-западное',
            'w'=>'западное',
            'c'=>'штиль'
        ];

        return (isset($data[$this->data->fact->wind_dir]))?$data[$this->data->fact->wind_dir]:'-';
    }

    /**
     * Возвращаем текстовое описание
     * @return mixed|string
     */
    public function getCondition()
    {
        $data = [
            'clear'=>'ясно',
            'partly-cloudy'=>'малооблачно',
            'cloudy'=>'обласно с прояснениями',
            'overcast'=>'пасмурно',
            'partly-cloudy-and-light-rain'=>'небольшой дождь',
            'partly-cloudy-and-rain'=>'дождь',
            'overcast-and-rain'=>'сильный дождь',
            'overcast-thunderstorms-with-rain'=>'сильный дождь, гроза',
            'cloudy-and-light-rain'=>'небольшой дождь',
            'overcast-and-light-rain'=> 'небольшой дождь',
            'cloudy-and-rain'=> 'дождь',
            'overcast-and-wet-snow'=> 'дождь со снегом',
            'partly-cloudy-and-light-snow'=> 'небольшой снег',
            'partly-cloudy-and-snow'=> 'снег',
            'overcast-and-snow'=> 'снегопад',
            'cloudy-and-light-snow'=> 'небольшой снег',
            'overcast-and-light-snow'=> 'небольшой снег',
            'cloudy-and-snow'=> 'снег',
        ];

        return (isset($data[$this->data->fact->condition]))?$data[$this->data->fact->condition]:'-';
    }

    /**
     * Возвращаем скорость ветра
     * @return mixed
     */
    public function getWindSpeed()
    {
        return $this->data->fact->wind_speed;
    }

    /**
     * Возвращаем давление
     * @return mixed
     */
    public function getPressure()
    {
        return $this->data->fact->pressure_mm;
    }

    /**
     * Возвращаем влажность
     * @return mixed
     */
    public function getHumidity()
    {
        return $this->data->fact->humidity;
    }
}