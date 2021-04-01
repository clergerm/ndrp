<?php 
class UserDB{

    // Log user in
    public static function login ($userEmail, $userPwd) {

        $pdo = DbConnect::getConnection();
        $sql = "SELECT * FROM account WHERE acc_email = ? and acc_pwd = ?";
        $stmt = $pdo->prepare($sql);
        $param = [$userEmail, $userPwd];

        // set result to be an associative array.
        $rs = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

        if ($stmt->execute($param)) {
            
            // If logged in, instantiate and 
            // assign retrieved values to user object. 
            
            $userData = $stmt->fetchAll();
            if (count($userData) > 0){
                
                if ($userData[0]["acc_type"] == "Client"){

                    // Add client account data
                    $client = new Client();
                    $client->setId($userData[0]["acc_id"]);
                    $client->setEmail($userData[0]["acc_email"]);
                    $client->setType($userData[0]["acc_type"]);
                    $client->setDate($userData[0]["acc_date"]);
                    $client->setStatus($userData[0]["acc_status"]);

                    // Find more client data to be added.
                    $sql = "SELECT cli_first_name, cli_last_name FROM Client WHERE cli_id = ?";
                    $stmt = $pdo->prepare($sql);
                    $param = [$userData[0]["acc_id"]];

                    if ($stmt->execute($param)) {

                        $cliData = $stmt->fetchAll();

                        if (count($cliData) > 0){

                            $client->setFirstName($cliData[0]["cli_first_name"]);
                            $client->setLastName($cliData[0]["cli_last_name"]);

                            return $client;
                        }
                    }
                } else if ($userData[0]["acc_type"] == "Employee"){ 

                    // Add employee account data
                    $emp = new Employee();
                    $emp->setId($userData[0]["acc_id"]);
                    $emp->setEmail($userData[0]["acc_email"]);
                    $emp->setType($userData[0]["acc_type"]);
                    $emp->setDate($userData[0]["acc_date"]);
                    $emp->setStatus($userData[0]["acc_status"]);

                    // Find more employee data to be added.
                    $sql = "SELECT emp_first_name, emp_last_name FROM employee WHERE emp_id = ?";
                    $stmt = $pdo->prepare($sql);
                    $param = [$userData[0]["acc_id"]];

                    if ($stmt->execute($param)) {

                        $empData = $stmt->fetchAll();

                        if (count($empData) > 0){

                            $emp->setFirstName($empData[0]["emp_first_name"]);
                            $emp->setLastName($empData[0]["emp_last_name"]);

                            return $emp;
                        }
                    }
                }

            }else{
                // If log in failed
                return null;
            }

        } else {
            // If log in failed
            return null;
        }
    }

    // retreive state abbreviations and names.
    public static function selectStates(){

        // establishes the DB connection.
        $pdo = DbConnect::getConnection();

        $list = [];

        // builds the query string.
        $sql = "SELECT state_name, state_abbr FROM state WHERE 1";

        // prepares the query.
        $stmt = $pdo->prepare($sql);

        // executes the query.
        $stmt->execute();

        // set result to be an associative array.
        $rs = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

        // returns records as associative array.
        $data = $stmt->fetchAll();
        
        // if records found, return an associative array, otherwise return an empty array.
        if (count($data) > 0) {
            foreach ($data as $k => $v) {
                $list[$v["state_abbr"]] = $v["state_name"];
            }
        }

        return $list;
    }

    // check if email exists.
	public static function emailExists($userEmail) {
        $pdo = DbConnect::getConnection();
        $sql = "SELECT acc_id FROM account WHERE acc_email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userEmail]);

        // set result to be an associative array.
        $rs = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        if (count ($stmt->fetchAll()) > 0)
            return true;
        else
            return false; 
    }
    
    // insert user into db.
	public static function insert($user) {

        $pdo = DbConnect::getConnection();

        $sql = "INSERT INTO account (acc_email, acc_pwd, acc_date, acc_type, acc_status) 
                VALUES (?, ?, NOW(), ?, ?)";
        $stmt = $pdo->prepare($sql);
        $param = [$user->getEmail(), $user->getPwd(), $user->getType(), $user->getStatus()];

        // Insert parent part of user
        if ($stmt->execute($param)){

            // get last inserted user id.
            $id = $pdo->lastInsertId();

            // Insert child part of user.
            if ($user->getType() == "Client"){

                $sql = "INSERT INTO client (cli_id, cli_first_name, cli_last_name, cli_address, cli_city, cli_state, 
                        cli_zip_code, cli_home_phone, cli_cell_phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $param = [$id, $user->getFirstName(), $user->getLastName(), $user->getAddress(), $user->getCity(), 
                        $user->getState(), $user->getZipCode(), $user->getHomePhone(), $user->getCellPhone()];

            }
            $stmt->execute($param);

            return true;

        } else {
            return false;
        }
    }
} ?>