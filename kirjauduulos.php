<?php
session_start();
if(session_destroy())
header("Location: kirjautuminen.php");
exit;
?>
