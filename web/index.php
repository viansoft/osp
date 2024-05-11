<?php

define ('DIR_CONFIG',dirname(__DIR__) . '/src/config/');

include(DIR_CONFIG . 'global.php');

$app = new osp\src\components\App(require DIR_CONFIG . 'config.php');
$app->run();