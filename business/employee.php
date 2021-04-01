<?php 
class Employee extends User{
    protected $firstName;
    protected $lastName;
    protected $homePhone;
    protected $cellPhone;
    protected $address;
    protected $city;
    protected $state;
    protected $zipCode;

    
    
    

    function __construct() {

        // Call the parent constructor.
        parent::__construct();

        // Initialise child instance variables.
        $this->firstName = "";
        $this->lastName = "";
        $this->homePhone = "";
        $this->cellPhone = "";
        $this->address = "";
        $this->city = "";
        $this->state = "";
        $this->zipCode = "";
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getFirstName() {
        return  $this->firstName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setHomePhone($homePhone) {
        $this->homePhone = $homePhone;
    }

    public function getHomePhone() {
        return $this->homePhone;
    }

    public function setCellPhone($cellPhone) {
        $this->cellPhone = $cellPhone;
    }

    public function getCellPhone() {
        return $this->cellPhone;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function getCity() {
        return $this->city;
    }

    public function setState($state) {
        $this->state = $state;
    }

    public function getState() {
        return $this->state;
    }

    public function setZipCode($zipCode) {
        $this->zipCode = $zipCode;
    }

    public function getZipCode() {
        return $this->zipCode;
    }
} ?>