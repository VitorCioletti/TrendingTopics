<?php

include 'TwitterAPI.php';
include 'BannerTypeEnum.php';
$twitterCon = TwitterAPI::getInstance();
#$twitterCon->trendsPlace("Brazil");
#$twitterCon->userTweets("jovemnerd");
$twitterCon->userBanner("jovemnerd", BannerTypeEnum::ipad);
