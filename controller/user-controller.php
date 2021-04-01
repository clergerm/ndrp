<?php 
include App::FULL_DIR."/data/db-connect.php";
include App::FULL_DIR."/controller/validate.php";
include App::FULL_DIR."/business/user.php";
include App::FULL_DIR."/business/client.php";
include App::FULL_DIR."/business/employee.php";
include App::FULL_DIR."/data/user-db.php";

class UserController{

	public static $states = array();

	public static function execPost(){

		// Initialises action variable.
		$action = $_POST["action"];

		// Validate login data.
		if($action == "loginUser"){

			// Check if email is empty.
			if(!isset($_POST["userEmail"]) || 
			Validate::isEmpty($_POST["userEmail"]))
				App::$msg["error"]["userEmail"] = "Email cannot be empty.";

			// Check if password is empty.
			if(!isset($_POST["userPwd"]) || 
				Validate::isEmpty($_POST["userPwd"]))
				App::$msg["error"]["userPwd"] = "Password cannot be empty.";

			// proceeds, if there is no errors.
			if ( !isset(App::$msg["error"]) ) {

				// Instanciate a user object.
				$user = new User();

				// Assigns values to the user attributes.
				$user->setEmail($_POST["userEmail"]);
				$user->setPwd($_POST["userPwd"]);
				
				// call Login and provide user's email and password in argument.
				// And, override user by assigning it the returned user object.
				$user = UserDB::login($user->getEmail(), $user->getPwd());

				if (!($user === null)){
					
					// Load user data in session.
					$_SESSION["user"]["Id"] = $user->getId();
					$_SESSION["user"]["email"] = $user->getEmail();
					$_SESSION["user"]["type"] = $user->getType();
					$_SESSION["user"]["date"] = $user->getDate();
					$_SESSION["user"]["status"] = $user->getStatus();
					$_SESSION["user"]["firstName"] = $user->getFirstName();
					$_SESSION["user"]["lastName"] = $user->getLastName();
					
					// makes sure to redirects to proper location.
					$redirTo = App::FULL_URL."/account"; // Default (Client)
					if ($user->getType() == "Employee") 
						$redirTo = App::FULL_URL."/admin";
					
					// proceeds to the redirection.
					header("location:".$redirTo);
					exit(); // stops remaining execution.
				} else {
					// sets an error message.
					App::$msg["error"]["failure"] = "Your email or password is incorrect.";
				}
			}

		} else if($action == "registerClient"){ // register a client.

			// checks if first name is empty.
			if(!isset($_POST["userFirstName"]) || Validate::isEmpty($_POST["userFirstName"]))
				App::$msg["error"]["userFirstName"] = "First name cannot be empty.";

			// Check if last name is empty.
			if(!isset($_POST["userLastName"]) || Validate::isEmpty($_POST["userLastName"]))
				App::$msg["error"]["userLastName"] = "Last name cannot be empty.";

			// Check if home phone is empty.
			if(!isset($_POST["userHomePhone"]) || Validate::isEmpty($_POST["userHomePhone"]))
				App::$msg["error"]["userHomePhone"] = "Home phone cannot be empty.";

			// Check if street address is empty.
			if(!isset($_POST["userAddress"]) || Validate::isEmpty($_POST["userAddress"]))
				App::$msg["error"]["userAddress"] = "Street address cannot be empty.";

			// Check if City is empty.
			if(!isset($_POST["userCity"]) || Validate::isEmpty($_POST["userCity"]))
				App::$msg["error"]["userCity"] = "City cannot be empty.";

			// Check if State is empty.
			if(!isset($_POST["userState"]) || Validate::isEmpty($_POST["userState"]))
				App::$msg["error"]["userState"] = "State cannot be empty.";

			// Check if ZipCode is empty.
			if(!isset($_POST["userZipCode"]) || Validate::isEmpty($_POST["userZipCode"]))
				App::$msg["error"]["userZipCode"] = "Zip code cannot be empty.";

			// Check if email is empty.
			if(!isset($_POST["userEmail"]) || Validate::isEmpty($_POST["userEmail"])) {
				App::$msg["error"]["userEmail"] = "Email cannot be empty.";
			} else {
				// check if email exists.
				if(UserDB::emailExists(trim($_POST["userEmail"])))
					App::$msg["error"]["userEmail"] = "Email already exists in the system.";
			}

			// Check if password is empty.
			if(!isset($_POST["userPwd"]) || Validate::isEmpty($_POST["userPwd"])) {
				App::$msg["error"]["userPwd"] = "Password cannot be empty.";
			} else { 
				if ( !Validate::isCorrectLength ( $_POST["userPwd"], 8 ) )
					App::$msg["error"]["userPwd"] = "Password must be at least 8 characters.";
			}
			
			// if there is no errors.
			if ( !isset(App::$msg["error"]) ) {

				// Instantiate a client object.
				$client = new Client();

				// assigns values to the client object.
				$client->setFirstName($_POST["userFirstName"]);
				$client->setLastName($_POST["userLastName"]);
				$client->setHomePhone($_POST["userHomePhone"]);
				$client->setCellPhone($_POST["userCellPhone"]);
				$client->setAddress($_POST["userAddress"]);
				$client->setCity($_POST["userCity"]);
				$client->setState($_POST["userState"]);
				$client->setZipCode($_POST["userZipCode"]);
				$client->setEmail(trim($_POST["userEmail"]));
				$client->setPwd(trim($_POST["userPwd"]));
				$client->setType("Client");
				$client->setStatus("Active"); // As email not confirmed yet.

				// Insert a new user. 
				// Pass the client object in argument as the Client is also a user.
				if(UserDB::insert($client)) {
					App::$msg["success"]["title"] = "Your account has been created successfully.";
					App::$msg["success"]["bd"] = "A confirmation email has been sent to your email. Next, you must 
					verify your email, otherwise, your account will not be activated.";
				} else {
					App::$msg["failure"]["title"] = "Account creation failed.";
					App::$msg["failure"]["bd"] = "Please, try again. If failure persists, contact us.";
				}
			}
			
		}
	}

	// set data needed for the page.
	public static function setContent(){

		// store a states array.
		self::$states = UserDB::selectStates();

	}

	// log user out.
	public static function logout(){

		// kill user session and redirect to login page.
		unset($_SESSION["user"]);
		header("location:login.php");
		exit(); 

	}

	// sends the request to the rigth method.
	public static function execRequest() {
		
		if (isset($_SERVER["REQUEST_URI"])) {

			// return url components array.
			$uriParts = pathinfo($_SERVER["REQUEST_URI"]);

			// Select dashboard side menu item.
			if ($uriParts['filename'] == "account" || $uriParts['filename'] == "admin")
				App::$aside = "Dash"; 
			
			// Select account settings side menu item.
			if ($uriParts['filename'] == "account-settings")
				App::$aside = "Settings";

			// Select my users side menu item.
			if ($uriParts['filename'] == "users")
				App::$aside = "Users";

			// Select invite user side menu item.
			if ($uriParts['filename'] == "invite-user")
				App::$aside = "Invite";

			// set content only for specific pages.
			if ($uriParts['filename'] == "register")
				self::setContent(); 

			// log user out.
			if ($uriParts['filename'] == "logout")
				self::logout();

			// process post request.
			if ($_POST) 
				self::execPost();
		}
	}
}

// calss execRequest static method
UserController::execRequest();
?>