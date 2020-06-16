<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

/**
 *
 */
class PropertyManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'property';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * Get Slider row from database.
     *
     * @return array
     */
    public function selectSlider(int $limit): array
    {
        $query = "SELECT pr.*, p.* "
               . "FROM " . $this->table . " as pr "
               . "JOIN picture p ON pr.id = p.id_property "
               . "WHERE p.front = 1 "
               . "LIMIT " . $limit;
        $statement = $this->pdo->query($query);
        $properties = $statement->fetchAll();
        //$this->pdo->query('SELECT * FROM ' . $this->table . ' LIMIT ' . $limit);

        return $properties;
    }

    /**
     * Get last new 10 propertys into database.
     *
     * @return array
     */
    public function selectNewProperty(): array
    {
        $query = "SELECT pr.*, p.* "
               . "FROM " . $this->table . " as pr "
               . "JOIN picture p ON pr.id = p.id_property "
               . "WHERE p.front = 1 "
               . "ORDER BY pr.created DESC "
               . "LIMIT 10 ";
        $statement = $this->pdo->query($query);
        $properties = $statement->fetchAll();
        //return $this->pdo->query('SELECT * FROM ' . $this->table . ' ORDER BY created DESC LIMIT 10')->fetchall();
        
        return $properties;
    }

    /**
     * @param array $item
     * @return int
     */
    public function insert(array $item): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`) VALUES (:title)");
        $statement->bindValue('title', $item['title'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }


    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }


    /**
     * @param array $item
     * @return bool
     */
    public function update(array $item):bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $item['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $item['title'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
