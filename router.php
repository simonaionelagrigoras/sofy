<?php
/**
 * Created by PhpStorm.
 * User: Simona
 * Date: 08/06/2019
 * Time: 18:08
 */

class Router
{

    static public function parse($url, $request)
    {
        $url = trim($url);

        if ($url == "/")
        {
            $request->controller = "homepage";
            $request->action = "index";
            $request->params = [];
        }
        else
        {
            $explode_url = explode('/', $url);
            $explode_url = array_slice($explode_url, 1);
            $request->controller = $explode_url[0];
            $request->action = $explode_url[1];

            //parse parameters
            $parts = parse_url($url);
            if(isset($parts['query'])){
                parse_str($parts['query'], $request->params);
            }else{
                $params = array_slice($explode_url, 2);
                for($i = 0; $i<count($params); $i=$i+2){
                    $request->params[$params[$i]] = isset($params[$i+1]) ? $params[$i+1] : null;
                }
            }

            if(count($_POST)){
                foreach ($_POST as $key => $value){
                    $request->params[$key] = $value;
                }
            }
        }

    }
}