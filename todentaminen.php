
<?php
session_start();
if(!isset($_SESSION["kayttajatunnus"])){
header("Location: kirjautuminen.php");
exit(); }
//Todentaminen todentaa "sessionin". Tämän avulla saa siis tietokannasta haettua käyttäjän tietoa $_SESSION["kayttajatunnus"] avulla
?>