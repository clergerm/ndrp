<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">

    <title>Natural Disaster Relief Program (NDRP)</title>
    <link rel="stylesheet" href="<?php echo App::FULL_URL; ?>/css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <header id="acc-header" class="acc-content">
        <section class="logo">
            <a href="<?php echo App::FULL_URL; ?>"><img src="/ndrp/image/natures-matter.jpg" alt="Natural Disasters Relief Program" width="225" height="50"></a>
        </section>
        <nav id="nav">
            <ul>
                <li>
                    <a href="<?php echo App::FULL_URL; ?>">Assistance site</a> 
                </li>
                <li class="signed-in">
                    <a href="<?php echo App::FULL_URL; ?>/account"><i class="fa fa-user"></i> 
                    <?php echo $_SESSION['user']['firstName'];  ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php 
                    echo App::FULL_URL; ?>/logout.php">Log out</a>
                </li><br>
            </ul>
        </nav><br>
    </header>
    <section id="acc-header-ext">
        <div class="acc-content">
            <h2>Client account</h2>
            <p>Welcome back, <?php echo $_SESSION['user']['firstName']; ?> [<?php echo $_SESSION['user']['email'];  ?>]</p>
        </div>
    </section>