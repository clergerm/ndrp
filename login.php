<?php 
include "conf/app.php";
include App::FULL_DIR."/controller/user-controller.php";
include App::FULL_DIR."/include/header.php" 
?>
<main>
    <section class="main-content">
        
        <!---Display error message, if any-->
        <?php if ( isset(App::$msg["error"]) ) { ?>
            <section class="error">
                <ul>
                    <?php foreach (App::$msg["error"] as $v) { ?>
                        <li><?php echo $v; ?></li>
                    <?php } ?>
                </ul>
            </section>
        <?php } ?>

        <div id="login">
            <h1>Sign in to your account</h1>
            <form action="" method="post">
                <input type="hidden" name="action" value="loginUser" />

                <label>Email:</label>
                <input type="text" name="userEmail" 
                value="<?php if (isset($_POST["userEmail"])) echo $_POST["userEmail"]; ?>" />

                <label>Password</label>
                <input type="password" name="userPwd" value="" />

                <input type="submit" value="Login" /><br>

                <strong>Don't have an accoount?</strong> <a href="register.php">Create a client account now.</a>
            </form>
        </div><!--login-->
    </section>
</main>
<?php include "include/footer.php" ?>
