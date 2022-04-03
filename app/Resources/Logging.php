<?php

namespace AtlSoftware\Resources;

class Logging
{
    public function __construct()
    {
        if(app_debug == "true")
        {
            ini_set('display_errors', 'On');
            ini_set('log_errors', 'Off');
        }else{
            ini_set('display_errors', 'Off');
            ini_set('log_errors', 'On');
            ini_set("error_log", __DIR__."/logs/errors.log"); //enable permission directory w+r
        }
    }
}