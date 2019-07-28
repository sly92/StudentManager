<?php
include ('entete.html');
include ('menu.php');
// require ('includes/db_connect.php');
// include ('class/controllerClass.php');
// include ('class/viewClass.php');
?>

<?php
/*
$controller= new controllerClass();

$param = array('fichier');

if(isset($_GET['submit']) && $controller->testParam($param,$_GET))
$fichierCSV = $_GET['fichier'];
 
$csv = importCSV($fichierCSV);

/*
echo '<pre>';
print_r($fichierCSV);
echo '</pre>';
*/



?>
<h2> Importer des données  </h2></br></br>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
     <label for="fichier">Fichier (CSV | max. 10 Mo) :</label><br /><br>
     <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
     <input style="margin: 0 auto;
    float: none;" type="file" name="fichier" id="fichier" /><br /><br>
     <label for="description">Description de votre fichier (max. 255 caractères) :</label><br />
     <textarea name="description" id="description"></textarea><br /><br><br><br>
     <input type="submit" name="submit" value="Envoyer" />
</form>