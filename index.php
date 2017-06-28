<?php

include 'TwitterAPI.php';
$twitterCon = new TwitterAPI();
$twitterCon->trendsPlace("Brazil");
