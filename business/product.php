<?php 
class Product{
	private $id;
    private $name;
    private $desc;
    private $typeId;
    private $statusId;
    private $date;
    private $price;
    private $catId;
    private $empId;

    function __construct() {
        $this->id = null;
        $this->name = "";
        $this->desc = "";
        $this->typeId = null;
        $this->statusId = null;
        $this->date = null;
        $this->price = 0.00;
        $this->catId = null;
        $this->empId = null;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setDesc($desc) {
        $this->desc = $desc;
    }

    public function getDesc() {
        return $this->desc;
    }

     public function setTypeId($typeId) {
        $this->typeId = $typeId;
    }

    public function getTypeId() {
        return $this->typeId;
    }

    public function setStatusId($statusId) {
        $this->statusId = $statusId;
    }

    public function getStatusId() {
        return $this->statusId;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getDate() {
        return $this->date;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setCatId($catId) {
        $this->catId = $catId;
    }

    public function getCatId() {
        return $this->catId; 
    }

    public function setEmpId($empId) {
        $this->empId = $empId;
    }

    public function getEmpId() {
        return $this->empId; 
    }

} ?>