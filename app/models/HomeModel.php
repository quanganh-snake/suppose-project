<?php
/*
 * abstract by class Model in folder core
 * */

class HomeModel {
    protected $_table = 'products';

    // Method
    public function getAllProduct(){
        $data = [
            'Item 1',
            'Item 2',
            'Item 3'
        ];

        return $data;
    }

    public function getProductByID($id){
        $data = [
            'Item 1',
            'Item 2',
            'Item 3'
        ];

        return $data[$id];
    }
}