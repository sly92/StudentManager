
<?php
include ('entete.html');
include ('menu.php');
//require ('includes/db_connect.php');
//include ('class/controllerClass.php');
//include ('class/viewClass.php');
?>

<?php
/*
$view = new viewClass(); 
$controller = new controllerClass();

$view->infoIndividus($conn,0,"");

if(isset($_POST['submit']))
{

$param = array('nom','prenom');

	//Si $_POST contient les clés nom, prenom, pays, score et naissance et qu'il y a des valeurs associées
	if(testParam($param,$_POST))
	{

	if(groupeExiste($conn,$_POST['nom'],$_POST['nom']))
			$controller->Modifer($conn,0,$_POST);
		else
			$controller->Ajouter($conn,0,$_POST);
	}
}

	//Suppression d'un individus ?
	$paramPost = array('suppression','nom','prenom');
	if($controller->testParam($paramPost,$_POST) && $_POST['suppression']=='oui')
	{
		//On teste si le joueur existe
		if($controller->individuExiste($bd,$_POST['nom'],$_POST['prenom']))
		{
			//On le supprime	
			$controller->Supprimer($conn,0,$_POST);
				
		}
	}


*/?> 


<h2> Ajout d'un individu </h2><br><br>
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
		<p><label> Nom  </label> <br><input type="text" name="nom" id="nom"/></p>
		<p><label> Prénom  </label> <br><input type="text" name="prenom" id="prenom"/></p>
		<p><label> Groupe  </label><br>
	
		<?php
		/*	$sql="SELECT id_groupe,lib_groupe FROM groupe";
			$stid = oci_parse($conn, $sql);
		if (!$stid){
			$e=oci_error();
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		$re = oci_execute($stid);*/
		?>
		<select name="groupe" id="groupe">
		<option value="0">Sélectionner un groupe</option>
		<?php
		//while ($tab=oci_fetch_array($stid)){
		?>
		<option value="<?php echo $tab['id_groupe']; ?>"><?php echo $tab['lib_groupe']; ?>
		</option>
		<?php
		//}
		?>
		</select><br><br><br>
		<input type="submit" />
	</form>














