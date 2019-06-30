<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$_SESSION ['paginaCorr']="";

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
  $ora=$corso['Ora'];
  $giorno=$corso['Giorno'];
}
else {
		echo "Connessione non stabilita correttamente";     //if (dbOpen)
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
<link rel="stylesheet" type="text/css" href="CSS/css_index_small_768px.css" media="handheld, screen and (max-width:768px),only screen and (max-device-width:720px)"/>
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
         <li>
           <label for="giorno">Giorno</label>
           <select id="giorno" name="giorno">
             <option value="lunedi"<?php if ($giorno=="lunedi") echo "selected=\"selected\";" ?>>Luned&iacute;</option>
             <option value="martedi"<?php if ($giorno=="martedi") echo "selected=\"selected\";" ?>>Martedi&iacute;</option>
             <option value="mercoledi"<?php if ($giorno=="mercoledi") echo "selected=\"selected\";" ?>>Mercoled&iacute;</option>
             <option value="giovedi"<?php if ($giorno=="giovedi") echo "selected=\"selected\";" ?>>Gioved&iacute;</option>
             <option value="venerdi"<?php if ($giorno=="venerdi") echo "selected=\"selected\";" ?>>Venerd&iacute;</option>
             <option value="sabato"<?php if ($giorno=="sabato") echo "selected=\"selected\";" ?>>Sabato</option>
             <option value="domenica"<?php if ($giorno=="domenica") echo "selected=\"selected\";" ?>>Domenica</option>
           </select>
         </li>
         <li>
           <label for="ora">Orario (HH:mm)</label>
           <input id="ora" name="ora" type="text" <?php echo "value=\"".date("H:i", strtotime($ora))."\"";?> />
           <?php if(isset($_SESSION['error']['oraErr'])) { echo '<span class="error">'. $_SESSION['error']['oraErr'] .'</span>'; unset($_SESSION['error']['oraErr']); } else {echo "";} ?>
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

 <?php require_once __DIR__ . DIRECTORY_SEPARATOR . "footer.html"; ?>


</body>
</html>
