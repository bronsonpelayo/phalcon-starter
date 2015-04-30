<?php
namespace Core\Repositories;
use Doctrine\ORM\EntityManager;

/**
 * Class BaseRepository
 * @package Core\Repositories
 */
class BaseRepository implements IRepository
{

    //public $entitymanager = null;
    private $_entitymanager = null;

    /**
     * @param EntityManager $context
     */
    public function __construct(EntityManager $context)
    {
        $this->_entitymanager = $context;
        //$this->entitymanager = $context;
    }

    /**
     * Flush
     */
    public function save()
    {
        $this->_entitymanager->flush();
    }

    /**
     * @param $entity object
     */
    public function create($entity)
    {
        $this->_entitymanager->persist($entity);
    }

    /**
     * @param $entity object
     */
    public function update($entity)
    {
        $this->_entitymanager->merge($entity);
    }

    /**
     * @param $entity object
     * @param $id int
     */
    public function delete($entity, $id)
    {
        $user =  $this->getbyid($entity, $id);
        if($user !== null)
        {
            $this->_entitymanager->remove($user);
        }
    }

    /**
     * @param $entity object
     * @return null|array
     */
    public function getall($entity)
    {
        return  $this->_entitymanager
            ->getRepository(
                $this->getClassName($entity)
            )
            ->findAll();
    }

    /**
     * @param $entity object
     * @return \Doctrine\ORM\EntityRepository
     */
    public function get($entity)
    {
        return  $this->_entitymanager
            ->getRepository(
                $this->getClassName($entity)
            );
    }

    /**
     * @param $entity object
     * @param $id int
     * @return null|object
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function getbyid($entity,$id)
    {
        return  $this->_entitymanager->find(
            $this->getClassName($entity)
            , $id);
    }

    public function toArray(){}


    public function slice($offset, $length = null){}

    /**
     * @param $obj object
     * @return string
     */
    protected function getClassName($obj)
    {
        return get_class($obj);
    }
}