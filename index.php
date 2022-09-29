<?php

include 'PeopleDB.php';
include 'LIstOfPeople.php';

/*$peopleDBObject = new PeopleDB('creation', [
    'firstname' => 'test1',
    'lastname' => 'test2',
    'date_of_birth' => '1993-08-20',
    'gender' => 0,
    'city_of_birth' => 'NewYork'
]);*/

//$peopleDBObject = new PeopleDB('find', ['id' => 1]);
//$peopleDBObject->deletePerson(['id' => 2]);

$list = new ListOfPeople('testo:>@3', null, null, null, null);