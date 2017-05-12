<?php
    function showvar($var = false){

        return isset($var) ? $var : 'null';
    }
    function echo_json($array, $opc = false){
        header('Content-Type: application/json');
        if($opc) echo json_encode($array, $opc);
        else echo json_encode($array);
    }

    function existen_vars($target_array, $array_values){

        foreach (array_keys($target_array) as $key => $value) {
            if(!in_array ($value, $array_values))
                return false;
        }
        return true;
    }

 ?>