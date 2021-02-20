<?php

    function generate_varification_code(){
        $str_length = 18;
        $char = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ132456790';
        $varification_code = '';
        $i = 0;
        while ($i < $str_length) {   
            $single_char = substr($char, mt_rand(0, strlen($char)-1), 1);  
            $varification_code .= $single_char;  
            $i++;
        }
        return $varification_code;
    }

?>