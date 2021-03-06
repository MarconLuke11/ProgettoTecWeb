<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$_SESSION ['paginaCorr']="";

if ((!isset($_SESSION["email"]))||($_SESSION["email"]!="admin@admin.it")){
	header("Location: pagina_errore_accesso.php");
	exit();
}

if (!isset($_SESSION["successo"]))
  $_SESSION["successo"]=0;
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Script-Type" content="text/javascript"/>
<title>Energya Fitness Club</title>
<meta name="title" content="Energya Fitness Club"/>
<meta name="description" content="Energya - un luogo per tutti quelli che amano la palestra e vogliono sentirsi come in famiglia!"/>
<meta name="keywords" content="Energya, fitness, palestra, sport"/>
<meta name="language" content="italian it"/>
<meta name="author" content="Franconetti Simone, Infantino Matteo, Marcon Luca"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<link rel="stylesheet" type="text/css" href="../CSS/css_index.css" media="handheld, screen"/>
<link rel="stylesheet" type="text/css" href="../CSS/css_index_small_768px.css" media="handheld, screen and (max-width:768px),only screen and (max-device-width:720px)"/>
<link rel="stylesheet" type="text/css" href="../CSS/css_index_small_480px.css" media="handheld, screen and (max-width:480px),only screen and (max-device-width:480px)"/>
<link rel="stylesheet" type="text/css" href="../CSS/print.css" media="print"/>

<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"/>
<script type="text/javascript" src="../JS/script.js"> </script>

</head>
<body>
  <div id="nav">
    <a href="#content" id="hideLink" xml:lang="en">Skip to content</a>
	  <div id="logo"><img src="../IMG/logo1.png" alt="Logo Energya"/></div>
    <button id="menuIcon" title="menuIcon" onclick="menuHamburger()" ><img src="../IMG/hamburger_icon.png" alt="icona menu"/></button>
	  <ul class="menuItems" id="menuu" >
	    <li><a href="index.php" xml:lang="en">Home</a></li>
	    <li><a href="corsi.php">Corsi</a></li>
      <li><a href="abbonamenti.php">Abbonamenti</a></li>
			<li><a href="news.php">News</a></li>
	    <li><a href="galleria.php">Galleria</a></li>
	    <li><a href="staff.php" xml:lang="en">Staff</a></li>
	    <li><a href="contatti.php">Contatti</a></li>
      <?php require_once __DIR__ . DIRECTORY_SEPARATOR . "../PHP" . DIRECTORY_SEPARATOR . "userbar_mobile.php";?>
	  </ul>
	</div>
	<div id="header">
		<img src="../IMG/logo1.png" alt="Logo Energya"/>
	</div>

  <?php require_once __DIR__ . DIRECTORY_SEPARATOR . "../PHP" . DIRECTORY_SEPARATOR . "userbar.php";?>


  <noscript>
    <p id="menuNoScript"><span xml:lang="en">Javascript</span> Disabilitato: Il <a href="#NoJS">men&ugrave;</a> &egrave; visualizzabile in fondo alla pagina</p>
  </noscript>


	<div id="content">
		<div id="breadcrumb">
			<p>Ti trovi in: Pannello di amministrazione &gt;&gt; Inserimento <span xml:lang="en">News</span></p>
		</div>

    <h1 class="center">Inserisci una <span xml:lang="en">news</span></h1>


		<form onsubmit="return checkInsNews()" action="../PHP/post_news.php" method="post" id="login-register-form" enctype="multipart/form-data">
			<fieldset>
				<legend>Inserisci una nuova <span xml:lang="en">News</span></legend>
				<ul>
          <li>
						<label for="titolo">Titolo</label>
						<input id="titolo" name="titolo" type="text" <?php if(isset($_SESSION['error']['titoloErr'])) if(isset ($_SESSION['var']['titolo'])) {$titolo = $_SESSION['var']['titolo']; echo "value=\"$titolo\"";} else echo "value=\"\"";?>/>
            <?php if(isset($_SESSION['error']['titoloErr'])) { echo '<span class="error">'. $_SESSION['error']['titoloErr'] .'</span>'; unset($_SESSION['error']['titoloErr']); } else {echo "";} ?>
          </li>
          <li>
            <label for="fileToUpload">Inserisci Immagine</label>
            <input id="fileToUpload" name="fileToUpload" type="file"/>
            <?php if(isset($_SESSION['error']['err'])) { echo '<span class="error">'. $_SESSION['error']['err'] .'</span>'; unset($_SESSION['error']['err']); } else {echo "";} ?>
          </li>
          <li>
						<label for="alt">Alt immagine (facoltativo)</label>
						<input id="alt" name="alt" type="text" <?php if(isset($_SESSION['error']['altErr'])) if(isset ($_SESSION['var']['alt'])) {$alt = $_SESSION['var']['alt']; echo "value=\"$alt\"";} else echo "value=\"\"";?>/>
            <?php if(isset($_SESSION['error']['altErr'])) { echo '<span class="error">'. $_SESSION['error']['altErr'] .'</span>'; unset($_SESSION['error']['altErr']); } else {echo "";} ?>
          </li>
          <li>
						<label for="testo">Inserisci il testo della <span xml:lang="en">News</span></label>
            <textarea name="testo" id="testo" cols="1" rows="30"><?php if(isset($_SESSION['error']['testoErr'])) if(isset ($_SESSION['var']['testo'])) {$testo = $_SESSION['var']['testo']; echo $testo;} ?></textarea>
            <?php if(isset($_SESSION['error']['testoErr'])) { echo '<span class="error">'. $_SESSION['error']['testoErr'] .'</span>'; unset($_SESSION['error']['testoErr']); } else {echo "";} ?>
          </li>
					<li id="buttons-login">
						<input value="Inserisci" class="button" id="inserisci" name="inserisci" type="submit"/>
						<input value="Cancella" class="button" id="delete-login-button" type="reset" />
					</li>
				</ul>
			</fieldset>
		</form>
	</div>

  <div id="footer">
    <p>Sito <abbr xml:lang="en" title="World Wide Web">Web</abbr> realizzato da: </p>
    <p>Matteo Infantino</p>
    <p>Simone Franconetti</p>
    <p>Luca Marcon</p>
    <img src="http://www.w3.org/Icons/valid-xhtml10"  alt="Valid XHTML 1.0 Strict" class="inline"/>
    <img src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="CSS Valido!" class="inline"/>
  </div>


  <noscript>
  	  <ul id="NoJS">
        <li><a href="index.php" xml:lang="en">Home</a></li>
  	    <li><a href="corsi.php">Corsi</a></li>
        <li><a href="abbonamenti.php">Abbonamenti</a></li>
  			<li><a href="news.php">News</a></li>
  	    <li><a href="galleria.php">Galleria</a></li>
  	    <li><a href="staff.php" xml:lang="en">Staff</a></li>
  	    <li><a href="contatti.php">Contatti</a></li>
        <?php include __DIR__ . DIRECTORY_SEPARATOR . "../PHP" . DIRECTORY_SEPARATOR . "userbar_mobile.php";?>
  	  </ul>
  </noscript>

</body>
</html>
