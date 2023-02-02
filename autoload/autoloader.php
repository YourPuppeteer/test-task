<?php

function myAutoLoader($class_name){
    if (file_exists('./classes/' . $class_name . '.php')){
        require_once './classes/' . $class_name . '.php';
    }
    else if (file_exists('./database/' . $class_name . '.php')){
        require_once './database/' . $class_name . '.php';
    }


}

spl_autoload_register('myAutoLoader');
