<?php

class App
{
    private $__controller, $__action, $__params;


    function __construct()
    {
        global $routes;
        if(!empty($routes['default_controller'])){
            $this->__controller = $routes['default_controller'];
        }

        $this->__action = 'index';
        $this->__params = [];
        $this->handleURL();
    }

//      Xử lý URL

    function getURL()
    {
        if (!empty($_SERVER['PATH_INFO'])) {
            $url = $_SERVER['PATH_INFO'];
        } else {
            $url = '/';
        }

        return $url;
    }

//    Tách chuỗi url: lấy controller, method, params
    public function handleURL()
    {
        $url = $this->getURL();
        $urlArr = array_filter(explode('/', $url));
        $urlArr = array_values($urlArr);



        // Get controller
        if(!empty($urlArr[0])){
            $this->__controller = ucfirst($urlArr[0]);
        }else {
            $this->__controller = ucfirst($this->__controller);
        }

        if(file_exists('app/controllers/'.($this->__controller).'.php')){
            require_once 'controllers/'.($this->__controller).'.php';

            // Check class Controller is exits???
            if(class_exists($this->__controller)){
                $this->__controller = new $this->__controller();
                unset($urlArr[0]);
            }else {
                $this->loadError();
            }

            // var_dump($this->__controller);
        }else {
            $this->loadError();
        }

        // Get action
        if(!empty($urlArr[1])){
            $this->__action = $urlArr[1];
            unset($urlArr[1]);
        }

        // Get params
        $this->__params = array_values($urlArr);

        //Check method of controller is exist???
        if(method_exists($this->__controller, $this->__action)){
            call_user_func_array([$this->__controller, $this->__action], $this->__params);
        }else {
            $this->loadError();
        }


        // check URL
        // echo '<pre>';
        // print_r($this->__params);
        // echo  '</pre>';
    }

    // Load page errors
    public function loadError($name='404'){
        require_once 'errors/'.$name.'.php';
    }
}
