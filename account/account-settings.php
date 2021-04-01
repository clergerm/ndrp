<?php 
include "../conf/app.php";
include App::FULL_DIR."/controller/user-controller.php";
include App::FULL_DIR."/account/include/header.php"
?>
<main>
    <section class="acc-content">
        <section id="acc-aside">
        	<?php include App::FULL_DIR."/account/include/side-bar.php" ?>
        </section>
        <section id="acc-content-area">
            <h1>Account settings</h1>
            <section id="form">
                <p>Account settings to be implemented.</p>
            </section>
        </section><br>
    </section>
</main>
<?php include App::FULL_DIR."/include/footer.php" ?>