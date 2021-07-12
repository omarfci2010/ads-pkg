<?php


namespace Kwreach\Ads\Traits;


trait StatusCodeTrait
{
    use ReusePropertiesTrait;

    protected function show_success($response, $message = '', $data = [])
    {
        $response['status'] = $this->success_status;
        $response['message'] = $message;

        /** Data supposed to be a key-value structure example: ['user' => ['first_name' => .., 'last_name' =>..]] */
        foreach ($data as $key => $value) {
            $response[$key] = $value;
        }

        return $response;
    }

    protected function show_error($response, $message = 'Error, something went wrong!', $error_status = false)
    {
        $response['status'] = $error_status;
        $response['message'] = $message;

        return $response;
    }

}
