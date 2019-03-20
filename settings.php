<?php
/**
 * Created by PhpStorm.
 * User: Simona
 * Date: 20/03/2019
 * Time: 18:40
 */

     function getBaseDir(){
         return __DIR__ . "\\";
     }

    function getDir($path){
        return getBaseDir() . $path;
    }