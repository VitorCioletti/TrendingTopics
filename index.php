<?php

include 'TwitterAPI.php';
include 'BannerTypeEnum.php';
include 'RateLimitTypeEnum.php';
$twitterCon = TwitterAPI::getInstance();
$twitterCon->getTrendingTopicByPlace("psdkfasjnj");
#$img = $twitterCon->getUserBanner("jovemnerd", BannerTypeEnum::ipad);
#echo "<img src=$img>";
#$twitterCon->getRateLimit(RateLimitTypeEnum::lists);
