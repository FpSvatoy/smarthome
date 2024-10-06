<?php

$hooks = []; // associative array, the key is a hook and a value is an array of binded functions 

function register_hook($hookname, $function){
    global $hooks;
    // check if the hook is already registred
    if(isset($hooks[$hookname])) {
        foreach($hooks[$hookname] as &$temp_func){
            if($temp_func == $function) {
                echo "<br>the hook is already registred<br>";
                return; // break out of the function if it is
            }
        }
    }

    $functions_binded = [];
    if(isset($hooks[$hookname]) && !empty($hooks[$hookname])) {
        $functions_binded = $hooks[$hookname];
    }
    array_push($functions_binded, $function);
    $hooks[$hookname] = $functions_binded;
}

function execute_hooks($name){
    global $hooks;
    if(isset($hooks[$name])) {
        foreach($hooks[$name] as $temp_func) {
            if(function_exists($temp_func)) {
                call_user_func($temp_func);
            } else {
                // echo "<br>function '$temp_func' does not exist.<br>"; // DEBUG PRINT
            }
        }
    } else {
        // echo "no hooks for action '$name'<br>"; // DEBUG PRINT
    }
}

// ================================================================================================= //
// ====================================== User functions go here =================================== //


function example_function(){
    $script = "<script>";
    $script .= "window.addEventListener('load', () => alert('Сработала пользовательская функция, драйвер активировал устройство.'));";
    $script .= "</script>";
    echo $script;
}

register_hook('activation', 'example_function');