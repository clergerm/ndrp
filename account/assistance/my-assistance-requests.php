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
        	<h1>My assistance requests</h1>
            <table>
                <tr>
                    <th colspan="7">&nbsp;</th>
                </tr>
                <tr> 
                  <th>Id</th>
                  <th>Date</th>
                  <th colspan="2">Items/Description</th>
                  <th>Status</th>
                  <th>Comment</th>
                  <th colspan="2">Action</th>
                </tr> 
                <?php if ( count(AssistanceRequestController::$assReqs) > 0) {
                    foreach (AssistanceRequestController::$assReqs as $k => $v){ ?>
                      <tr>
                        <td><?php echo AssistanceRequestController::$assReqs[$k]->getId(); ?></td>
                        <td><?php echo AssistanceRequestController::$assReqs[$k]->getDate(); ?></td>
                        <td colspan="2">
                          <ul>
                            <?php $i = 0;
                              $products = AssistanceRequestController::$assReqs[$k]->getProducts();
                              foreach ($products as $val){ $i++ ?>
                               <li>
                                <p>- &nbsp; <?php echo $val->getName()." (# ".$val->getId().") "; ?></p>
                              </li>
                            <?php } ?>
                          </ul>
                        </td>
                        <td>
                          <strong>
                            <?php echo AssistanceRequestController::$statuses[AssistanceRequestController::$assReqs[$k]->getStatusId()]; ?>
                          </strong>
                        </td>
                        <td><?php echo AssistanceRequestController::$assReqs[$k]->getComment(); ?></td>
                        <td>
                          <a href="<?php echo App::FULL_URL; ?>/account/assistance/edit-assistance-request.php?assReqId=<?php echo AssistanceRequestController::$assReqs[$k]->getId(); ?>">Edit</a>
                        </td>
                        </tr>
                    <?php } ?>
                <?php }else{ ?>
                    <tr>
                      <td colspan="7">You have not added any assistance request yet.</td>
                    </tr>
                <?php } ?>
            </table>
        </section><br>
    </section>
</main>
<?php include App::FULL_DIR."/include/footer.php" ?>