<?php 
class User{
	protected $id;
    protected $email;
    protected $pwd;
    protected $date;
    protected $type;
    protected $status;

    function __construct() {
        $this->id = 0;
        $this->email = "";
        $this->pwd = "";
        $this->date = null;
        $this->type = "";
        $this->status = "";
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setPwd($pwd) {
        $this->pwd = $pwd;
    }

    public function getPwd() {
        return $this->pwd;
    }

     public function setDate($date) {
        $this->date = $date;
    }

    public function getDate() {
        return $this->date;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getType() {
        return $this->type;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getStatus() {
        return $this->status;
    }
} ?>