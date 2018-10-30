<?php

/**
 * User manager file
 *
 * PHP Version 7.2
 *
 * @category Model
 * @package  Manager
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */

namespace Model\User;

use Model\AbstractManager;
use Model\User\User;

/**
 * User manager class
 *
 * @category Model
 * @package  Manager
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */
class UserManager extends AbstractManager
{
    /**
     * Targeted table const
     */
    const TABLE = 'user';

    /**
     *  Initializes this class.
     *
     * @param \PDO $pdo To use pdo into manager
     */
    public function __construct(\PDO $pdo)
    {
        parent::__construct(self::TABLE, $pdo);
    }

    /**
     * Add method
     *
     * @param User $user Given user to insert
     *
     * @return int|null
     */
    public function add(User $user): ?int
    {
        $statement = $this->pdo
            ->prepare("INSERT INTO $this->table VALUES (null, :firstname, :lastname, :email)");
        $statement->bindValue('firstname', $user->getFirstName(), \PDO::PARAM_STR);
        $statement->bindValue('lastname', $user->getLastName(), \PDO::PARAM_STR);
        $statement->bindValue('email', $user->getEmail(), \PDO::PARAM_STR);

        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }

        return null;
    }

    /**
     * Add method
     *
     * @param User $user Given user to insert
     *
     * @return int|null
     */
    public function edit(User $user): ?int
    {
        $statement = $this->pdo
            ->prepare("UPDATE $this->table SET `firstname` = :firstname, `lastname` = :lastname, `email` = :email WHERE id=:id");
        $statement->bindValue('id', $user->getId(), \PDO::PARAM_INT);
        $statement->bindValue('firstname', $user->getFirstName(), \PDO::PARAM_STR);
        $statement->bindValue('lastname', $user->getLastName(), \PDO::PARAM_STR);
        $statement->bindValue('email', $user->getEmail(), \PDO::PARAM_STR);

        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }

        return null;
    }

    /**
     * Delete method
     *
     * @param int $id
     */
    public function delete(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
