<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">

    <title>Natural Disaster Relief Program (NDRP)</title>
    <link rel="stylesheet" href="<?php echo App::FULL_URL; ?>/css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <header id="main-header" class="main-content">
        <section class="logo">
            <a href="<?php echo App::FULL_URL; ?>"><img src="/ndrp/image/natures-matter.jpg" alt="Natural Disasters Relief Program" width="225" height="50"></a>
        </section>
        <nav id="nav">
            <ul class="l-menu">
                <li>
                    <a href="<?php echo App::FULL_URL; ?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo App::FULL_URL; ?>/search/products.php">Items/Products</a>
                </li>
                <li>
                    <a href="<?php echo App::FULL_URL; ?>/about.php">About</a>
                </li>
                <li>
                    <a href="<?php echo App::FULL_URL; ?>/contact.php">Contact</a>
                </li><br>
            </ul>
            <ul class="r-menu">
                <li>
                    <?php if (isset($_SESSION["user"])) {
                        $accDir = "account";
                        if ($_SESSION["user"]["type"] == "Employee") {
                            $accDir = "admin";
                        } ?>
                        <a href="<?php echo App::FULL_URL; ?>/<?php echo $accDir; ?>"><i class="fa fa-user"></i> 
                        <?php echo $_SESSION['user']['firstName'];  
                        ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo App::FULL_URL; 
                        ?>/logout.php">Log out</a> 
                    <?php } else { ?>
                        <a href="<?php echo App::FULL_URL; ?>/login.php"><i class="fa fa-user"></i> Sing in&nbsp;</a> 
                    <?php } ?>
                </li>
            </ul><br>
        </nav><br>
    </header>
