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

namespace Model\Adresse;

use Model\AbstractManager;
use Model\Adresse\Adresse;

/**
 * User manager class
 *
 * @category Model
 * @package  Manager
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */
class AdresseManager extends AbstractManager
{
    /**
     * Targeted table const
     */
    const TABLE = 'adresse';

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
    public function add(Adresse $user): ?int
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
    public function edit(Adresse $user): ?int
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

    public function AddVisiteAdresse($adresse)
    {
        $statement = $this->pdo
            ->prepare("UPDATE $this->table SET visited = :visited WHERE location=:location");
        $statement->bindParam('location', $adresse, \PDO::PARAM_STR);
        $statement->bindValue('visited', 1, \PDO::PARAM_INT);
        $statement->execute();
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

    public function selectAllNotVisited()
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE visited IS NULL");
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->execute();

        return $statement->fetchAll();
    }
}
