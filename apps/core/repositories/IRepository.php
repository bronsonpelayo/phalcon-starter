<?php
namespace Core\Repositories;

interface IRepository
{
    function create($entity);
    function update($entity);
    function delete($entity, $id);
    function get($entity);
    function save();
    function getbyid($entity,$id);
    function getall($entity);
    function toArray();
    function slice($offset, $length = null);
}
