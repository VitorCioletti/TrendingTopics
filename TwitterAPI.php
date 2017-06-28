<?php

require "vendor/autoload.php";
include "TwitterKey.php"; // A way to hide API keys.
include "GeoPlanet.php";

use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterAPI {

    public $connection;
    private $twitterKey;

    public function TwitterAPI() {
        $this->twitterKey = new TwitterKey();
        $this->connection = new TwitterOAuth($this->twitterKey->consumerKey, $this->twitterKey->consumerSecret, $this->twitterKey->accessToken, $this->twitterKey->accessTokenSecret);
    }

    /**
     * Prints recent 10 tweets by key word.
     * @param $keyWord Key word to the query.
     */
    public function recentTweetsWord($keyWord) {
        $json = $this->connection->get('search/tweets', array("q" => "$keyWord", "recent_type" => "recent", "count" => "10"));
        foreach ($json->statuses as $i => $item) {
            echo ("<br> $i  -" . $json->statuses[$i]->text . "</br>"); //Give attention to this expression. It does not seems good. Study more.
        }
    }

    /**
     * Prints trending topics by country.
     * @param $placeName Name of the country.
     */
    public function trendsPlace($placeName) {
        $geoPlanet = new GeoPlanet();
        $json = $this->connection->get('trends/place', array("id" => $geoPlanet->getWoeid($placeName)));
        foreach ($json[0]->trends as $i => $item) {
            echo ("<br>$i - " . $json[0]->trends[$i]->name . "</br>"); //Give attention to this expression. It does not seems good. Study more.
        }
    }

}
