<?php

require_once '/home/guidevn/public_html/localdeal/lib//htmlpurifier/library/HTMLPurifier.auto.php';
require_once '/home/guidevn/public_html/localdeal/lib//htmlpurifier/library/HTMLPurifier.auto.php';
require_once '/home/guidevn/public_html/localdeal/lib//htmlpurifier/library/HTMLPurifier.auto.php';

    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    $clean_html = $purifier->purify('aaaaa<SCRIPT a=">" SRC="http://ha.ckers.org/xss.js"></SCRIPT>');
    $clean_html = $purifier->purify('aaaaa<SCRIPT a=">" SRC="http://ha.ckers.org/xss.js"></SCRIPT>');
    $clean_html = $purifier->purify('aaaaa<SCRIPT a=">" SRC="http://ha.ckers.org/xss.js"></SCRIPT>');
    $clean_html = $purifier->purify('aaaaa<SCRIPT a=">" SRC="http://ha.ckers.org/xss.js"></SCRIPT>');
    $clean_html = $purifier->purify('aaaaa<SCRIPT a=">" SRC="http://ha.ckers.org/xss.js"></SCRIPT>');
    $clean_html = $purifier->purify('aaaaa<SCRIPT a=">" SRC="http://ha.ckers.org/xss.js"></SCRIPT>');
	echo $clean_html;
?>