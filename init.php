<?php

    defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

    defined('SITE_ROOT') ? null : define('SITE_ROOT', DS . 'wamp64' . DS . 'www'. DS . 'electricity_sales_reporting');

    defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT.DS.'class');

    //classes
    require_once("class/db.php");
    require_once("class/functions.php");
    require_once("class/db_object.php");
    require_once("class/sale.php");
    require_once("class/power.php");

    //User Specific
    require_once("class/user.php");
    require_once("class/session.php");

    //functions
    require_once("functions/time_ago.php");
    require_once("functions/pretty_url.php");
    require_once("functions/get_name.php");
    require_once("functions/get_count.php");
    require_once("functions/get_sum.php");
    require_once("functions/user_validations.php");
    require_once("functions/site_info.php");

?>