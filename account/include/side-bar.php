<aside>
    <ul>
        <li>
            <a class="<?php if (App::$aside == "" || App::$aside == "Dash"){ ?>sel<?php } ?>" 
                href="<?php echo App::FULL_URL; ?>/account">Dashboard</a> 
        </li>
        <li>
            <a class="<?php if (App::$aside == "Settings"){ ?>sel<?php } ?>" 
                href="<?php echo App::FULL_URL; ?>/account/account-settings.php">Account settings</a> 
        </li>
        <li>
            <a class="<?php if (App::$aside == "View"){ ?>sel<?php } ?>" 
                href="<?php echo App::FULL_URL; ?>/account/assistance/my-assistance-requests.php">My assistance requests</a> 
        </li>
        <li>
            <a class="<?php if (App::$aside == "Add"){ ?>sel<?php } ?>" 
                href="<?php echo App::FULL_URL; ?>/account/assistance/add-assistance-request.php">Make an assistance request</a>
        </li>
    </ul>
</aside>
