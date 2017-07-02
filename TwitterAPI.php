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
    public function getRecentTweetsByWord($keyWord) {
        $recent = array();
        $json = TwitterAPI::$connection->get('search/tweets', array("q" => "$keyWord", "recent_type" => "recent", "count" => "10"));
        if (!isset($json)) {
            foreach ($json->statuses as $i => $i) {
                $recent = $json->statuses[$i]->text;
                echo ("<br> $i  -" . $json->statuses[$i]->text . "</br>"); //Give attention to this expression. It does not seems good. Study more.
            }
            return $recent;
        } else {
            echo "<br> No values returned!</br> ";
            return null;
        }
    }

    /**
     * Builds a dictionary with tweets that have trending topics in it.
     * @param $trending Array with trending topics.
     */
    public function getTrendingTopicTweets($trending = array()) {
        if (sizeof($trending) >= 1) {
            foreach ($trending as $i => $i) {
                $values[$trending[$i]] = $this->getRecentTweetsByWord($trending[$i]);
            }
            var_dump($values);
        } else {
            echo "<br>List of trending topics is null </br>";
        }
    }

    /**
     * Get information on a certain user.
     * @param $userName Twitter name of the user.
     */
    private function getUserID($userName) {
        $json = TwitterAPI::$connection->get('users/lookup', array("screen_name" => "$userName", "include_entities" => false));
        if (!isset($json)) {
            return ($json[0]->id);
        } else {
            return null;
        }
    }

    /**
     * Prints last tweets of a certain user..
     * @param $userName Twitter name of the user.
     */
    public function getUserTweets($userName) {
        $id = $this->getUserID($userName);
        $json = TwitterAPI::$connection->get('statuses/user_timeline', array("user_id" => $id, "screen_name" => $userName));
        if (!isset($json) || !isset($id)) {
            foreach ($json as $i => $i) {
                echo ("<br> $i - " . $json[$i]->text . "</br>");
            }
        } else {
            echo "<br>Null values</br>";
        }
    }

    /**
     * Prints trending topics by country.
     * @param $placeName Name of the country.
     * @return List of the trending ropics
     */
    public function getTrendingTopicByPlace($placeName) {
        $geoPlanet = new GeoPlanet();
        $woeid = $geoPlanet->getWoeid($placeName);
        if (!is_null($woeid)) {
            $json = TwitterAPI::$connection->get('trends/place', array("id" => $woeid));
            if (sizeof($json[0]->trends) >= 1) {
                foreach ($json[0]->trends as $i => $i) {
                    $trendingList[$i] = $json[0]->trends[$i]->name;
                    echo ("<br>$i - " . $json[0]->trends[$i]->name . "</br>"); //Give attention to this expression. It does not seems good. Study more.
                }
                return $trendingList;
            } else {
                echo "<br>Error, there are null values</br>";
            }
        } else {
            echo "<br>GeoPlanet WOEID is null</br>";
        }
    }

    /**
     * Get banner of a certain user
     * @param $userName Name of the user.
     * @param $enumType BannerTypeEnum attribute.
     * @return Banner url
     */
    public function getUserBanner($userName, $enumType) {
        if (!is_null($userName)) {
            $json = TwitterAPI::$connection->get('users/profile_banner', array('screen_name' => $userName));
            if (!is_null($json)) {
                return ($json->sizes->$enumType->url);
            } else {
                echo "Requisition got null results";
            }
        } else {
            echo "Null value";
        }
    }

}
