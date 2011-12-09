#!/bin/sh
export PHP_FCGI_CHILDREN=3
exec /web/vs/facebook/app/templates/boilerplate/cgi-bin/php.cgi -c /web/vs/facebook/app/templates/boilerplate/inc/php.ini
