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
class ContactManager
{
    /**
     *
     */
    const FILE = '/contact.json';

    /**
     *
     */
    public function deleteAll()
    {
        $locationJson = __DIR__. self::FILE ;
        $jsonNoData = json_encode($emptyArr = [], JSON_PRETTY_PRINT | JSON_FORCE_OBJECT);
        file_put_contents($locationJson, $jsonNoData);
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $locationJson = __DIR__. self::FILE ;

        $jsonData = file_get_contents($locationJson);

        $arrData = json_decode($jsonData, true);

        unset($arrData[$id]);

        $jsonNewData = json_encode($arrData, JSON_PRETTY_PRINT | JSON_FORCE_OBJECT);

        file_put_contents($locationJson, $jsonNewData);
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function getOne(int $id) : ?array
    {
        $err = "";
        $locationJson = __DIR__. self::FILE ;

        $jsonData = file_get_contents($locationJson);

        $arrData = json_decode($jsonData, true);

        if ($arrData[$id]) {
            $contact = $arrData[$id];
        } else {
            $contact = [];
        }

        return $contact;
    }

    /**
     * @return array|null
     */
    public function getAll() : ?array
    {
        $err = "";
        $locationJson = __DIR__. self::FILE ;

        $jsonData = file_get_contents($locationJson);

        return $arrData = json_decode($jsonData, true);
    }

    /**
     * @param array $contact
     * @return void
     */
    public function insert(array $contact) : void
    {
        $err = "";
        $locationJson = __DIR__. self::FILE ;
        $arrData = array();
        
        //Get data from existing json file
        $jsondata = file_get_contents($locationJson);
    
        if (empty($jsondata)) {
            $err = "le fichier est vide";
        }
        // converts json data into array
        $arrData = json_decode($jsondata, true);

        // Push user data to array
        if ($arrData == null) {
            $arrData = ['0' => $contact];
        } else {
            array_push($arrData, $contact);
        }

        //Convert updated array to JSON
        $jsondata = json_encode($arrData, JSON_PRETTY_PRINT | JSON_FORCE_OBJECT);
        if (empty($jsondata)) {
            $err = "Impossible de convertir les données en json";
        }
        //write json data into contact.json file
        if (file_put_contents($locationJson, $jsondata) & $err === "") {
            echo 'Data successfully saved';
        } else {
            echo $err;
        }
    }
}
