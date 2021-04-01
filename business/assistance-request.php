<?php 
class AssistanceRequest{

    // declare instance variables.
	private $id;
    private $date;
    private $statusId;
    private $comment;
    private $product;   // request products (object) array.
    private $client;    // request client (object).
    private $employee;  // request employee (object).

    // initialize request instance variables.
    function __construct() {
        $this->id = null;
        $this->date = null;
        $this->statusId = null;
        $this->comment = "";
        $this->product = [];
        $this->client = null;
        $this->employee = null;
    }
    
    // set request id.
    public function setId($id) {
        $this->id = $id;
    }

    // return request id.
    public function getId() {
        return $this->id;
    }

    // set request date.
    public function setDate($date) {
        $this->date = $date;
    }

    // return request date.
    public function getDate() {
        return $this->date;
    }

    // set request stataus.
    public function setStatusId($statusId) {
        $this->statusId = $statusId;
    }

    // return request status.
    public function getStatusId() {
        return $this->statusId;
    }

    // set a comment
    public function setComment($comment) {
        $this->comment = $comment;
    }

    // return comment.
    public function getComment() {
        return $this->comment;
    }

    // set request products array. 
    public function setProduct($product) {
        $this->product[] = $product;
    }

    // return an array of product objects.
    public function getProducts() {
        return $this->product;
    }

    // set request client.
    public function setClient($client) {
        $this->client = $client;
    }

    // return request client.
    public function getClient() {
        return $this->client;
    }

    // set request employee
    public function setEmployee($employee) {
        $this->employee = $employee;
    }

    // return request employee.
    public function getEmployee() {
        return $this->employee;
    }

} ?>