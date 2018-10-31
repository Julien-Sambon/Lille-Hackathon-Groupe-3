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

namespace Model\Adresse;

/**
 * User entity
 *
 * @category Model
 * @package  Model
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */
class Adresse
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $location;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return User
     */
    public function setId($id): Adresse
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param $location
     * @return User
     */
    public function setLocation($location): Adresse
    {
        $this->location = $location;

        return $this;
    }
}
