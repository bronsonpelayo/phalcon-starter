<?php
namespace Area\Frontend\Models;

class BaseModel implements IModel
{
    public $controller = null;
    public function __construct($controller)
    {
        $this->controller = $controller;
    }

    public function save()
    {
    }

    public function create($viewmodel)
    {
    }

    public function update($viewmodel)
    {
    }

    public function delete( $id)
    {
    }


    public function get($entity)
    {
    }


    public function getbyid($viewmodel,$id)
    {
    }

    public function getall($viewmodel)
    {
    }
}