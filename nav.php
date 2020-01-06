<?php
 
if (isset($_SESSION['login']))
 {
?>

<nav class="menu">
<p class="text-nav">HappyFistFamily</p>
<a class="link-nav" href="index.php">Accueil</a>
        <a class="link-nav" href="profil.php">Profil</a>
        <a class="link-nav" href="discussion.php">Chat</a>
        <img class="img-nav" src="images/logohf2.png"/>

</nav>
<?php




}
else
 {
?>
   

   <nav class="menu">
   <p class="text-nav">HappyFistFamily</p>
        <a class="link-nav" href="index.php">Accueil</a>
        <a class="link-nav" href="inscription.php">Inscription</a>
        <a class="link-nav" href="connexion.php">Connexion</a>
   <img class="img-nav" src="images/logohf2.png"/>
    </nav>
<?php
 }
?>