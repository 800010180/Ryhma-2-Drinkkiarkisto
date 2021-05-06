<!DOCTYPE html>
<html>
<head>
<title> Registration</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
require('tietokanta.php');
if(!empty($_POST['sahkoposti']) || !empty($_POST['kayttajatunnus']) || !empty($_POST['salasana'])){
    $email = stripslashes($_REQUEST['sahkoposti']);
    $email = mysqli_real_escape_string($con, $email);
    $username = stripslashes($_REQUEST['kayttajatunnus']);
    $username = mysqli_real_escape_string($con, $username);
    $password = stripslashes($_REQUEST['salasana']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    //Muuttaa salasanan turvallisempaan muotoon
    $hashed_password = mysqli_real_escape_string($con, $hashed_password);
    $trn_date = date("Y-m-d H:i:s");
    //Ajankohta jolloin käyttäjätili luodaan

    $checkemail = mysqli_query($con, "SELECT `sahkoposti` FROM `kayttaja` WHERE `sahkoposti` = '".$_REQUEST['sahkoposti']."'") or exit(mysqli_error($con));
    //Tarkistaa onko sähköposti varattu
    $checkusername = mysqli_query($con, "SELECT `kayttajatunnus` FROM `kayttaja` WHERE `kayttajatunnus` = '".$_REQUEST['kayttajatunnus']."'") or exit(mysqli_error($con));
    //Tarkistaa onko käyttäjänimi/tunnus varattu
        if(mysqli_num_rows($checkemail)) {
            echo "<div class='form'>
            <h3>Rekisteräityminen epäonnistui.</h3>
            <br/>Klikkaa tästä <a href='rekisteroidy.php'>rekisteröityäksesi</a>
            <br>
            <br>
            This email is already being used
            </div>"; 
        }elseif(mysqli_num_rows($checkusername)) {
            echo "<div class='form'>
            <h3>Rekisteräityminen epäonnistui.</h3>
            <br/>Klikkaa tästä <a href='rekisteroidy.php'>rekisteröityäksesi</a>
            <br>
            <br>
            This username is already being used
            </div>"; 
        }else{
            $query = "INSERT into `kayttaja` (sahkoposti, kayttajatunnus, salasana, trn_date)
    VALUES ('$email', '$username', '$hashed_password', '$trn_date')";
            //Syöttää tiedon tietokantaan
            $result = mysqli_query($con, $query);
            if($result){
                echo "<div class='form'>
                <h3>Rekisteröityminen onnistui.</h3>
                <br/>Klikkaa tästä <a href='kirjautuminen.php'>Login</a></div>";
            }
        }
}else{
    ?>
    <div class="form">
    <h1> Rekisteröityminen </h1>
    <form name= "registration" action="" method="post">
    <input type="email" name="sahkoposti" placeholder="Sähköposti" required />
    <input type="text"  name="kayttajatunnus" placeholder="Käyttäjatunnus" required />
    <input type="password" name="salasana" placeholder="Salasana" required />
    <input type="submit" name="submit"  value="Register" />
    </form>
    </div>
    <?php } ?>
</body>
</html>

