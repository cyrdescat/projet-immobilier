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
     * @return string
     */
    public function countSearchedProperties(int $surface, int $room, string $city, int $price) : string
    {
        if ($price !== 0) {
            $statement = $this->pdo->prepare("SELECT COUNT(*) FROM $this->table 
                                                    JOIN city ON city.id = property.id_city 
                                                    WHERE surface >= :surface 
                                                    AND room >= :room 
                                                    AND price <= :price 
                                                    AND city.name LIKE LOWER(:city)");

            $statement->bindValue('surface', $surface, \PDO::PARAM_INT);
            $statement->bindValue('room', $room, \PDO::PARAM_INT);
            $statement->bindValue('price', $price, \PDO::PARAM_INT);
            $statement->bindValue('city', "%$city%", \PDO::PARAM_STR);

            $statement->execute();
            return $statement->fetchColumn();
        } else {
            $statement = $this->pdo->prepare("SELECT COUNT(*) FROM $this->table 
                                                    JOIN city ON city.id = property.id_city 
                                                    WHERE surface >= :surface 
                                                    AND room >= :room 
                                                    AND city.name LIKE LOWER(:city)");

            $statement->bindValue('surface', $surface, \PDO::PARAM_INT);
            $statement->bindValue('room', $room, \PDO::PARAM_INT);
            $statement->bindValue('city', "%$city%", \PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetchColumn();
        }
    }

    /**
     * @param int $surface
     * @param int $room
     * @param string $city
     * @param int $price
     * @param int $page
     * @param int $nbElement
     * @return array
     */
    public function searchProperty(int $surface, int $room, string $city, int $price, int $page, int $nbElement) : array
    {
        if ($price !== 0) {
            $statement = $this->pdo->prepare("SELECT * FROM $this->table 
                                                    JOIN city ON city.id = property.id_city 
                                                    WHERE surface >= :surface 
                                                    AND room >= :room 
                                                    AND price <= :price 
                                                    AND city.name LIKE LOWER(:city)
                                                    LIMIT :offset, :limit");

            $statement->bindValue('surface', $surface, \PDO::PARAM_INT);
            $statement->bindValue('room', $room, \PDO::PARAM_INT);
            $statement->bindValue('price', $price, \PDO::PARAM_INT);
            $statement->bindValue('city', "%$city%", \PDO::PARAM_STR);
            $statement->bindValue('limit', $nbElement, \PDO::PARAM_INT);
            $statement->bindValue('offset', ($page - 1) * $nbElement, \PDO::PARAM_INT);

            $statement->execute();
            return $statement->fetchAll();
        } else {
            $statement = $this->pdo->prepare("SELECT * FROM $this->table 
                                                    JOIN city ON city.id = property.id_city 
                                                    WHERE surface >= :surface 
                                                    AND room >= :room 
                                                    AND city.name LIKE LOWER(:city)
                                                    LIMIT :offset, :limit");

            $statement->bindValue('surface', $surface, \PDO::PARAM_INT);
            $statement->bindValue('room', $room, \PDO::PARAM_INT);
            $statement->bindValue('city', "%$city%", \PDO::PARAM_STR);
            $statement->bindValue('limit', $nbElement, \PDO::PARAM_INT);
            $statement->bindValue('offset', ($page - 1) * $nbElement, \PDO::PARAM_INT);

            $statement->execute();
            return $statement->fetchAll();
        }
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
