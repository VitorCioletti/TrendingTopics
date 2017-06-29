<?php

include 'TwitterAPI.php';
$twitterCon = TwitterAPI::getInstance();
#$twitterCon->trendsPlace("Brazil");
#$twitterCon->userTweets("jovemnerd");
$twitterCon->trendTweets($twitterCon->trendsPlace("Brazil"));
