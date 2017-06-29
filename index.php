<?php

include 'TwitterAPI.php';
$twitterCon = TwitterAPI::getInstance();
$twitterCon->trendsPlace("Brazil");
