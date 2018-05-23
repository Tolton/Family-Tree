<?php
    class Person {
        var $ID;
        var $firstName;
        var $middleName;
        var $lastName;
        var $description;
        var $DOB;
        var $DOBLocation;
        
        function __construct($id, $fName, $mName, $lName, $desc, $dob, $dobLocation) {
            $this->firstName = $fName;
            $this->middleName = $mName;
            $this->lastName = $lName;
            $this->ID = $id;
            $this->description = $desc;
            $this->DOB = $dob;
            $this->DOBLocation = $dobLocation;
        }
        function changeDescription($new_desc) {
            $this->description = $new_desc;
        }
        function get_name() {
            return strtoupper($this->lastName).", ".$this->firstName." ".$this->midName;
        }
        function getID() {
            return $this->ID;
        }
        function getDOB() {
            return $this->DOB;
        }
        function getDOBLocation() {
            return $this->DOBLocation;
        }
        function getDescription() {
            return $this->description;
        }
        function printPerson() {
            $retStr = "H".$this->getID()." ".$this->get_name();
            if ($this->getDOB() != "") {
                $catStr = "was born on ".$this->getDOB();
                if ($this->getDOBLocation() != "") {
                    $catStr = $catStr." in ".$this->getDOBLocation();
                }
                $retStr = $retStr.$catStr." ".$this->getDescription();
            }
            return $retStr;
        }
    }
  
    
    
    
    
?>
