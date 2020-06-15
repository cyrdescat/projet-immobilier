<?php

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
        return $this->pdo->query('SELECT * FROM ' . $this->table . ' LIMIT ' . $limit)->fetchall();
    }

    public function selectOneById(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    /**
     * @param int $surface
     * @param int $room
     * @param string $city
     * @param int $price
     * @return array
     */
    public function searchProperty(int $surface, int $room, string $city, int $price) : array
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table 
                                                    JOIN city ON city.id = property.id_city 
                                                    WHERE surface >= :surface 
                                                    AND room >= :room 
                                                    AND price >= :price 
                                                    AND city.name LIKE LOWER(:city)");

        $statement->bindValue('surface', $surface, \PDO::PARAM_INT);
        $statement->bindValue('room', $room, \PDO::PARAM_INT);
        $statement->bindValue('price', $price, \PDO::PARAM_INT);
        $statement->bindValue('city', $city, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
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
