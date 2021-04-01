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
        	<h1>List of items and products</h1>
            <table>
                <tr>
                    <th colspan="11">
                        <a class="add-item-th-a" href="<?php echo App::FULL_URL; ?>/admin/product/add-product.php">Add a new item</a>
                    </th>
                </tr>
                <tr> 
                  <th>Id</th>
                  <th>Date</th>
                  <th>Owner</th>
                  <th>Image</th>
                  <th colspan="2">Name/Description</th>
                  <th>Category</th>
                  <th>Type</th>
                  <th>Status</th>
                  <th>Price</th>
                  <th colspan="2">Action</th>
                </tr> 
                <?php if (!(ProductController::$product === null)){
                    foreach (ProductController::$product as $k => $v){ ?>
                      <tr>
                        <td><?php echo ProductController::$product[$k]->getId(); ?></td>
                        <td><?php echo ProductController::$product[$k]->getDate(); ?></td>
                        <td><?php echo ProductController::$product[$k]->getEmpId(); ?></td>
                        <td><img src="" width="100" height="100" alt="None"></td>
                        <td colspan="2">
                            <p><strong><?php echo ProductController::$product[$k]->getName(); ?></strong></p>
                            <p><?php echo ProductController::$product[$k]->getDesc(); ?></p>
                        </td>
                        <td><?php echo ProductController::$categories[ProductController::$product[$k]->getCatId()]; ?></td>
                        <td><?php echo ProductController::$types[ProductController::$product[$k]->getTypeId()]; ?></td>
                        <td><?php echo ProductController::$statuses[ProductController::$product[$k]->getStatusId()]; ?></td>
                        <td><strong><?php echo ProductController::$product[$k]->getPrice(); ?></strong></td>
                        <td>
                          <a href="<?php echo App::FULL_URL; ?>/admin/product/edit-product.php?prodId=<?php echo ProductController::$product[$k]->getId(); ?>">Edit</a> | 
                          <a href="#">Delete</a>
                        </td>
                        </tr>
                    <?php } ?>
                <?php }else{ ?>
                    <tr>
                      <td colspan="11">You have not added any items yet.</td>
                    </tr>
                <?php } ?>
            </table>
        </section><br>
    </section>
</main>
<?php include App::FULL_DIR."/include/footer.php" ?>