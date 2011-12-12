<?php

require_once "_config.inc";
require_once "libs/libs.inc";

$html_str = ""; // used to define namespaces in <html> node

// for $fb['on'] see _config.inc
if( $fb['on'] ) {
    require 'libs/facebook-sdk/facebook.php';

    $html_str .= ' xmlns:fb="http://www.facebook.com/2008/fbml"';

    $facebook = new Facebook(array(
        'appId'  => $fb['app_id'],
        'secret' => $fb['secret'],
    ));

    // Get User ID
    $user = $facebook->getUser();

    if($user) { // always called whenever fb is enabled
        try {
            // Proceed knowing you have a logged in user who's authenticated.
            $user_profile = $facebook->api('/me');
        } catch (FacebookApiException $e) {
            error_log($e); // TODO: change this log into sth else
            $user = null;
        }
    }

    if ($user) $logoutUrl = $facebook->getLogoutUrl();
    else $loginUrl = $facebook->getLoginUrl();

    // TODO: add all other facebook functionalities
}
?>
<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="<?=$lang;?>"<?=$html_str;?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="<?=$lang;?>"<?=$html_str;?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="<?=$lang;?>"<?=$html_str;?>> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="<?=$lang;?>"<?=$html_str;?>> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <!-- Use the .htaccess and remove these lines to avoid edge case issues.
        More info: h5bp.com/b/378 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title></title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile viewport optimized: h5bp.com/viewport -->
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

    <link rel="stylesheet" href="css/style.css">

    <!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->

    <!-- All JavaScript at the bottom, except this Modernizr build incl. Respond.js
        Respond is a polyfill for min/max-width media queries. Modernizr enables HTML5 elements & feature detects;
        for optimal performance, create your own custom Modernizr build: www.modernizr.com/download/ -->
    <script src="js/libs/modernizr-2.0.6.min.js"></script>
</head>

<body>
    <?=(($fb['on'])?'<div id="fb-root"></div>':'');/* root node required by fb */?>

    <header>

    </header>

    <div role="main">

    </div>

    <footer>

    </footer>


    <!-- JavaScript at the bottom for fast page loading -->

    <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>

    <!-- scripts concatenated and minified via build script -->
    <script defer src="js/mylibs/fileuploader.js" type="text/javascript"></script>
    <script defer src="js/plugins.js"></script>
    <script defer src="js/script.js"></script>
    <!-- end scripts -->

    <? if($fb['on']): ?>
        <!-- Asynchronous Facebook API snippet.  -->
        <script>
            window.fbAsyncInit = function() {
                FB.init({ cookie: true, xfbml: true, oauth: true, status: true,
                    channelUrl: "<?=$URL."libs/facebook-sdk/channel.html";?>",
                    appId: '<?=$facebook->getAppID();?>'
                });
                FB.Event.subscribe('auth.login', function(response) { window.location.reload(); });
                FB.Event.subscribe('auth.logout', function(response) { window.location.reload(); });
            };
            (function() {
                var e = document.createElement('script'); e.async = true;
                e.src = document.location.protocol + '//connect.facebook.net/pl_PL/all.js';
                document.getElementById('fb-root').appendChild(e);
            }());
        </script>
    <? endif; ?>

    <!-- Asynchronous Google Analytics snippet.  -->
    <script>
        var _gaq=[['_setAccount','UA-24628125-3'],['_trackPageview']];
        (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
        g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
        s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>

    <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
        chromium.org/developers/how-tos/chrome-frame-getting-started -->
    <!--[if lt IE 7 ]>
        <script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
        <script defer>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
    <![endif]-->

</body>
</html>
