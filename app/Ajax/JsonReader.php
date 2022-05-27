<?php

namespace App\Ajax;

class JsonReader
{
    public $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function read()
    {
        try {
            $json = json_decode(\App\getContent($this->url), true);
            wp_send_json_success($json);
        } catch (Exception $e) {
            wp_send_json_error($e->getMessage());
        }
    }
}
