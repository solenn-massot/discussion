<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
<?php require ("nav.php"); ?>
</header>
    <main>
<?php
    if(!empty($_SESSION['login']))
    {
    ?>
    <div class="div-index">
        <span class="text-index">Salut <?php echo $_SESSION['login']?> ! <br/>
        Bienvenue à la maison ! <br />
        Tu peux modifier ton profil <a class="link-index" href="profil.php">ici</a><br />
        Tu peux discuter avec la famille <a class="link-index" href="discussion.php">ici</a><br />
        HxC RULE !
    </span>
    </div>
    <form action="index.php" method="post">
<input class="button1" type="submit" name="deconnexion" value="deconnexion" />
    </form>
    <?php

    if(isset($_POST['deconnexion']))
    {
        session_unset();
        session_destroy();
        header("location:index.php");

    }

    ?>
    <?php
    }
    else
    {
    ?>
    <div class="div-index">
        <span class="text-index">
            Tu ne fais pas encore partie de la famille ! <br />
            Rejoins nous <a class="link-index" href="inscription.php">ici</a> et viens faire trembler les salles de concert avec nous !<br />
        </span>
    </div>
    <?php
    }

?>
 </main>
<footer>
<?php require ("footer.php"); ?>
    </footer>
</body>
</html>