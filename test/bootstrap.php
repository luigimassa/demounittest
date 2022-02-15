<?php
$_SERVER['REQUEST_METHOD'] = 'POST';
define('_PS_ROOT_DIR_', __DIR__ . '/../../..');

require_once __DIR__.'/../../../config/config.inc.php';
require_once __DIR__.'/../../../init.php';
require_once _PS_CONFIG_DIR_ . 'autoload.php';

## admin
//require_once _PS_ROOT_DIR_.'/app/AppKernel.php';
//$kernel = new \AppKernel(_PS_ENV_, false);
//$kernel->boot();

//define('_NEW_COOKIE_KEY_', PhpEncryption::createNewRandomKey());
require_once _PS_VENDOR_DIR_ . '/autoload.php';
