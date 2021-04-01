<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">

    <title>Natural Disaster Relief Program (NDRP)</title>
    <link rel="stylesheet" href="<?php echo App::FULL_URL; ?>/css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <header id="admin-header" class="admin-content">
        <section class="logo">
            <a href="<?php echo App::FULL_URL; ?>"><img src="/ndrp/image/natures-matter.jpg" alt="Natural Disasters Relief Program" width="225" height="50"></a>
        </section>
        <nav id="nav">
            <ul>
                <li>
                    <a href="<?php echo App::FULL_URL; ?>">Assistance site</a> 
                </li>
                <li class="signed-in">
                    <a href="<?php echo App::FULL_URL; ?>/admin"><i class="fa fa-user"></i> <?php echo $_SESSION['user']['firstName'];  ?></a> 
                </li>
                <li>
                    <a href="<?php echo App::FULL_URL; ?>/logout.php">Log out</a> 
                </li><br>
            </ul>
        </nav><br>
    </header>
    <section id="admin-header-ext">
        <div class="admin-content">
            <h2>Account admin control panel</h2>
            <p><em>Signed as administrator</em></p>
        </div>
    </section>