<?php
namespace Core\Repositories;
use Libraries\Doctrine as Doctrine;
class UsersRepository extends BaseRepository
{
    public $entitymanager;
    public function __construct()
    {
        $doc = new  Doctrine();
        $this->entitymanager = $doc->entityManager;
        parent::__construct($doc->entityManager);
    }
}