<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . "connection.php";
use DB\DBConnection;

$connection = new DBConnection();
$dbOpen=$connection->openConnection();

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$_SESSION ['paginaCorr']="";

if (!isset($_SESSION["successoM"]))
  $_SESSION["successoM"]=0;

if (!isset($_SESSION["successoR"]))
    $_SESSION["successoR"]=0;

if ((!isset($_SESSION["email"]))||($_SESSION["email"]!="admin@admin.it")){
	header("Location: index.php");
	exit();
}
	if ($dbOpen){
      $listaCorsi=$connection->getCorsi(0,$connection->numCorsi());

		}
	else {
			$_SESSION["error"] = "Connessione non stabilita correttamente";
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Energya Fitness Club</title>
<meta name="title" content="Energya Fitness Club"/>
<meta name="description" content="Energya - un luogo per tutti quelli che amano la palestra e vogliono sentirsi come in famiglia!"/>
<meta name="keywords" content="Energya, fitness, palestra, sport"/>
<meta name="language" content="italian it"/>
<meta name="author" content="Franconetti Simone, Infantino Matteo, Marcon Luca"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<link rel="stylesheet" type="text/css" href="CSS/css_index.css" media="handheld, screen"/>
<link rel="stylesheet" type="text/css" href="CSS/css_index_small_768px.css" media="handheld, screen and (max-width:768px),only screen and (max-device-width:768px)"/>
<link rel="stylesheet" type="text/css" href="CSS/css_index_small_480px.css" media="handheld, screen and (max-width:480px),only screen and (max-device-width:480px)"/>
<link rel="stylesheet" type="text/css" href="CSS/print.css" media="print"/>

<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"/>
<script type="text/javascript" src="JS/script.js"> </script>

</head>
<body>
  <div id="nav">
	  <div id="logo"><img src="IMG/logo1.png" alt="Logo Energya"/></div>
    <button id="menuIcon" onclick="menuHamburger()" ><img src="IMG/hamburger_icon.png" alt="icona menu"/></button>
	  <ul class="menuItems" id="menuu" >
	    <li><a href="index.php" xml:lang="en">Home</a></li>
	    <li><a href="corsi.php">Corsi</a></li>
      <li><a href="abbonamenti.php">Abbonamenti</a></li>
			<li><a href="news.php">News</a></li>
	    <li><a href="galleria.php">Galleria</a></li>
	    <li><a href="staff.php" xml:lang="en">Staff</a></li>
	    <li><a href="contatti.php">Contatti</a></li>
			<?php require_once __DIR__ . DIRECTORY_SEPARATOR . "userbar_mobile.php";?>
	  </ul>
	</div>
	<div id="header">
		<img src="IMG/logo1.png" alt=""/>
	</div>

	<?php require_once __DIR__ . DIRECTORY_SEPARATOR . "userbar.php";?>

	<div id="content">
		<div id="breadcrumb">
			<p>Ti trovi in: Pannello di amministrazione >> Rimozione corsi</p>
		</div>

		<div class="Card Sx">
      <h1>Elimina Corsi</h1>
      <p class="center">Per eliminare uno dei corsi inseriti all'interno della sezione "Corsi",
         premere il pulsante elimina al fianco del titolo corrispondente.</p>
     <h2 class="successo">
        <?php
         if ($_SESSION ['successoR']){
           echo "Rimozione avvenuta con successo";
           $_SESSION ['successoR']=0;
         }
         else{
           echo "";
         }
        ?>
      </h2>
      <?php
          if(!empty($listaCorsi))
            foreach ($listaCorsi as $corsi) {
              echo'
                <form class="rem" action="post_remove_corsi.php?id='.$corsi['Id'].'">
                <fieldset>
                  <label class="remP">'.$corsi['Titolo'].'</label><input type="hidden" value="'.$corsi['Id'].'" name="rimuovi"></input>
                  <input type="submit" class="button" value="Rimuovi  '.$corsi['Titolo'].'" name="submit"></input>
                </fieldset>
                </form>';
          }?>
    </div>
    <div class="Card Dx">
      <h1>Modifica Corsi</h1>
      <p class="center">Per modificare uno dei corsi inseriti all'interno della sezione "Corsi",
         premere il pulsante elimina al fianco del titolo corrispondente.</p>
     <h2 class="successo">
        <?php
         if ($_SESSION ['successoM']){
           echo "Modifica avvenuta con successo";
           $_SESSION ['successoM']=0;
         }
         else{
           echo "";
         }
        ?>
      </h2>
      <?php
      if(!empty($listaCorsi))
        foreach ($listaCorsi as $corsi) {
          echo'
            <form class="rem" action="modifica_corsi_form.php?id='.$corsi['Id'].'">
            <fieldset>
              <label class="remP">'.$corsi['Titolo'].'</label><input type="hidden" value="'.$corsi['Id'].'" name="modifica"></input>
              <input type="submit" class="button" value="Modifica '.$corsi['Titolo'].'" name="submit"></input>
            </fieldset>
            </form>';
          }
        ?>
    </div>
	</div>

  <?php require_once __DIR__ . DIRECTORY_SEPARATOR . "footer.html"; ?>
  <?php $connection->closeConnection();?>

</body>
</html>
