<?php 
include App::FULL_DIR."/data/db-connect.php";
include App::FULL_DIR."/controller/validate.php";

// 3 lines below allow to handle user object.
include App::FULL_DIR."/business/user.php";
include App::FULL_DIR."/business/client.php";
include App::FULL_DIR."/business/employee.php";
include App::FULL_DIR."/data/user-db.php";

// 2 lines below allow to handle product object.
include App::FULL_DIR."/business/product.php";
include App::FULL_DIR."/data/product-db.php";

include App::FULL_DIR."/business/assistance-request.php";
include App::FULL_DIR."/data/assistance-request-db.php";

class AssistanceRequestController{

	public static $products = [];
	public static $assReq = null;
	public static $assReqs = [];
	public static $statuses = [];

	public static function execPost(){

		// Initialises action variable.
		$action = $_POST["action"];
	
		if ($action == "addAssReq" || $action == "editAssReq") {

			// checks if product is empty.
			if(!isset($_POST["assReqProd"]))
				App::$msg["error"][] = "At least 1 product in the list must be chosen.";
			
			// Create an assistance request and set its attributes.
			self::$assReq = new AssistanceRequest();
		
			// set request client.
			$client = new Client();
			$client->setId($_SESSION['user']['Id']);
			self::$assReq->setClient($client);

			// set the products selected.
			foreach ($_POST["assReqProd"] as $k => $v){
				$product = new Product();
				$product->setId($k); 
				self::$assReq->setProduct($product);
			}

			// set request comment.
			self::$assReq->setComment($_POST["assReqComment"]);

			// set request status to New if adding a request.
			self::$assReq->setStatusId(AssistanceRequestDB::selectStatus("New"));

			// if there is no errors.
			if ( !isset(App::$msg["error"]) ) {

				// Depending on action, do an insertion or an update.
				if ($action == "addAssReq"){

					// Insert the product.
					if(AssistanceRequestDB::insert(self::$assReq)) {
						App::$msg["success"]["title"] = "Your Item has been added successfully.";
						App::$msg["success"]["bd"] = "Thanks";
					} else {
						App::$msg["failure"]["title"] = "Insertion failed.";
						App::$msg["failure"]["bd"] = "Please, try again.";
					} 

				}
			}
		}
	}

	// set data needed for the page to work.
	public static function setContent(){

		// If URL is correct.
		$uriParts = pathinfo($_SERVER["REQUEST_URI"]);

		if ($uriParts['filename'] == "add-assistance-request"){

			// set to highlight appropriate.
			App::$aside = "Add";

			// Prepare search filter
			$filter = "prod_status_id = ?";
			$param = [ProductDB::selectStatus("Active")];
			
			// select products to be chosen from using search criterias.
			self::$products = ProductDB::selectProducts($filter, $param);

		} else if ($uriParts['filename'] == "edit-assistance-request"){

			// set to highlight appropriate.
			App::$aside = "Add";

			// Prepare search filter
			$filter = "prod_status_id = ?";
			$param = [ProductDB::selectStatus("Active")];
			
			// select products to be chosen from using search criterias.
			self::$products = ProductDB::selectProducts($filter, $param);

			if (isset($_GET["assReqId"]) && $_GET["assReqId"] > 0){
			
				// get matched record from db.
				self::$assReq = ProductDB::selectProduct($_GET["assReqId"]);
				self::$assReq = null; // to remove

			} else {
				// Otherwsie, show an error message.
				App::$msg["error"][] = "URL error, please verify.";
			}
		} else if ($uriParts['filename'] == "my-assistance-requests"){

			App::$aside = "View";
			
			// get a list of product statuses.
			self::$statuses = AssistanceRequestDB::selectStatuses();

			// select all assistance requests
			self::$assReqs = AssistanceRequestDB::selectAssistanceRequests();
		
		} else if ($uriParts['filename'] == "assistance-requests"){

			App::$aside = "Ass";

			// get a list of product statuses.
			self::$statuses = AssistanceRequestDB::selectStatuses();

			// select all assistance requests
			self::$assReqs = AssistanceRequestDB::selectAssistanceRequests();
		
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
AssistanceRequestController::execRequest(); 
?>