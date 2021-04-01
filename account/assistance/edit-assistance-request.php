<?php // Video: Uses Adobe Spark
include "../../conf/app.php";
include App::FULL_DIR."/controller/assistance-request-controller.php";
include App::FULL_DIR."/account/include/header.php"
?>
<main>
    <section class="acc-content">
        <section id="acc-aside">
        	<?php include App::FULL_DIR."/account/include/side-bar.php" ?>
        </section>
        <section id="acc-content-area">
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

            	<h1>Edit assistance request</h1>

            	<section id="form">
                    <p>(<span class="req">*</span>) indicates required field. </p>
                    <form action="" method="post">
                        <input type="hidden" name="action" value="addAssReq" />

                        <label>Products to choose from: <span class="req">*</span></label>

                        <?php // form array having posted products as keys. 
                            if (AssistanceRequestController::$assReq === null){
                                $selKeys = [];
                            } else {
                                $p = AssistanceRequestController::$assReq->getProducts();
                                foreach ($p as $k => $v){
                                    $selKeys [$v->getId()] = 1;
                                }                                
                            }  ?> 

                        <div id="prod-list">
                            <?php if (count(AssistanceRequestController::$products) > 0) { 
                                foreach (AssistanceRequestController::$products as $k => $v) { 
                                    $chk = ""; 
                                    if (isset($selKeys[$k]))
                                        $chk = "checked"; ?>
                                    <div class="checkbox-container">
                                        <input class="checky" type="checkbox" name="assReqProd[<?php echo $k; ?>]" 
                                        value="1" <?php echo $chk; ?>>
                                    </div>
                                    <div class="label-container">
                                        <label class="labely"> <?php echo $v->getName(); ?></label>
                                        <p><em><?php echo $v->getDesc(); ?></em></p>
                                    </div><br>
                                <?php } ?>
                            <?php } ?><br>

                        </div><br>

                        <?php 
                            if (AssistanceRequestController::$assReq === null){
                                $assReqComment = "";
                            } else {
                                $assReqComment = AssistanceRequestController::$assReq->getComment();
                            } ?>

                        <label>Comments:</label>
                        <textarea id="assReqComment" name="assReqComment" rows="4" cols="50">
                            <?php echo $assReqComment; ?>
                        </textarea><br>

                        <label>&nbsp;</label>
                        <input type="submit" value="Edit Request"/><br>
                    </form>
                </section>
            <?php } ?>
        </section><br>
    </section>
</main>
<?php include App::FULL_DIR."/include/footer.php" ?>