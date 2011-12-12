<?
    include "../libs/libs.inc";
    /*
     * ALL CUSTOM AJAX REFERENCES HAPPENS HERE
     */

    $action = ((isset($_POST['action'])) ? ( (!empty($_POST['action'])) ? $_POST['action'] : false ) : false);

    switch($action) {
        case 'log': jx_log(); break;
        default: respond(false, 'invalid action');
    }


    function jx_log() {
        header('Content-Type: application/json; charset=utf-8');

        $msg =  (isset($_POST['msg'] )) ? ( (!empty($_POST['msg'] )) ? $_POST['msg']  : false ) : false;
        $type = (isset($_POST['type'])) ? ( (!empty($_POST['type'])) ? $_POST['type'] : 'ajax' ) : 'ajax';

        if($msg) respond(true, $msg);
        else respond(false, 'empty msg');
    }

?>
