<aside>
    <ul>
        <li>
            <a class="<?php if (App::$aside == "" || App::$aside == "Dash"){ ?>sel<?php } ?>" 
                href="<?php echo App::FULL_URL; ?>/admin">Dashboard</a> 
        </li>
        <li>
            <a class="<?php if (App::$aside == "Settings"){ ?>sel<?php } ?>" 
                href="<?php echo App::FULL_URL; ?>/admin/account-settings.php">Account settings</a> 
        </li>
        <li>
            <a class="<?php if (App::$aside == "Users"){ ?>sel<?php } ?>" 
                href="<?php echo App::FULL_URL; ?>/admin/users.php">My users</a> 
        </li>
         <li>
            <a class="<?php if (App::$aside == "Invite"){ ?>sel<?php } ?>" 
                href="<?php echo App::FULL_URL; ?>/admin/invite-user.php">Invite a user</a> 
        </li>
        <li>
            <a class="<?php if (App::$aside == "View"){ ?>sel<?php } ?>" 
                href="<?php echo App::FULL_URL; ?>/admin/product/my-products.php">My items/products</a> 
        </li>
        <li>
            <a class="<?php if (App::$aside == "Add"){ ?>sel<?php } ?>" 
                href="<?php echo App::FULL_URL; ?>/admin/product/add-product.php">Add/edit an item</a> 
        </li>
        <li>
            <a class="<?php if (App::$aside == "Ass"){ ?>sel<?php } ?>" 
                href="<?php echo App::FULL_URL; ?>/admin/assistance/assistance-requests.php">Assistance requests</a> 
        </li>
    </ul>
</aside>
