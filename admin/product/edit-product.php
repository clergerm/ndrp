<?php // Video: Uses Adobe Spark
include "../../conf/app.php";
include App::FULL_DIR."/controller/product-controller.php";
include App::FULL_DIR."/admin/include/header.php"
?>
<main>
    <section class="admin-content">
        <section id="admin-aside">
        	<?php include App::FULL_DIR."/admin/include/side-bar.php" ?>
        </section>
        <section id="admin-content-area">
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

            	<h1>Add or edit an item</h1>

            	<section id="form">
                    <p>(<span class="req">*</span>) indicates required field. </p>
                    <form action="" method="post">
                        <input type="hidden" name="action" value="editProduct" />
                        <?php 
                            if (ProductController::$product === null){
                                $prodId = null;
                            } else {
                                $prodId = ProductController::$product->getId();
                            } ?>

                        <input type="hidden" name="prodId" value="<?php echo $prodId; ?>" />
                        <?php 
                            if (ProductController::$product === null){
                                $catId = null;
                            } else {
                                $catId = ProductController::$product->getCatId();
                            } ?>

                        <label>Item category: <span class="req">*</span></label>
                        <select  name="catId" id="catId">
                            <option value="" <?php if ($catId == 0) echo "selected"; ?>>Choose</option>
                            <?php if (count(ProductController::$categories) > 0) { 
                                foreach (ProductController::$categories as $k => $v) {
                                    $sel = ""; 
                                    if ($catId == $k) 
                                        $sel = "selected"; ?>
                                    <option value="<?php echo $k; ?>" <?php echo $sel; ?>><?php echo $v; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select><br>

                        <?php 
                            if (ProductController::$product === null){
                                $typeId = null;
                            } else {
                                $typeId = ProductController::$product->getTypeId();
                            } ?>

                        <label>Item type: <span class="req">*</span></label>
                        <div id="prod-type">
                            <?php if (count(ProductController::$types) > 0) { 
                                foreach (ProductController::$types as $k => $v) {
                                    $chck = "";
                                    if ($typeId == $k) 
                                        $chck = "checked"; ?>
                                    <input type="radio" name="typeId" 
                                    value="<?php echo $k; ?>" <?php echo $chck; ?>><?php echo $v; ?> &nbsp;&nbsp;
                                <?php } ?>
                            <?php } ?><br>

                        </div><br>

                        <?php 
                            if (ProductController::$product === null){
                                $statusId = null;
                            } else {
                                $statusId = ProductController::$product->getStatusId();
                            } ?>

                        <label>Item status: <span class="req">*</span></label>
                        <div id="prod-status">
                            <?php if (count(ProductController::$statuses) > 0) { 
                                foreach (ProductController::$statuses as $k => $v) {
                                $chck = "";
                                if ($statusId == $k) 
                                    $chck = "checked"; ?>
                                    <input type="radio" name="statusId" 
                                    value="<?php echo $k; ?>" <?php echo $chck; ?>><?php echo $v; ?> &nbsp;&nbsp;
                                <?php } ?>
                            <?php } ?><br>
                        </div><br>

                        <?php 
                            if (ProductController::$product === null){
                                $prodName = "";
                            } else {
                                $prodName = ProductController::$product->getName();
                            } ?>

                        <label>Item Name: <span class="req">*</span></label>
                        <input type="text" name="prodName" value="<?php echo $prodName; ?>" /><br>

                        <?php 
                            if (ProductController::$product === null){
                                $prodDesc = "";
                            } else {
                                $prodDesc = ProductController::$product->getDesc();
                            } ?>

                        <label>Item description: <span class="req">*</span></label>
                        <textarea id="prodDesc" name="prodDesc" rows="4" cols="50">
                            <?php echo $prodDesc; ?>
                        </textarea><br>

                        <?php 
                            if (ProductController::$product === null){
                                $prodPrice = 0.00;
                            } else {
                                $prodPrice = ProductController::$product->getPrice();
                            } ?>

                        <label>Item price:</label>
                        <input type="text" name="prodPrice" value="<?php echo $prodPrice; ?>" readonly /><br>

                        <label>&nbsp;</label>
                        <input type="submit" value="Add/edit Item"/><br>
                    </form>
                </section>
            <?php } ?>
        </section><br>
    </section>
</main>
<?php include App::FULL_DIR."/include/footer.php" ?>