<?php
//Website Info

$webName = "Financial Broker Success Kenya";
$webShortName = "FBsuccessKY";
$webLogo = "img/fbs_logo.png";
$webKey = "Financial empowerment, investment, kenya, invest wisely and get your profit";
$webDesc = "Sign up for Financial broker success kenya is a peer to peer platform";
$webUrl = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

function getDomain($url) {
  $result = parse_url($url);
  return $result['scheme']."://".$result['host'];
}

?>