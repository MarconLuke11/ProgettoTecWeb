<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if ((!isset($_SESSION["email"]))||($_SESSION["email"]!="admin@admin.it")){
	header("Location: index.php");
	exit();
}
//
// if (!isset($_SESSION["successo"]))
//   $_SESSION["successo"]=0;

require_once __DIR__ . DIRECTORY_SEPARATOR . "connection.php";
use DB\DBConnection;

$connection = new DBConnection();
$dbOpen=$connection->openConnection();



if ($dbOpen){
  $corso = $connection->getCorso($_GET['modifica']);
  $id=$corso['Id'];
  $titolo=$corso['Titolo'];
  $immagine=$corso['Immagine'];
  $testo=$corso['Descrizione'];
  $testoLong=$corso['DescrizioneL'];
  $alt=$corso['Alt'];
}
else {
		echo "Connessione non stabilita correttamente";     //if (dbOpen)
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it"><!-- il comando html permette di importare un namespace, contenente tutto l'insieme dei tag utilizzabili -->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <!--metatag che permette di dire che cosa ci sara' all'interno della pagina. Consiglio e' sempre quello di utilizzare la codifica utf-8 perche' e' univoco per la codifica degli accenti-->
<title>Energya Fitness Club</title>
<meta name="title" content="Energya Fitness Club"/>
<meta name="description" content=""/>
<meta name="keywords" content="Energya, fitness, palestra, sport"/>
<meta name="language" content="italian it"/>
<meta name="author" content="Franconetti Simone"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link rel="stylesheet" type="text/css" href="CSS/css_index.css" media="handheld, screen"/>
<link rel="stylesheet" type="text/css" href="CSS/css_index_small_1200px.css" media="handheld, screen and (max-width:1200px),only screen and (max-device-width:1200px)"/>
<link rel="stylesheet" type="text/css" href="CSS/css_index_small_768px.css" media="handheld, screen and (max-width:768px),only screen and (max-device-width:720px)"/>
<link rel="stylesheet" type="text/css" href="CSS/css_index_small_480px.css" media="handheld, screen and (max-width:480px),only screen and (max-device-width:480px)"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.8.2/css/all.css'>


<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"/>
<script type="text/javascript" src="JS/script.js"> </script>


</head>
<body>
	<div id="nav">
	  <div id="logo"><img src="IMG/logo2.png" alt="Logo Energya"/></div>
    <button id="menuIcon" onclick="menuHamburger()"><i class='fas fa-bars'></i></button>
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

  <?php require_once __DIR__ . DIRECTORY_SEPARATOR . "userbar.php";
   ?>

	<div id="content">
		<div id="breadcrumb">
			<p>Ti trovi in: Pannello di amministrazione >> Form modifica corsi</p>
		</div>

   <form onsubmit="return checkModCorsi()" action="post_modifica_corsi.php?id=<?php $id ?>" id="login-register-form" enctype="multipart/form-data">
     <fieldset>
       <legend>Modifica il corso</legend>
       <ul>
         <li>
           <label for="titolo">Titolo</label>
           <input id="titolo" name="titolo" type="text" <?php echo "value=\"$titolo\"";?> />
           <?php if(isset($_SESSION['error']['titoloErr'])) { echo '<span class="error">'. $_SESSION['error']['titoloErr'] .'</span>'; unset($_SESSION['error']['titoloErr']); } else {echo "";} ?>
         </li>
         <li>
           <label for="testo">Inserisci la descrizione corta</label>
           <input id="testo" name="testo" type="text" <?php echo "value=\"$testo\"";?> />
           <?php if(isset($_SESSION['error']['testoErr'])) { echo '<span class="error">'. $_SESSION['error']['testoErr'] .'</span>'; unset($_SESSION['error']['testoErr']); } else {echo "";} ?>
         </li>
         <li>
           <label for="testoLong">Inserisci la descrizione lunga</label>
           <input id="testoLong" name="testoLong" type="text" <?php echo "value=\"$testoLong\"";?> />
           <?php if(isset($_SESSION['error']['testoLongErr'])) { echo '<span class="error">'. $_SESSION['error']['testoLongErr'] .'</span>'; unset($_SESSION['error']['testoLongErr']); } else {echo "";} ?>
         </li>
         <li>
           <label for="alt">Inserisci l'alt dell'immagine</label>
           <input id="alt" name="alt" type="text" <?php echo "value=\"$alt\"";?> />
           <?php if(isset($_SESSION['error']['altErr'])) { echo '<span class="error">'. $_SESSION['error']['altErr'] .'</span>'; unset($_SESSION['error']['altErr']); } else {echo "";} ?>
         </li>
       </ul>
     </fieldset>
         <li id="buttons-login">
           <?php echo '<input type="hidden" value="'.$corso['Id'].'" name="update" />' ?>
           <input value="Modifica" class="button" id="modifica" name="modifica" type="submit"/>
           <input value="Cancella" class="button" id="delete-login-button" type="reset" />
         </li>
       </ul>
     </fieldset>
   </form>
 </div>

	<div id="footer">
		<p>Sito <span xml:lang="en" xml:abbr title="World Wide Web">Web</abbr>  realizzato da: </p>
		<p>Luca</p>
		<p>Matteo</p>
		<p>Franconetti Simone</p>
	</div>

</body>
</html>
