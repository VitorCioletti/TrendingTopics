<?php

require "vendor/autoload.php";
include "TwitterKey.php"; // A way to hide API keys.
include "GeoPlanet.php";

use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterAPI {

    private static $connection;
    private static $instance;
    private static $twitterKey;

    private function __construct() {

    }

    public static function getInstance() {
        if (!isset(TwitterAPI::$connection)) {
            TwitterAPI::$instance = new TwitterAPI();
            TwitterAPI::$twitterKey = new TwitterKey();
            TwitterAPI::$connection = new TwitterOAuth(TwitterAPI::$twitterKey->consumerKey, TwitterAPI::$twitterKey->consumerSecret, TwitterAPI::$twitterKey->accessToken, TwitterAPI::$twitterKey->accessTokenSecret);
            return TwitterAPI::$instance;
        } else {
            return TwitterAPI::$instance;
        }
    }

    /**
     * Prints recent 10 tweets by key word.
     * @param $keyWord Key word to the query.
     */
    public function recentTweetsWord($keyWord) {
        $json = TwitterAPI::$connection->get('search/tweets', array("q" => "$keyWord", "recent_type" => "recent", "count" => "10"));
        foreach ($json->statuses as $i => $i) {
            echo ("<br> $i  -" . $json->statuses[$i]->text . "</br>"); //Give attention to this expression. It does not seems good. Study more.
        }
    }

    /**
     * Builds a dictionary with tweets that have trending topics in it.
     * @param $trending Array with trending topics.
     */
    public function trendTweets($trending = array()) {
        foreach ($trending as $i => $i) {
            $this->recentTweetsWord($trending[$i]); #UNDER CONSTRUCTION
        }
    }

    private function getUser($userName) {
        $json = TwitterAPI::$connection->get('users/lookup', array("screen_name" => "$userName", "include_entities" => false));
        return ($json[0]->id);
    }

    /**
     * Prints last tweets of a certain user..
     * @param $userName Twitter name of the user.
     */
    public function userTweets($userName) {
        $id = $this->getUser($userName);
        $json = TwitterAPI::$connection->get('statuses/user_timeline', array("user_id" => $id, "screen_name" => $userName));
        foreach ($json as $i => $i) {
            echo ("<br> $i - " . $json[$i]->text . "</br>");
        }
    }

    /**
     * Prints trending topics by country.
     * @param $placeName Name of the country.
     */
    public function trendsPlace($placeName) {
        $geoPlanet = new GeoPlanet();
        $json = TwitterAPI::$connection->get('trends/place', array("id" => $geoPlanet->getWoeid($placeName)));
        foreach ($json[0]->trends as $i => $i) {
            $trendingList[$i] = $json[0]->trends[$i]->name;
            echo ("<br>$i - " . $json[0]->trends[$i]->name . "</br>"); //Give attention to this expression. It does not seems good. Study more.
        }
        return $trendingList;
    }

}
