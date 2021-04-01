<?php 
use PHPUnit\Framework\TestCase;

final class LoginTest extends TestCase {
    
    /** @test 
     * Test expected to genarate an error message if user attempts ]
     * to log in with an empty email. */
    public function execPostEmailEmptyTest() {
        unset(App::$msg["error"]);
        $_POST["action"] = "loginUser";
        $_POST["userEmail"] = "";
        UserController::execPost();
        $this->assertArrayHasKey("userEmail", App::$msg["error"]);
    }

    /** @test 
     * Test expected to generate an error message if user attempts 
     * to log with an empty password.*/
    public function testExecPostPwdEmpty() {
        unset(App::$msg["error"]);
        $_POST["action"] = "loginUser";
        $_POST["userPwd"] = "";
        UserController::execPost();
        $this->assertArrayHasKey("userPwd", App::$msg["error"]);
    }

    /** @test 
     * Test expected to generate a failure message if login attempt 
     * using email and password failed.*/
    public function testExecPostLoginFailed() {
        unset(App::$msg["error"]);
        $_POST["action"] = "loginUser";
        $_POST["userEmail"] = "mdcspring21@mdc.edu";
        $_POST["userPwd"] = "Spring2021";
        UserController::execPost();
        $this->assertArrayHasKey("failure", App::$msg["error"]);
    } 
}
?>