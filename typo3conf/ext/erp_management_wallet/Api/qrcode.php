<?php
/**
 * Author: it
 */
header("Content-type:text/html;charset=utf-8");

require_once("../lib/qrcode/phpqrcode.php");

// outputs image directly into browser, as PNG stream
QRcode::png(rawurldecode($_GET['code']), false, QR_ECLEVEL_L, 3, 0);