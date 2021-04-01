<?php 
include App::FULL_DIR."/data/db-connect.php";
include App::FULL_DIR."/controller/validate.php";
include App::FULL_DIR."/business/product.php";
include App::FULL_DIR."/data/product-db.php";

class ProductController{

	public static $categories = [];
	public static $types = [];
	public static $statuses = [];
	public static $product = null;
	public static $products = [];

	public static function execPost(){

		// Initialises action variable.
		$action = $_POST["action"];

		if ($action == "addProduct" || $action == "editProduct") {

			// checks if category is empty.
			if(Validate::isEmpty($_POST["catId"]))
				App::$msg["error"][] = "Item category cannot be empty.";

			// checks if type is empty.
			if(!isset($_POST["typeId"]))
				App::$msg["error"][] = "Item type is required.";

			// checks if status is empty.
			if(!isset($_POST["statusId"]))
				App::$msg["error"][] = "Item status is required.";

			// checks if name is empty.
			if(Validate::isEmpty($_POST["prodName"]))
				App::$msg["error"][] = "Item name cannot be empty.";

			// checks if description is empty.
			$_POST["prodDesc"] = trim($_POST["prodDesc"]);
			if(Validate::isEmpty($_POST["prodDesc"]))
				App::$msg["error"][] = "Item description cannot be empty.";

			// Create a product and set its attributes.
			self::$product = new Product();
			if ($action == "editProduct") 
				self::$product->setId($_POST["prodId"]);
			self::$product->setCatId($_POST["catId"]);
			if(isset($_POST["typeId"])) 
				self::$product->setTypeId($_POST["typeId"]);
			if(isset($_POST["statusId"])) 
				self::$product->setStatusId($_POST["statusId"]);
			self::$product->setName($_POST["prodName"]);
			self::$product->setDesc($_POST["prodDesc"]);
			self::$product->setPrice($_POST["prodPrice"]);
			self::$product->setEmpId($_SESSION['user']['Id']);

			// if there is no errors.
			if ( !isset(App::$msg["error"]) ) {

				// Depending on action, do an insertion or an update.
				if ($action == "addProduct"){

					// Insert the product.
					if(ProductDB::insert(self::$product)) {
						App::$msg["success"]["title"] = "Your Item has been added successfully.";
						App::$msg["success"]["bd"] = "Thanks";
					} else {
						App::$msg["failure"]["title"] = "Insertion failed.";
						App::$msg["failure"]["bd"] = "Please, try again.";
					} 

				} else if ($action == "editProduct"){

					// update the product.
					if(ProductDB::update(self::$product) == 1) {
						App::$msg["success"]["title"] = "Update successful.";
						App::$msg["success"]["bd"] = "Thanks";
					} else {
						App::$msg["failure"]["title"] = "Update failed.";
						App::$msg["failure"]["bd"] = "Please, try again.";
					} 

				}
			}
		}
	}

	// set data needed for the page.
	public static function setContent(){

		// If URL is correct.
		$uriParts = pathinfo($_SERVER["REQUEST_URI"]);

		if ($uriParts['filename'] == "add-product"){

			// highlight appropriate side menu.
			App::$aside = "Add";

			// get a list of product categories.
			self::$categories = ProductDB::selectCategories();

			// get a list of product types.
			self::$types = ProductDB::selectTypes();

			// get a list of product statuses.
			self::$statuses = ProductDB::selectStatuses();

		} else if ($uriParts['filename'] == "edit-product"){

			// highlight appropriate side menu.
			App::$aside = "Add";

			// get a list of product categories.
			self::$categories = ProductDB::selectCategories();

			// get a list of product types.
			self::$types = ProductDB::selectTypes();

			// get a list of product statuses.
			self::$statuses = ProductDB::selectStatuses();

			if (isset($_GET["prodId"]) && $_GET["prodId"] > 0){
			
				// get matched record from db.
				self::$product = ProductDB::selectProduct($_GET["prodId"]);

			} else {
				// Otherwsie, show an error message.
				App::$msg["error"][] = "URL error, please verify.";
			}

		} else if ($uriParts['filename'] == "my-products"){
			
			// highlight appropriate side menu.
			App::$aside = "View";

			// get a list of product categories.
			self::$categories = ProductDB::selectCategories();

			// get a list of product types.
			self::$types = ProductDB::selectTypes();

			// get a list of product statuses.
			self::$statuses = ProductDB::selectStatuses();
			
			// select all products.
			self::$product = ProductDB::selectProducts();
			
		} else if ($uriParts["filename"] == "products"){

			// get a list of product categories.
			self::$categories = ProductDB::selectCategories();
			
			// get a list of product types.
			self::$types = ProductDB::selectTypes();

			$parameters = false;
				
			if (isset($_GET["typeId"]) && $_GET["typeId"] > 0){
				$parameters = true;
				$filter = "prod_type_id = ?";
				$param = [$_GET["typeId"]];
			}
				

			if ($parameters)
				// select products to be chosen from using search criterias.
				self::$products = ProductDB::selectProducts($filter, $param);
			else 
				// select products to be chosen from using search criterias.
				self::$products = ProductDB::selectProducts();
		}
	}

	// sends the request to the rigth method.
	public static function execRequest(){

		// set data needed for the page to work.
		self::setContent();
 
		// If post, call post method.
		if ($_POST)
			self::execPost();
	}
}

// calss execRequest static method
ProductController::execRequest(); 
?>