
<?php
include ('menu.php');
//require ('includes/db_connect.php');
// include ('class/controllerClass.php');
// include ('class/viewClass.php');
?>

<?php
/*
$view = new viewClass(); 
$controller = new controllerClass();

$view->infoGroupes($conn,0,"");

if(isset($_POST['ajoutmodif']))
{

$param = array('lib_groupe','fid_type_groupe','annee');

	//Si $_POST contient les clés nom, prenom, pays, score et naissance et qu'il y a des valeurs associées
	if(testParam($param,$_POST) || testParam($param2,$_POST))
	{

	if(groupeExiste($conn,$_POST['lib_groupe']))
			$controller->Modifer($conn,1,$_POST);
		else
			$controller->AjouterModif($conn,1,$_POST);
	}
}

	//Suppression d'un groupe ?
	$paramPost = array('suppression','lib_groupe');
	if($controller->testParam($paramPost,$_POST) && $_POST['suppression']=='oui')
	{
		//On teste si le joueur existe
		if($controller->individuExiste($conn,$_POST['lib_groupe']))
		{
			//On le supprime
			$controller->Supprimer($conn,1,$_POST);
		}

if(isset($_POST['fusion']))
$controller->Fusionner($conn,$_POST);
*/
?>
<?php
	/*		$sql="SELECT id_groupe,lib_groupe FROM groupe";
			$stid = oci_parse($conn, $sql);
		if (!$stid){
			$e=oci_error();
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		$re = oci_execute($stid);*/
		?>

<h2> Ajout / Modification d'un groupe </h2><br><br>
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
		<p><label> Libelle </label><br> <input type="text" name="nom" id="nom"/></p>
		<p><label> Type    </label><br> <input type="text" name="type" id="type"/></p>
		<p><label> Annee   </label><br> <input type="text" name="prenom" id="prenom"/></p><br><br>
		<input name="ajoutmodif" type="submit" />
	</form>
	
<br><br>

<h2> Fusionner deux groupes</h2><br><br>
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
		<!--<p><label> Libelle : </label> <input type="text" name="id1" id="id1"/></p>
		<p><label> Libelle : </label> <input type="text" name="id2" id="id2"/></p>-->
		<label> Groupe 1  </label> <br>
		<select name="groupe1" id="groupe1">
		<option value="0">Sélectionner un groupe</option>
		<?php
		//while ($tab=oci_fetch_array($stid)){
		?>
		<option value="<?php echo $tab['id_groupe']; ?>"><?php echo $tab['lib_groupe']; ?>
		</option>
		<?php
		//}
		?>
		</select><br><br>

		<label> Groupe 2  </label> <br>
		<select name="groupe2" id="groupe2">
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
		<input name="fusion" type="submit" />
	</form>


