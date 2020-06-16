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
     * @param array $contact
     * @return int
     */
    public function insert(array $contact)
    {
            $err = "";
            $locationJson = __DIR__. self::FILE ;
            $arrData = array();
            
            //Get data from existing json file
            $jsondata = file_get_contents($locationJson);
    
            if(empty ($jsondata)){
                $err = "le fichier est vide";
            }
            // converts json data into array
            $arrData = json_decode($jsondata, true);
            if(isset ($arrData)){
                $err = "Impossible de convertir les données en tableau";
            }
            // Push user data to array
            array_push($arrData, $contact);
    
            //Convert updated array to JSON
            $jsondata = json_encode($arrData, JSON_PRETTY_PRINT);
            if(isset ($jsondata)){
                $err = "Impossible de convertir les données en json";
            }
            //write json data into contact.json file
            if (file_put_contents($locationJson, $jsondata) && $err === "") {
                echo 'Data successfully saved';
            } else {
                echo $err;
            }
    }
}
