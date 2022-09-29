<?php

include_once 'Database.php';

class PeopleDB {

    public $id;

    public $firstname;

    public $lastname;

    public static $dateOfBirth;

    public static $gender;

    public $cityOfBirth;

    public function __construct($flag, $params)
    {
        $mysqli = new Database();
        $mysqli = $mysqli->connect();

        if($flag === 'creation') {

            if ((strlen($params['firstname']) < 2) && (strlen($params['lastname']) < 2 )) {
                throw new Exception('Too small names');
            }

            if(!(bool)strtotime($params['date_of_birth'])) {
                throw new Exception('Date is not correct');
            }

            if (!in_array($params['gender'], [0,1])) {
                throw new Exception('Invalid gender value');
            }

            $sql = "INSERT INTO people (firstname, lastname, date_of_birth, gender, city_of_birth)
                    VALUES('". $params['firstname'] ."', '". $params['lastname'] ."', '". $params['date_of_birth'] ."',
                  '". $params['gender'] ."', '". $params['city_of_birth'] ."')";

            $result = $mysqli->query($sql);

            if(!$result){
                echo "Query Failed. ".$mysqli->error;
            } else {
                echo "Successfully Inserted. ".$mysqli->affected_rows." Records";
            }
        }

        if($flag === 'find') {
            $sql = "SELECT * FROM people WHERE id = '" . $params['id'] ."'";
            $result = $mysqli->query($sql);

            $rows = [];

            while($row = $result->fetch_row()) {
                $rows[] = $row;
            }

            return $rows[0];
        }
    }

    public function savePerson($params)
    {
        $mysqli = new Database();
        $mysqli = $mysqli->connect();

        $sql = "INSERT INTO people (firstname, lastname, date_of_birth, gender, city_of_birth)
                    VALUES('". $params['firstname'] ."', '". $params['lastname'] ."', '". $params['date_of_birth'] ."',
                  '". $params['gender'] ."', '". $params['city_of_birth'] ."')";

        $result = $mysqli->query($sql);

        if(!$result){
            echo "Query Failed. ".$mysqli->error;
        } else {
            echo "Successfully Inserted. ".$mysqli->affected_rows." Records";
        }
    }

    public function deletePerson($params) {
        $mysqli = new Database();
        $mysqli = $mysqli->connect();

        $sql = "DELETE FROM people WHERE id = '". $params['id'] ."'";
        $result = $mysqli->query($sql);

        if(!$result){
            echo "Query Failed. ".$mysqli->error;
        } else {
            echo "Successfully Deleted. ".$mysqli->affected_rows." Records";
        }
    }

    public static function transformDateOfBirth()
    {
        $fullAge = (int)date('Y') - (int)(substr(self::$dateOfBirth, 0, 4));

        $f = new self();

        return (object) [
            'id' => $f->id,
            'firstname' => $f->firstname,
            'lastname' => $f->lastname,
            'date_of_birth' => $f::$dateOfBirth,
            'gender' => $f::$gender,
            'city_of_birth' => $f->cityOfBirth
        ];
    }

    public static function transformGender()
    {
        $result = (self::$gender === 1) ? 'wom' : 'man';

        $f = new self();

        return (object) [
            'id' => $f->id,
            'firstname' => $f->firstname,
            'lastname' => $f->lastname,
            'date_of_birth' => $f::$dateOfBirth,
            'gender' => $f::$gender,
            'city_of_birth' => $f->cityOfBirth
        ];
    }
}