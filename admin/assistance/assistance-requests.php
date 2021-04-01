<?php // Video: Uses Adobe Spark
include "../../conf/app.php";
include App::FULL_DIR."/controller/assistance-request-controller.php";
include App::FULL_DIR."/admin/include/header.php"
?>
<main>
    <section class="admin-content">
        <section id="admin-aside">
        	<?php include App::FULL_DIR."/admin/include/side-bar.php" ?>
        </section>
        <section id="admin-content-area">
        	<h1>Assistance requests</h1>
            <table>
                <tr>
                    <th colspan="9">&nbsp;</th>
                </tr>
                <tr> 
                  <th>Id</th>
                  <th>Date</th>
                  <th colspan="2">Items/Description</th>
                  <th>Status</th>
                  <th>Comment</th>
                  <th>Client</th>
                  <th>Employee/Agent</th>
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
                        <td><?php echo AssistanceRequestController::$assReqs[$k]->getClient()->getId(); ?></td>
                        <td>
                          <?php 
                              if (AssistanceRequestController::$assReqs[$k]->getEmployee()->getId() === null ){ ?>
                                  <a class="pick-req" href="#">Pick Request</a>
                              <?php } else {
                                  echo AssistanceRequestController::$assReqs[$k]->getEmployee()->getId();
                              }
                           ?> 
                        </td>
                        <td>
                          <a href="">Edit</a>
                        </td>
                        </tr>
                    <?php } ?>
                <?php }else{ ?>
                    <tr>
                      <td colspan="9">There are no assistance request yet.</td>
                    </tr>
                <?php } ?>
            </table>
        </section><br>
    </section>
</main>
<?php include App::FULL_DIR."/include/footer.php" ?>