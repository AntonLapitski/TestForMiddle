<?php

include_once 'Database.php';
include_once 'PeopleDB.php';

class ListOfPeople {

    public $list;

    public function __construct($firstname, $lastname, $date_of_birth, $gender, $city_of_birth)
    {
        $firstnameValue = strtok($firstname, ':');
        $firstnameSign = $this->getStringBetween($firstname, ":", "@");
        $firstnameLimit = substr($firstname, strpos($firstname, "@") + 1);

        $lastnameValue = strtok($lastname, ':');
        $lastnameSign = $this->getStringBetween($lastname, ":", "@");
        $lastnameLimit = substr($lastname, strpos($lastname, "@") + 1);

        $searchDateOfBirth = $date_of_birth;
        $date_of_birth = str_replace('-','', $date_of_birth);
        $date_of_birth_value = strtok($date_of_birth, ':');
        $date_of_birth_sign = $this->getStringBetween($date_of_birth, ":", "@");
        $date_of_birth_limit = substr($date_of_birth, strpos($date_of_birth, "@") + 1);


        $mysqli = new Database();
        $mysqli = $mysqli->connect();

        $this->list = [];

        if(isset($firstname)) {
            $sql = "SELECT * FROM people WHERE firstname = '" . $firstnameValue ."'";

            $result = $mysqli->query($sql);

            while($row = $result->fetch_row()) {
                $this->list[] = $row[0];
            }
        }

        if(isset($firstname) && $firstnameSign === '>' || $firstnameSign === '<') {
            $sql = "SELECT * FROM people WHERE firstname = '" . $firstnameValue ."' AND '" . strlen($firstnameValue) . $firstnameSign . $firstnameLimit ."'";

            $result = $mysqli->query($sql);

            while($row = $result->fetch_row()) {
                $this->list[] = $row[0];
            }
        }

        if(isset($firstname) && $firstnameSign === '!=') {
            $sql = "SELECT * FROM people WHERE firstname = '" . $firstnameValue ."' AND '" . $firstnameValue . $firstnameSign . $firstnameLimit ."'";

            $result = $mysqli->query($sql);

            while($row = $result->fetch_row()) {
                $this->list[] = $row[0];
            }
        }

        if(isset($lastname)) {
            $sql = "SELECT * FROM people WHERE lastname = '" . $lastnameValue ."'";

            $result = $mysqli->query($sql);

            while($row = $result->fetch_row()) {
                $this->list[] = $row[0];
            }
        }

        if(isset($lastname) && $lastnameSign === '>' || $lastnameSign === '<') {
            $sql = "SELECT * FROM people WHERE lastname = '" . $lastnameValue ."' AND '" . strlen($lastnameValue) . $lastnameSign . $lastnameLimit ."'";

            $result = $mysqli->query($sql);

            while($row = $result->fetch_row()) {
                $this->list[] = $row[0];
            }
        }

        if(isset($lastname) && $lastnameSign === '!=') {
            $sql = "SELECT * FROM people WHERE lastname = '" . $lastnameValue ."' AND '" . $lastnameValue . $lastnameSign . $lastnameLimit ."'";

            $result = $mysqli->query($sql);

            while($row = $result->fetch_row()) {
                $this->list[] = $row[0];
            }
        }

        if(isset($searchDateOfBirth)) {
            $sql = "SELECT * FROM people WHERE date_of_birth = '" . $searchDateOfBirth ."'";

            $result = $mysqli->query($sql);

            while($row = $result->fetch_row()) {
                $this->list[] = $row[0];
            }
        }

        if (isset($date_of_birth) && $date_of_birth_sign === '>' || $date_of_birth_sign === '<') {
            $sql = "SELECT * FROM people WHERE date_of_birth = '" . $date_of_birth_value ."' AND '" . $date_of_birth_sign . $date_of_birth_limit ."'";

            $result = $mysqli->query($sql);

            while($row = $result->fetch_row()) {
                $this->list[] = $row[0];
            }
        }

        if (isset($date_of_birth) && $date_of_birth_sign === '!=') {
            $sql = "SELECT * FROM people WHERE date_of_birth = '" . $date_of_birth_value ."' AND '" . $date_of_birth_value . $firstnameSign . $date_of_birth_limit ."'";

            $result = $mysqli->query($sql);

            while($row = $result->fetch_row()) {
                $this->list[] = $row[0];
            }
        }

        if(isset($gender)) {
            $sql = "SELECT * FROM people WHERE gender = '" . $gender ."'";

            $result = $mysqli->query($sql);

            while($row = $result->fetch_row()) {
                $this->list[] = $row[0];
            }
        }

        if(isset($city_of_birth)) {
            $sql = "SELECT * FROM people WHERE city_of_birth = '" . $city_of_birth ."'";

            $result = $mysqli->query($sql);

            while($row = $result->fetch_row()) {
                $this->list[] = $row[0];
            }
        }
    }

    public function getList()
    {
        return $this->list;
    }


    public function getListOfPeople()
    {
        $ids = $this->getList();
        $peopleDBObjectArray = [];

        for ($i = 0; $i < count($ids); $i++) {
            if (class_exists(PeopleDB::class)) {
                $peopleDBObject = new PeopleDB('find', ['id' => $ids[$i]]);
                $peopleDBObjectArray[] = $peopleDBObject;
            } else {
                throw new Exception('Class not found');
            }
        }
    }

    public function deleteListOfPeople()
    {
        $ids = $this->getList();

        for ($i = 0; $i < count($ids); $i++) {
            $peopleDBObject = new PeopleDB(null, null);
            if (class_exists(PeopleDB::class)) {
                $peopleDBObject = new PeopleDB(null, null);
                $peopleDBObject->deletePerson(['id' => $i]);
            } else {
                throw new Exception('Class not found');
            }
        }
    }

    public function getStringBetween($str,$from,$to)
    {
        $sub = substr($str, strpos($str,$from)+strlen($from),strlen($str));
        return substr($sub,0,strpos($sub,$to));
    }
}