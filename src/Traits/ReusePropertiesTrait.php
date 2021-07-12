<?php

namespace Kwreach\Ads\Traits;


trait ReusePropertiesTrait
{
    protected $response = [];
    protected $success_data = [];
    protected $message = "";
    protected $success_status = true;
    protected $error_status = false;
    protected $status_code = 200;
    protected $api_validation_error = -3;

}
