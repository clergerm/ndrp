<?php 
class AssistanceRequestDB{

    // Get a list of product statuses.
    public static function selectStatuses(){

        // establishes the DB connection.
        $pdo = DbConnect::getConnection();
        
        $list = [];

        // builds the query string.
        $sql = "SELECT ass_req_status_id, ass_req_status_name FROM assistance_request_status WHERE 1";

        // prepares the query.
        $stmt = $pdo->prepare($sql);

        // executes the query.
        if ($stmt->execute()) {

            // set result to be an associative array.
            $rs = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

            // returns records as associative array.
            $data = $stmt->fetchAll();
            
            // if records found, return an associative array, otherwise return an empty array.
            if (count($data) > 0) {
                foreach ($data as $k => $v) {
                    $list[$v["ass_req_status_id"]] = $v["ass_req_status_name"];
                }
            }
        }

        return $list;
    }

    // insert an assistance request into db.
    public static function insert($assReq) {

        $pdo = DbConnect::getConnection();

        $sql = "INSERT INTO assistance_request (ass_req_date, ass_req_status_id, ass_req_comment, cli_id) 
                VALUES (NOW(), ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $param = [$assReq->getStatusId(), $assReq->getComment(), $assReq->getClient()->getId()];

        // return true if it insert successfully, otherwise return false.
        if ($stmt->execute($param)){

            // get last inserted user id.
            $id = $pdo->lastInsertId();

            // returned products posted.
            $prooducts = $assReq->getProducts();

            // Loop through cproducts posted.
            // and insert posted products that the client requested for.
            foreach ($prooducts as $k => $v) {
                
                $sql = "INSERT INTO assistance_request_product (ass_req_id, prod_id) 
                VALUES (?, ?)";
                $stmt = $pdo->prepare($sql);

                // for the client, get all chosen products posted.
                $param = [$id, $v->getId()];
                $stmt->execute($param);
            }

            return true;
        }

        return false;
    }

    
    // select an assistance request status from the DB.
    public static function selectStatus($status){

        // establishes the DB connection.
        $pdo = DbConnect::getConnection();

        // builds the query string.
        $sql = "SELECT ass_req_status_id FROM assistance_request_status WHERE ass_req_status_name = ?";

        // prepares the query.
        $stmt = $pdo->prepare($sql);

        // executes the query.
        if ($stmt->execute([$status])) {

            // set result to be an associative array.
            $rs = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

            // returns records as associative array.
            $data = $stmt->fetchAll();
            
            // if records found, return an associative array, otherwise return an empty array.
            if (count($data) == 1) {
                return $data[0]["ass_req_status_id"];
            }
        }

        return null;
    }

    // select active products that can be requested.
    public static function selectAssistanceRequests() {

        // declare an empty products array.
        $reqs = [];

        // connect to DB.
        $pdo = DbConnect::getConnection();
        
        // builds the query string.
        $sql = "SELECT * FROM assistance_request WHERE 1";

        // prepares the query.
        $stmt = $pdo->prepare($sql);
        
        // executes the query.
        if ($stmt->execute()) {

            // set resultset to be fetched as an associative array.
            $rs = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

            // store returned product records as an associative array.
            $reqData = $stmt->fetchAll();

            // If there are products returned.
            if (count($reqData) > 0) {

                // loop through returned products.
                foreach ($reqData as $v) {
                    
                    // Instantiate a assistance request.
                    $req = new AssistanceRequest();
                    $req->setId($v["ass_req_id"]);
                    $req->setDate($v["ass_req_date"]);
                    $req->setStatusId($v["ass_req_status_id"]);
                    $req->setComment($v["ass_req_comment"]);

                    // set request client.
                    $client = new Client();
                    $client->setId($v["cli_id"]);
                    $req->setClient($client);

                    // set request employee.
                    $emp = new Employee();
                    $emp->setId($v["emp_id"]);
                    $req->setEmployee($emp);

                    // set request products;
                    // builds the query string.
                    $sql = "SELECT * FROM assistance_request_product AS arp 
                        INNER JOIN product AS p ON arp.prod_id = p.prod_id 
                        WHERE arp.ass_req_id=?";

                    // prepares the query.
                    $stmt = $pdo->prepare($sql);
                    
                    // executes the query.
                    if ($stmt->execute([$v["ass_req_id"]])) {

                        // store returned product records as an associative array.
                        $prodData = $stmt->fetchAll();

                        // If there are products returned.
                        if (count($prodData) > 0) {

                            // loop through returned products.
                            foreach ($prodData as $val) {

                                $product = new Product();
                                $product->setId($val["prod_id"]);
                                $product->setName($val["prod_name"]);
                                $product->setDesc($val["prod_desc"]);
                                $product->setTypeId($val["prod_type_id"]);
                                $product->setStatusId($val["prod_status_id"]);
                                $product->setPrice($val["prod_price"]);
                                $product->setDate($val["prod_date"]);
                                $product->setCatId($val["cat_id"]);
                                $product->setEmpId($val["emp_id"]);

                                // set current product to request.
                                $req->setProduct($product);

                            }
                        }

                    }

                    // add the product to the array.
                    $reqs[$v["ass_req_id"]] = $req;

                }
            }
        }

        // return products array.
        return $reqs;
    }
} ?>