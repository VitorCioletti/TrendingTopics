<?php

interface ITwitterAPI {

    /**
     * Builds a dictionary with tweets that have trending topics in it.
     * @param $trending Array with trending topics.
     */
    function getTrendingTopicTweets();

    /**
     * Prints recent 10 tweets by key word.
     * @param $keyWord Key word to the query.
     */
    function getRecentTweetsByWord($keyWord);

    /**
     * Prints last tweets of a certain user..
     * @param $userName Twitter name of the user.
     */
    function getUserTweets($userName);

    /**
     * Prints trending topics by country.
     * @param $placeName Name of the country.
     * @return List of the trending ropics
     */
    function getTrendingTopicByPlace($placeName);

    /**
     * Get banner of a certain user
     * @param $userName Name of the user.
     * @param $enumType BannerTypeEnum attribute.
     * @return Banner url
     */
    function getUserBanner($userName, $enumType);

    /**
     * Get information on account that provided Twitter API keys.
     * @return Std object with all informations.
     */
    function getAccountSettings();

    function getAccountCredentialsStatus();

    /**
     * Get information on account request limits
     * @param $selection RateLimitTypeEnum object.
     * @return Std object with all informations.
     */
    function getRateLimit($selection);
}
