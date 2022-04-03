<?php

// Using composer to provides third-party classes, then load it into our atl-software */
require __DIR__.'/../vendor/autoload.php';

//Loading AtlAppSoftware
require  __DIR__.'/../App/app.php';

$app = new AtlSoftware\App();

$app->run();