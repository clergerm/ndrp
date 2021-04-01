<?php 
include "conf/app.php";
include App::FULL_DIR."/controller/user-controller.php";
include App::FULL_DIR."/include/header.php"
?>
<main>
    <section class="main-content">

        <!---Display success message, if any-->
        <?php if ( isset(App::$msg["success"]) ) { ?>

            <section class="success">
                <h2><?php echo App::$msg["success"]["title"]; ?></h2>
                <p><?php echo App::$msg["success"]["bd"]; ?></p>
            </section>

        <?php } else if ( isset(App::$msg["failure"]) ) { ?>

            <section class="failure">
                <h2><?php echo App::$msg["failure"]["title"]; ?></h2>
                <p><?php echo App::$msg["failure"]["bd"]; ?></p>
            </section>

        <?php } else {
            if ( isset(App::$msg["error"]) ) { ?>

            <section class="error">
                <ul>
                    <?php foreach (App::$msg["error"] as $v) { ?>
                        <li><?php echo $v; ?></li>
                    <?php } ?>
                </ul>
            </section>

            <?php } ?>

            <h1>Create your client account</h1>
            <section id="form">
                <p>(<span class="req">*</span>) indicates required field. </p>
                <form action="" method="post">
                    <input type="hidden" name="action" value="registerClient" />
                    <h2>Account Personal Information</h2>

                    <label>First Name: <span class="req">*</span></label>
                    <input type="text" name="userFirstName" 
                    value="<?php if (isset($_POST["userFirstName"])) echo $_POST["userFirstName"]; ?>" /><br>

                    <label>Last Name: <span class="req">*</span></label>
                    <input type="text" name="userLastName" 
                    value="<?php if (isset($_POST["userLastName"])) echo $_POST["userLastName"]; ?>" /><br>

                    <label>Home phone: <span class="req">*</span></label>
                    <input type="text" name="userHomePhone" 
                    value="<?php if (isset($_POST["userHomePhone"])) echo $_POST["userHomePhone"]; ?>" /><br>

                    <label>Mobile phone:</label>
                    <input type="text" name="userCellPhone" 
                    value="<?php if (isset($_POST["userCellPhone"])) echo $_POST["userCellPhone"]; ?>" /><br>

                    <label>Street address: <span class="req">*</span></label>
                    <input type="text" name="userAddress" 
                    value="<?php if (isset($_POST["userAddress"])) echo $_POST["userAddress"]; ?>" /><br>

                    <label>City: <span class="req">*</span></label>
                    <input type="text" name="userCity" 
                    value="<?php if (isset($_POST["userCity"])) echo $_POST["userCity"]; ?>" /><br>

                    <label>State: <span class="req">*</span></label>
                    <select  name="userState" id="userState">
                        <option value="" 
                        <?php if (isset($_POST["userState"]) && $_POST["userState"] == "") echo "selected"; ?>>Choose</option>

                        <?php if (count(UserController::$states) > 0) { 
                                foreach (UserController::$states as $k => $v) { ?>
                                    <option value="<?php echo $k; ?>" 
                                    <?php if (isset($_POST["userState"]) && $_POST["userState"] == $k) echo "selected"; ?>
                                    ><?php echo $v; ?></option>
                                <?php } ?>
                        <?php } ?>

                    </select><br>

                    <label>ZipCode: <span class="req">*</span></label>
                    <input type="text" name="userZipCode" 
                    value="<?php if (isset($_POST["userZipCode"])) echo $_POST["userZipCode"]; ?>" /><br>

                    <h2>Account Login Credentials</h2>

                    <label>Email: <span class="req">*</span></label>
                    <input type="text" name="userEmail" 
                    value="<?php if (isset($_POST["userEmail"])) echo $_POST["userEmail"]; ?>" /><br>

                    <label>Password: <span class="req">*</span></label>
                    <input type="password" name="userPwd" value="" /><br>
                    <label>&nbsp;</label>
                    <p class="input-note"><em>Password must be at least 8 characters.</em></p><br>

                    <label>&nbsp;</label>
                    <input type="submit" value="Create Account"/><br>
                </form>
            </section>
        <?php } ?>
    </section>
</main>
<?php include "include/footer.php" ?>