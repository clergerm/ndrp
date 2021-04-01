<?php
include "../conf/app.php";
include App::FULL_DIR."/controller/user-controller.php";
include App::FULL_DIR."/admin/include/header.php"
?>
<main>
    <section class="admin-content">
        <section id="admin-aside">
        	<?php include App::FULL_DIR."/admin/include/side-bar.php" ?>
        </section>
        <section id="admin-content-area">
        	<h1>Account settings</h1>
        	<section id="form">
                Account settings to be implemented.
            </section>
        </section><br>
    </section>
</main>
<?php include App::FULL_DIR."/include/footer.php" ?>