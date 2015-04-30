<?php
namespace Area\Frontend\Models;

interface IModel
{
    function create($viewmodel);
    function update($viewmodel);
    function delete($id);
    function get($entity);
    function save();
    function getall($viewmodel);
    function getbyid($viewmodel,$id);
}
