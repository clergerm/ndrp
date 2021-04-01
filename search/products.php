<?php 
include "../conf/app.php";
include App::FULL_DIR."/controller/product-controller.php";
include App::FULL_DIR."/include/header.php"
?>
<main>
    <section class="acc-content">
        <section id="search-wrapper">
            <section id="search">
                <h1>Search for availabe items</h1>
                <form action="" method="get">
                    <?php $typeId = null;
                        if (isset($_GET["typeId"]) && $_GET["typeId"] > 0){
                            $typeId = $_GET["typeId"];
                        } ?>

                    <label><strong>Choose a type: </strong></label>
                    <input type="radio" name="typeId" value="" <?php if ($typeId === null) echo "checked"; ?> /> All &nbsp;&nbsp; 
                    <?php if (count(ProductController::$types) > 0) { 
                        foreach (ProductController::$types as $k => $v) {
                            $chck = "";
                            if ($typeId == $k) 
                                $chck = "checked"; ?>
                            <input type="radio" name="typeId" 
                            value="<?php echo $k; ?>" <?php echo $chck; ?>><?php echo $v; ?> &nbsp;&nbsp;
                        <?php } ?>
                    <?php } ?>
                    &nbsp;<input type="submit" value="Search" /><br>
                </form>
            </section>
        </section>
        <?php if (count(ProductController::$products) > 0) { 
            foreach (ProductController::$products as $k => $v) { ?>
                    <section class="search-item">
                        <section class="search-item-img">
                           <img src="" width="100" height="100" alt="">
                        </section>
                        <section class="search-item-detail">
                            <h2><?php echo $v->getName(); ?></h2>
                            <p><strong>Category: </strong><?php echo ProductController::$categories[$v->getCatId()]; ?> | <strong>Type: </strong><?php echo ProductController::$types[$v->getTypeId()]; ?></p>
                            <p><?php echo $v->getDesc(); ?></p>
                            <a class="order-link-button" href="<?php echo App::FULL_URL; ?>/login.php">Request this item</a>
                        </section><br>
                    </section>
            <?php } ?>
        <?php } else { ?>
            <section class="search-item">
                <p>No items have been found for you search criterias.</p>
            </section>
        <?php } ?>
    </section>
</main>
<?php include App::FULL_DIR."/include/footer.php" ?>