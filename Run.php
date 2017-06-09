<?php

// require_once './Object.php';
require_once './Human.php';

// $obj = new Varien_Object();
// $obj->name="tripple h";
// $obj->age = 40;
// echo $obj->name."<br>";
// echo $obj->age."<br>";
// $obj->setHumanNature("hello world");
// echo $obj->getHumanNature();


// $human = new Human();
// $human->setName("John Cena");
// $human->setAge(40);
// $human->save();
// echo $human->getName();

$human = new Human();
$human->find(8);
echo $human->getId()."<br/>";
echo $human->getName()."<br/>";
echo $human->getAge()."<br/>";