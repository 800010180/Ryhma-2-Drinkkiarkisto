<!DOCTYPE html>
<html>
<head>
<title>LOGIN</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
require('tietokanta.php');
session_start();
if (!empty($_POST['kayttajatunnus']) || !empty($_POST['salasana'])){
    $username = stripslashes($_REQUEST['kayttajatunnus']);
    $username = mysqli_real_escape_string($con,$username);
    $password = stripslashes($_REQUEST['salasana']);
    

    $query = "SELECT `salasana` FROM `kayttaja` WHERE kayttajatunnus ='$username'";
    $result = mysqli_query($con,$query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    foreach($result as $row)
    {
    $hashed_password = $row['salasana'];
    }
    if($rows==1){
    $auth = password_verify($password, $hashed_password);

        if ($auth) {
            $_SESSION['kayttajatunnus'] = $username;
            header("Location: esim.php");
            //Laittakaa headerin ^^ locationiin teidän tekemä sivu. Ohjaa automaattisesti sinne kirjautumisen jälkeen.
            }else{
            
            echo "<div class='form'>
            <h3>Username/password is incorrect.</h3>
            <br/>Click here to <a href='kirjautuminen.php'>Login</a></div>";
            }
            
        }
    }else{

?>
<div class="form">
    <h1>Kirjautuminen</h1>
    <form action="" method="post" name="login">
    <input type="text" name="kayttajatunnus" placeholder="Käyttäjätunnus" required />
    <input type="password" name="salasana" placeholder="Salasana" required />
    <input type="submit" type="submit" value="Login" />
    </form>
    <p>Etkö ole vielä rekisteröitynyt? <a href='rekisteroidy.php'>Rekisteröidy tästä!</a></p>
</div>
<?php } ?>
</body>
</html>