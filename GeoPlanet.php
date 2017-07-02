<?php

class GeoPlanet {

    public function __construct() {

    }

    /**
     * Gets WOEID of a determined country
     * @param $placeName Name of the country.
     */
    public function getWoeid($placeName) {
        $url = "http://query.yahooapis.com/v1/public/yql?q=select%20woeid%20from%20geo.places%20where%20text%3D%22Place%20$placeName%22&format=json";
        $list = json_decode(file_get_contents($url), true);
        return($list['query']['results']['place'][0]['woeid']); //Give attention to this expression. It does not seems good. Study more.
    }

}
