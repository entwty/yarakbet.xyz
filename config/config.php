<?php
$config["default_contoller"]="home";
include(DOCUMENT_ROOT."config/".str_replace("www.","",$_SERVER["SERVER_NAME"]).".php");
define("CONTENT_URL",BASE_URL."/content/".$GLOBALS["tema"]."/");

//GENEL
define('SITE_NAME', "Betabahis");
define('SITE_URL', "betsapi.tech");
define('SITE_MAIL', "info@betsapi.tech");
define('ACTIVE_SITE_URL', "betsapi.tech");

define('INSTAGRAM_URL', "https://www.instagram.com/#/");
define('TWITTER_URL', "https://twitter.com/");
define('FACEBOOK_URL', "https://www.facebook.com/");

//HOGAMING
define('HOGAMING_KEY', 'sZHwnSfiyzibet2');
define('HOGAMING_SECRET', '3wqhaRzwjKVtYsiJoFfgs74uJlU2iyzibet2');

//HOGAMING
define('LIVEGAMES_KEY', 'sZHwnSfiyzibet2');
define('LIVEGAMES_SECRET', '3wqhaRzwjKVtYsiJoFfgs74uJlU2iyzibet2');

// SİTE LİSANS
define('LICENSE_KEY', 'validateview.aspx?domain=betsapi.tech');
define('LICENSE_NUMBER', 'C84078');
define('COMPANY_NAME', 'Betabahis');
define('COMPANY_NAME1', 'Betabahis');
define('WHATSAPP', '+90 555 555 55 55');
define('VIBER', '#');
define('TELEGRAM', '#');

define('REDIS_KEY','Win');
define('REDIS_PASSWORD','qpzintpkrkvibne4');

//GOLDENRACE
define('GR_SITE_ID', '506895');
define('GR_PRIVATE_KEY', 'AH2MZ63LNCEKUWO4Y58');
define('GR_PUBLIC_KEY', 'W2BI4C6MAV8U1G');
define('GR_LAUNCHER_URL', 'https://inplaysoftprod.hub.xpressgaming.net');
define('GR_API_URL', 'https://inplaysoftprod.api-hub.xpressgaming.net/api/v3/*');
define('GR_BACK_URL', 'https://betsapi.tech');
define('GR_DEPOSIT_URL', 'https://betsapi.tech/deposit');
define('GR_LANGUAGE', 'tr');

// ALG GAMING
