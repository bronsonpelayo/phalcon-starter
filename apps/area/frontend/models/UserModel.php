<?php
namespace Area\Frontend\Models;

use Core\Entities\Users;
use Core\Repositories\UsersRepository;
use Libraries\Mapper;

class UserModel extends BaseModel
{
    protected $user_repo = null;
    protected $mapper = null;

    public function __construct($controller)
    {
        parent::__construct($controller);
        $this->user_repo = new UsersRepository();
        $this->mapper = new Mapper();
    }

    public function save()
    {
        $this->user_repo->save();
    }

    public function create($viewmodel)
    {
        $entity = new Users();
        $entity = $this->mapper->Map($viewmodel, $entity);
        $this->user_repo->create($entity);
    }

    public function update($viewmodel)
    {
        $entity = $this->user_repo->getbyid(new Users(), $viewmodel->id);
        $entity = $this->mapper->Map($viewmodel, $entity);
        $this->user_repo->update($entity);
    }

    public function delete($id)
    {
        $entity = new Users();
        $user =  $this->user_repo->getbyid($entity, $id);
        if($user !== null)
        {
            $this->user_repo->delete($user, $id);
        }
    }

    public function getall($viewmodels)
    {
        $entity = new Users();
        $entities = $this->user_repo->getall($entity);
        return  $this->mapper->Map($entities , $viewmodels);
    }

    /**
     * @param $entity object entity class/namespace
     * @return entity manager
     */
    public function get($entity)
    {
        return  $this->user_repo->get($entity);
    }

    /**
     * @param $viewmodel
     * @param $id
     * @return array
     */

    public function getbyid($viewmodel,$id)
    {
        $entity = new Users();
        $entity =  $this->user_repo->getbyid($entity, $id);
        return $this->mapper->Map($entity, $viewmodel);
    }
}