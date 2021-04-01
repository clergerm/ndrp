<?php 
class ProductDB{

    // select status from the DB.
    public static function selectStatus($status){

        // establishes the DB connection.
        $pdo = DbConnect::getConnection();

        // builds the query string.
        $sql = "SELECT prod_status_id FROM product_status WHERE prod_status_name = ?";

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
                return $data[0]["prod_status_id"];
            }
        }

        return null;
    }

    // Get a list of product categories.
    public static function selectCategories(){

        // establishes the DB connection.
        $pdo = DbConnect::getConnection();
        
        $list = [];

        // builds the query string.
        $sql = "SELECT cat_id, cat_name FROM category WHERE 1";

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
                    $list[$v["cat_id"]] = $v["cat_name"];
                }
            }
        }

        return $list;
    }

    
    // Get a list of product types.
    public static function selectTypes(){

        // establishes the DB connection.
        $pdo = DbConnect::getConnection();
        
        $list = [];

        // builds the query string.
        $sql = "SELECT prod_type_id, prod_type_name FROM product_type WHERE 1";

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
                    $list[$v["prod_type_id"]] = $v["prod_type_name"];
                }
            }
        }

        return $list;
    }

    // select status from the DB.
    public static function selectType($type){

        // establishes the DB connection.
        $pdo = DbConnect::getConnection();

        // builds the query string.
        $sql = "SELECT prod_type_id FROM product_type WHERE prod_type_name = ?";

        // prepares the query.
        $stmt = $pdo->prepare($sql);

        // executes the query.
        if ($stmt->execute([$type])) {

            // set result to be an associative array.
            $rs = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

            // returns records as associative array.
            $data = $stmt->fetchAll();
            
            // if records found, return an associative array, otherwise return an empty array.
            if (count($data) == 1) {
                return $data[0]["prod_type_id"];
            }
        }

        return null;
    }

    // Get a list of product statuses.
    public static function selectStatuses(){

        // establishes the DB connection.
        $pdo = DbConnect::getConnection();
        
        $list = [];

        // builds the query string.
        $sql = "SELECT prod_status_id, prod_status_name FROM product_status WHERE 1";

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
                    $list[$v["prod_status_id"]] = $v["prod_status_name"];
                }
            }
        }

        return $list;
    }
    
    // insert product into db.
	public static function insert($product) {

        $pdo = DbConnect::getConnection();

        $sql = "INSERT INTO product (prod_name, prod_desc, prod_type_id, prod_status_id, prod_price, prod_date, cat_id, emp_id) 
                VALUES (?, ?, ?, ?, ?, NOW(), ?, ?)";
        $stmt = $pdo->prepare($sql);
        $param = [$product->getName(), $product->getDesc(), $product->getTypeId(), $product->getStatusId(), 
            $product->getPrice(), $product->getCatId(), $product->getEmpId()];

        // return true if it insert successfully, otherwise return false.
        if ($stmt->execute($param))
            return true;
        else 
            return false;
    }

    // select a product from the DB.
    public static function selectProduct($prodId){

        // establishes the DB connection.
        $pdo = DbConnect::getConnection();

        // builds the query string.
        $sql = "SELECT * FROM product WHERE prod_id = ?";

        // prepares the query.
        $stmt = $pdo->prepare($sql);

        // executes the query.
        if ($stmt->execute([$prodId])) {

            // set result to be an associative array.
            $rs = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

            // returns records as associative array.
            $data = $stmt->fetchAll();
            
            // if records found, return an associative array, otherwise return an empty array.
            if (count($data) == 1) {
                
                $product = new Product();
                $product->setId($data[0]["prod_id"]);
                $product->setName($data[0]["prod_name"]);
                $product->setDesc($data[0]["prod_desc"]);
                $product->setTypeId($data[0]["prod_type_id"]);
                $product->setStatusId($data[0]["prod_status_id"]);
                $product->setPrice($data[0]["prod_price"]);
                $product->setDate($data[0]["prod_date"]);
                $product->setCatId($data[0]["cat_id"]);
                $product->setEmpId($data[0]["emp_id"]);
                return $product;
            }
        }

        return null;
    }

    // upade product    
    public static function update ($product) {

        // establishes the DB connection.
        $pdo = DbConnect::getConnection();

        $sql = "UPDATE product SET "
                . "prod_name = ?, "
                . "prod_desc = ?, "
                . "prod_type_id = ?, "
                . "prod_status_id = ?, "
                . "prod_price = ?, "
                . "cat_id = ? "
                . "WHERE prod_id = ?";
                
        $stmt = $pdo->prepare($sql);
        $param = [$product->getName(), $product->getDesc(), $product->getTypeId(), $product->getStatusId(), 
            $product->getPrice(), $product->getCatId(), $product->getId()];

        // return true if it insert successfully, otherwise return false.
        if ($stmt->execute($param))
            return $stmt->rowCount();
        else 
            return 0;
    }

    // select active products that can be requested.
    public static function selectProducts($filter = "1", $param = []) {

        // declare an empty products array.
        $products = [];

        // connect to DB.
        $pdo = DbConnect::getConnection();
        
        // builds the query string.
        $sql = "SELECT * FROM product WHERE $filter";

        // prepares the query.
        $stmt = $pdo->prepare($sql);
        
        // executes the query.
        if ($stmt->execute($param)) {

            // set resultset to be fetched as an associative array.
            $rs = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

            // store returned product records as an associative array.
            $data = $stmt->fetchAll();

            // If there are products returned.
            if (count($data) > 0) {

                // loop through returned products.
                foreach ($data as $k => $v) {
                    
                    // Instantiate a product.
                    $product = new Product();
                    $product->setId($data[$k]["prod_id"]);
                    $product->setName($data[$k]["prod_name"]);
                    $product->setDesc($data[$k]["prod_desc"]);
                    $product->setTypeId($data[$k]["prod_type_id"]);
                    $product->setStatusId($data[$k]["prod_status_id"]);
                    $product->setPrice($data[$k]["prod_price"]);
                    $product->setDate($data[$k]["prod_date"]);
                    $product->setCatId($data[$k]["cat_id"]);
                    $product->setEmpId($data[$k]["emp_id"]);

                    // add the product to the array.
                    $products[$data[$k]["prod_id"]] = $product;
                }
            }
        }

        // return products array.
        return $products;
    }
} ?>