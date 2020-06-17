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
        $query = "SELECT pr.*, pr.title AS propertyTitle, p.* "
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
     * Get all data from 1 property.
     *
     * @return array
     */
    public function selectAllFromOne(int $id): array
    {
        $statement = $this->pdo->prepare("SELECT pr.*, c.name FROM $this->table as pr 
                                        JOIN city as c ON c.id = pr.id_city 
                                        WHERE pr.id = :id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }
    /**
     * Get all data from 1 property.
     *
     * @return array
     */
    public function selectPicturesFromOne(int $id): array
    {
        $statement = $this->pdo->prepare("SELECT p.* FROM picture as p WHERE p.id_property = :id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    /**
     * @param int $surface
     * @param int $room
     * @param string $city
     * @param int $price
     * @param bool $isNew
     * @return string
     */
    public function countSearchedProperties(int $surface, int $room, string $city, int $price, $isNew = false) : string
    {
        if ($isNew) {
            $new = "AND created >= (NOW() - INTERVAL 3 MONTH) ";
        } else {
            $new = "";
        }

        if ($price !== 0) {
            $statement = $this->pdo->prepare("SELECT COUNT(*) FROM $this->table 
                                                    JOIN city ON city.id = property.id_city 
                                                    WHERE surface >= :surface 
                                                    AND room >= :room 
                                                    AND price <= :price 
                                                    $new
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
                                                    $new
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
     * @param int $filterId
     * @param boolean|bool $isNew
     * @return array
     */
    public function searchProperty(int $surface, int $room, string $city, int $price, int $page, int $nbElement, int $filterId, $isNew = false) : array
    {
        if ($filterId === 1 || $filterId === 3 || $filterId === 4) {
            $order = "ASC";
        } else {
            $order = "DESC";
        }
        if ($filterId == 0 || $filterId == 1) {
            $column = "created";
        }
        if ($filterId == 2 || $filterId == 3) {
            $column = "surface";
        }
        if ($filterId == 4 || $filterId == 5) {
            $column = "price";
        } else {
            $column = "created";
        }

        if ($isNew) {
            $new = "AND created >= (NOW() - INTERVAL 3 MONTH) ";
        } else {
            $new = "";
        }

        if ($price !== 0) {
            $statement = $this->pdo->prepare("SELECT * FROM $this->table 
                                                    JOIN city ON city.id = property.id_city 
                                                    WHERE surface >= :surface 
                                                    AND room >= :room 
                                                    AND price <= :price 
                                                    AND city.name LIKE LOWER(:city)
                                                    $new
                                                    ORDER BY $column $order 
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
                                                    $new
                                                    ORDER BY $column $order 
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
