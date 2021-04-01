<?php 
use PHPUnit\Framework\TestCase;

final class registerClientTest extends TestCase {
    
    /** @test 
     * Test expected to genarate an error message if user attemps 
     * to register with an empty email. */
    public function testExecPostEmailEmpty() {
        unset(App::$msg["error"]);
        $_POST["action"] = "registerClient";
        $_POST["userEmail"] = "";
        UserController::execPost();
        $this->assertArrayHasKey("userEmail", App::$msg["error"]);
    }

    /** @test
     * Test expected to register user if ueing a new email.
     */
    public function testExecPostEmailNew(){
        unset(App::$msg["error"]);
        $_POST["action"] = "registerClient";
        $_POST["userEmail"] = "clergerm.new@gmail.com";
        UserController::execPost();
        $this->assertArrayNotHasKey("userEmail", App::$msg["error"]);
    }

    /** @test
     * Test expected to generate an error message if user attempts 
     * to register with an existing email.
     */
    public function testExecPostEmailExist(){
        unset(App::$msg["error"]);
        $_POST["action"] = "registerClient";
        $_POST["userEmail"] = "clergerm@gmail.com";
        UserController::execPost();
        $this->assertArrayHasKey("userEmail", App::$msg["error"]);
    }

    /** @test
     * Test expected to generate an error message if user attempts 
     * to register with an empty password.
     */
    public function testExecPostPwdEmpty(){
        unset(App::$msg["error"]);
        $_POST["action"] = "registerClient";
        $_POST["userPwd"] = "";
        UserController::execPost();
        $this->assertArrayHasKey("userPwd", App::$msg["error"]);
    }

    /** @test
     * Test expected to generate an error message if user attempts 
     * to register with a password less than 8 characters.
     */
    public function testExecPostPwdLessThanExpectedNumChars(){
        unset(App::$msg["error"]);
        $_POST["action"] = "registerClient";
        $_POST["userPwd"] = "1231b";
        UserController::execPost();
        $this->assertArrayHasKey("userPwd", App::$msg["error"]);
    }

    /** @test
     * Test expected to generate an error message if user attempts 
     * to register with an empty first name.
     */
    public function testExecPostFirstNameEmpty(){
        unset(App::$msg["error"]);
        $_POST["action"] = "registerClient";
        $_POST["userFirstName"] = "";
        UserController::execPost();
        $this->assertArrayHasKey("userFirstName", App::$msg["error"]);
    }

    /** @test
     * Test expected to generate an error message if user attempts 
     * to register with an empty last name.
     */
    public function testExecPostLastNameEmpty(){
        unset(App::$msg["error"]);
        $_POST["action"] = "registerClient";
        $_POST["userLastName"] = "";
        UserController::execPost();
        $this->assertArrayHasKey("userLastName", App::$msg["error"]);
    }

    /** @test
     * Test expected to generate an error message if user attempts 
     * to register with an empty home phone.
     */
    public function testExecPostHomePhoneEmpty(){
        unset(App::$msg["error"]);
        $_POST["action"] = "registerClient";
        $_POST["userHomePhone"] = "";
        UserController::execPost();
        $this->assertArrayHasKey("userHomePhone", App::$msg["error"]);
    }

    /** @test
     * Test expected to generate an error message if user attempts 
     * to register with an empty address.
     */
    public function testExecPostAddressEmpty(){
        unset(App::$msg["error"]);
        $_POST["action"] = "registerClient";
        $_POST["userAddress"] = "";
        UserController::execPost();
        $this->assertArrayHasKey("userAddress", App::$msg["error"]);
    }

    /** @test
     * Test expected to generate an error message if user attempts 
     * to register with an empty city.
     */
    public function testExecPostCityEmpty(){
        unset(App::$msg["error"]);
        $_POST["action"] = "registerClient";
        $_POST["userCity"] = "";
        UserController::execPost();
        $this->assertArrayHasKey("userCity", App::$msg["error"]);
    }

    /** @test
     * Test expected to generate an error message if user attempts 
     * to register with an empty state.
     */
    public function testExecPostStateEmpty(){
        unset(App::$msg["error"]);
        $_POST["action"] = "registerClient";
        $_POST["userState"] = "";
        UserController::execPost();
        $this->assertArrayHasKey("userState", App::$msg["error"]);
    }

    /** @test
     * Test expected to generate an error message if user attempts 
     * to register with an empty zip code.
     */
    public function testExecPostZipCodeEmpty(){
        unset(App::$msg["error"]);
        $_POST["action"] = "registerClient";
        $_POST["userZipCode"] = "";
        UserController::execPost();
        $this->assertArrayHasKey("userZipCode", App::$msg["error"]);
    }
}
?>