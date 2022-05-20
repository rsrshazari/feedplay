<?php
session_start();
$google_client_id 		= '271628211704.apps.googleusercontent.com';
$google_client_secret 	= 'VNLLZp4za9cMyvGkcSXnZugI';
$google_redirect_url 	= 'http://www.jaskalsi.com/football';
$google_developer_key 	= 'AIzaSyCoM7hnId29NaBi-kfnA8y9UAcQO2_BuLc';
require_once '../src/Google_Client.php';
require_once '../src/contrib/Google_Oauth2Service.php';

$gClient = new Google_Client();
$gClient->setApplicationName('Login to Footballlink.com');
$gClient->setClientId($google_client_id);
$gClient->setClientSecret($google_client_secret);
$gClient->setRedirectUri($google_redirect_url);
$gClient->setDeveloperKey($google_developer_key);

$google_oauthV2 = new Google_Oauth2Service($gClient);
$authUrl = $gClient->createAuthUrl();
?>
