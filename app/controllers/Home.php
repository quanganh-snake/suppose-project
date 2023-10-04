<?php
class Home extends Controller {

    public $homeModel;
    public function __construct()
    {
        $this->homeModel = $this->model('HomeModel');
    }

    public function index(){
        $data = $this->homeModel->getAllProduct();

        echo 'Trang chủ';

        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}