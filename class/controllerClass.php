<?php

class controllerClass
{


//Test si les valeurs du premier tableau ($cle) sont des clés du deuxième et si les valeurs ne sont pas vides
function testParam($cle,$tableau)
{
	foreach($cle as $v)
		if(!isset($tableau[$v]) or trim($tableau[$v])== '')
			return false;
	return true;
}

// Verifie si l'individu existe dans la base
function individuExiste($bd,$nom,$prenom)
{
	
		$sql="SELECT * FROM individus WHERE Nom =".$nom." AND Prénom =".$prenom;
		$stid = oci_parse($conn, $sql);
		if (!$stid){
			$e=oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		$re = oci_execute($stid);
}


// Verifie si le nom du groupe est deja pris
function groupeExiste($bd,$groupe)
{
	
		$sql="SELECT * FROM groupe WHERE lib_groupe =".$groupe;
		$stid = oci_parse($conn, $sql);
		if (!$stid){
			$e=oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		$re = oci_execute($stid);
}


public function AjouterModif($bdd,$typeFilter,$post)
{

	$sql="";

	switch($typeFilter)
	{
	
	case 0: $sql+="insert into individu values(".$post['nom'].",".$post['prenom'].")";
	break;
	case 1: $sql+="insert into groupe values(".$post['lib_groupe'].",".$post['fid_type_groupe'].",".$post['annee'].")";
	case 3: $sql+="insert into groupe_forme values(".$post['id_groupe'].",".$post['id_individu'].")";

	default: echo "Erreur : les paramètres ne sont pris en compte ";

	}
	
	$stid = oci_parse($conn, $sql);
	if (!$stid){
	$e=oci_error($stid);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	$re = oci_execute($stid);
	if (!$re){
	echo "ERREUR sur exécution requete : $sql";
	$e = oci_error($re);
	print htmlentities($e['message']);
	}
}


public function Supprimer($bdd,$typeFilter,$post)
{

	
	$param = array('nom','prenom');
	$param2 = array('lib_groupe','fid_type_groupe','annee');

	//Si $_POST contient les clés nom, prenom, pays, score et naissance et qu'il y a des valeurs associées
	if(testParam($param,$_POST) || testParam($param2,$_POST))
	{

	$sql="";	
	switch($typeFilter)
	{

	case 1: $sql+="delete from individu where id_individu = ".$post['id'];
	break;
	case 2: $sql+="delete from groupe where id_groupe = ".$post['id'];

	default: echo "Erreur : les paramètres ne sont pris en compte ";

	}
	
	$stid = oci_parse($conn, $sql);
	if (!$stid){
	$e=oci_error($stid);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	$re = oci_execute($stid);
	if (!$re){
	echo "ERREUR sur exécution requete : $sql";
	$e = oci_error($re);
	print htmlentities($e['message']);
	}
}
}


public function Modifier($bdd,$typeFilter,$post)
{
	$param = array('nom','prenom');
	$param2 = array('lib_groupe','fid_type_groupe','annee');

	//Si $_POST contient les clés nom, prenom, pays, score et naissance et qu'il y a des valeurs associées
	if(testParam($param,$_POST) || testParam($param2,$_POST))
	{
	$sql="";

	switch($typeFilter)
	{

	case 1: $sql+="update etudiant set nom = ".$post['nom'].", prenom = ".$post['prenom'];
	break;
	case 2: $sql+="update groupe set lib_groupe = ".$post['lib_groupe'].", fid_type_groupe= ".$post['fid_type_groupe'].", annee = ".$post['annee'];
	default: echo "Erreur : les paramètres ne sont pris en compte ";

	}
	
	$stid = oci_parse($conn, $sql);
	if (!$stid){
	$e=oci_error($stid);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	$re = oci_execute($stid);
	if (!$re){
	echo "ERREUR sur exécution requete : $sql";
	$e = oci_error($re);
	print htmlentities($e['message']);
	}
}
}


public function Fusionner($bdd,$post)
{

	$param = array('id1','id2');

	//Si $_POST contient les clés nom, prenom, pays, score et naissance et qu'il y a des valeurs associées
	if(testParam($param,$_POST))
	{
		$sql="select * from groupe where ref_groupe= ".$post['id1']." union all select * from groupe where ref_groupe= ".$post['id2'];

	$stid = oci_parse($conn, $sql);
	if (!$stid){
	$e=oci_error($stid);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	$re = oci_execute($stid);
	if (!$re){
	echo "ERREUR sur exécution requete : $sql";
	$e = oci_error($re);
	print htmlentities($e['message']);
	}

	$tab=oci_fetch_array($stid);
	if($tab!=null)
	ajouter($conn,3,$tab);


}
}

public function importCsv($bdd,$post,$type)
{

/*if($type=0){
$table="individus";
$colonne=array("")
}
else
{
$table="groupe";
$colonne=array("")

$row = 1;*/

$csvFichier=$post['fichier'];
/*$dlim=",";
$enclose="";

$fichier = fopen($csvFichier, 'r');
    
    while (!feof($fichier) ) {
        $row[] = fgetcsv($fichier, 1024);
    }
   
fclose($file_handle);
*/

if($type=0){
$sql="OPTIONS (ERRORS=500, SILENT=(FEEDBACK))
LOAD DATA
INFILE ".$post['fichier']."
INTO TABLE individus
FIELDS TERMINATED BY ';'
(id_individu,nom,prenom,niveau_individu)";
}
else
{
$sql="OPTIONS (ERRORS=500, SILENT=(FEEDBACK))
LOAD DATA
INFILE ".$post['fichier']."
INTO TABLE groupe
FIELDS TERMINATED BY ';'
(id_groupe,lib_groupe,commentaire,fid_type_groupe,annee,fid_ade,fid_edt,specifique_ec,code_ec,code_vet)";
}

$stid = oci_parse($conn, $sql);
	if (!$stid){
	$e=oci_error($stid);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	$re = oci_execute($stid);
}

}

?>