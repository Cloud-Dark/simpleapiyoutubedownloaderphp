<?php
    function errMsg($message)
    {
        return json_encode(
            array(
                'error'     => true,
                'message'   => $message,
                'contohpenulisan'   => '?id=V2VmcuOEqEg'
            )
        );
    }
