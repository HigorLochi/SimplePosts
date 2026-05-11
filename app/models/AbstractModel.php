<?php

namespace app\models;

abstract class AbstractModel{
    public function __construct(){}

    public function get($field){
        return isset($this->$field) ? $this->$field : null;
    }
}