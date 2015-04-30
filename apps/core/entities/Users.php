<?php

namespace Core\Entities;

use Doctrine\ORM\Mapping\Entity;

/**
 * User Model
 *
 * @Entity
 * @Table(name="users")
 *
 */
class Users
{
	/**
	 * @Id
	 * @Column(type="integer", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
    public $id;

	/**
	 * @Column(type="string", length=32, unique=true, nullable=false)
	 */
	public $username;

	/**
	 * @Column(type="string", length=512, nullable=false)
	 */
    public $password;

    /**
     * @Column(type="string", length=32, nullable=true)
     */
    public $firstname;

    /**
     * @Column(type="string", length=32, nullable=true)
     */
    public $lastname;

    /**
     * @Column(type="string", length=32, nullable=false)
     */
    public $email;

    /**
     * @Column(type="datetime")
     */
    public $createdate;

}
