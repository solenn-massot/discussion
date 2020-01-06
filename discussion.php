<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Chat</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
<?php require ("nav.php"); ?>
</header>
    <main>
    <?php
        if (empty($_SESSION['login'])) {
            header("location:connexion.php");
        } else {
    

        $connexion = mysqli_connect("localhost", "root", "", "discussion");
        $requete = "SELECT utilisateurs.login, messages.message, date_format(messages.date,\"%e %M %Y\") FROM utilisateurs, messages WHERE messages.id_utilisateur = utilisateurs.id ORDER BY date ASC";
        $query = mysqli_query($connexion, $requete);
        $resultat = mysqli_fetch_all($query);
        foreach ($resultat as list($a, $b, $c)) {

            ?>
            <div class="book">
                <h1 id="book-h1"> Le <?php echo $c ?></h1> <?php echo $a ?> dit : <br />
                <span id="text-book"><?php echo $b ?> <br />
                </span>
            </div>

        <?php
        }
        ?>
        <div class="form-style-connexion">
            <form action="discussion.php" method="post">

            Exprime toi :<textarea value="msg" name="msg" placeholder="Juste ici"rows="6"></textarea>

                <input type="submit" name="send" value="send" />
            </form>
        </div>
        <?php

            if (isset($_POST['send'])) 
            {
                $login = $_SESSION['login'];
                $msg = $_POST['msg'];
                $requetelog = "SELECT id FROM utilisateurs WHERE login = '$login'";
                $querylog = mysqli_query($connexion, $requetelog);
                $resultatlog = mysqli_fetch_assoc($querylog);
                $logid = $resultatlog["id"];
                $requete = "INSERT INTO messages (message,id_utilisateur,date) VALUE (\"$msg\",$logid,NOW())";
                $query = mysqli_query($connexion, $requete);
                header("location:discussion.php");
            }
        }
    
        ?>
        </main>
        <footer>
<?php require ("footer.php"); ?>
    </footer>
    </body>
        </html>