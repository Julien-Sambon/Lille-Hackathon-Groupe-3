<?php

/**
 * User entity file
 *
 * PHP Version 7.2
 *
 * @category Model
 * @package  Model
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */

namespace Model\User;

/**
 * User entity
 *
 * @category Model
 * @package  Model
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */
class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $email;

    /**
     * Getting User's id
     *
     * @return int Id User's id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Setting Id
     *
     * @param mixed $id User's id
     *
     * @return User Current User
     */
    public function setId($id): User
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Getting User's firstname
     *
     * @return string User's firstname
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Setting User's firstname
     *
     * @param mixed $firstName User's firstname
     *
     * @return User Current User
     */
    public function setFirstName($firstName): User
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Getting User's lastname
     *
     * @return string User's lastname
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * Setting User's lastname
     *
     * @param mixed $lastName User's lastname
     *
     * @return User Current User
     */
    public function setLastName($lastName): User
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Getting User's email
     *
     * @return string User's email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Setting User's email
     *
     * @param mixed $email User's email
     *
     * @return User Current User
     */
    public function setEmail($email): User
    {
        $this->email = $email;

        return $this;
    }
}
