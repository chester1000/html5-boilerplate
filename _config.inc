<?
    ini_set('error_reporting', E_ALL);
    error_reporting(E_ALL);
    ini_set('log_errors', TRUE);
    ini_set('error_log', dirname(__FILE__).'/log/php.log');

    if(((isset($test) ) ? $test : false)) {
        // if test mode
        ini_set('html_errors', TRUE);
        ini_set('display_errors', TRUE);
    } else {
        $test = false;
        ini_set('html_errors', FALSE);
        ini_set('display_errors', FALSE);
    }

    require_once "_db_vars.inc";

    $lang = "pl";

    /*********************************
     * Database connection
     * - $db array is in _db_vars.inc
     *********************************/

    if($db['on']) {

        $db_c = mysql_pconnect($db['host'], $db['user'], $db['pass']); // persistent connection
        if(!$db_c) {
            toLog('MySQL error while connecting to: "' . $db['host'] . '" as: "' . $db['user'] . '"', 'error');
            $db_s = false;
        } else {
            $db_s = mysql_select_db($db['name'], $db_c);
            if(!$db) toLog('MySQL error while selecting "' . $db['name'] . '"', 'error');
        }

        // raport error if it's not test
        if(!$test and (!$db_c or !$db_s)) {
            header('HTTP/1.0 500 Internal Server Error');
            exit("<h1>500 Internal Server Error</h1>\n<p>The server encountered an unexpected condition which prevented it from fulfilling the request. (".((!$db_c)?"connect":"select").")</p>");
        }
    }


    /******************
     * Reference stats
     ******************/

    session_start();
    if(isset($_GET['utm_source'])) {
        $_SESSION['source'] = $_GET['utm_source'];
        $_SESSION['medium'] = (isset($_GET['utm_medium'])) ? $_GET['utm_medium'] : false;
    } elseif(isset($_GET['from'])) $_SESSION['source'] = $_GET['from'];
    elseif(!isset($_SESSION['source'])) $_SESSION['source'] = $_SESSION['medium'] = false;


    /********************
     * Facebook settings
     ********************/

    $fb = Array();
    $fb['on'] = false; // change this to true after filling in all fb data

    if($fb['on']) {

        if($db['on']) {
            if($db['fb_in_db']) {
                // retreive fb settings from db
            }
        } else {
            $fb['app_id'] = 'YOUR_APP_ID'; // yours application app ID
            $fb['secret'] = 'YOUR_APP_SECRET'; // yours application secret

            $fb['email']  = false; // should email  be retreived and saved to this field
            $fb['avatar'] = false; // should avatar be retreived and saved to this field
            $fb['likes']  = false; // should likes  be retreived and saved to this field
            // ... other to be added l8r
        }
    }


    
?>