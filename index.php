<?php

include 'TwitterAPI.php';
include 'BannerTypeEnum.php';
$twitterCon = TwitterAPI::getInstance();
#$twitterCon->getTrendingTopicByPlace("Brazil");
#$img = $twitterCon->getUserBanner("jovemnerd", BannerTypeEnum::ipad);
#echo "<img src=$img>";
$twitterCon->getAccountCredentialsStatus();
