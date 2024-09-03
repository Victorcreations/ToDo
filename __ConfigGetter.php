<?php

$json_data = file_get_contents('./configs.json');
$data = json_decode($json_data);

class Configer
{
    public function getConfig($key)
    {
        foreach($GLOBALS['data'] as $keys => $value)
        {
            if($key == $keys)
            {
                return $value;
            }
        }
    }
}