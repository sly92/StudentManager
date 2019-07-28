
 <?php 

class viewClass
{

//Pour debugger
public function afficheT($tab)
{
	echo '<pre>';
	print_r($tab);
	echo '</pre>';
}


/* Affichage des informations des individus */

public function infoIndividus($bdd,$typeFilter,$valueFilter)
{

	$sql="";

	switch($typeFilter)
	{

	case 0: $sql+="select nom,prenom,niveau_individu from individus";
	break;
	case 1: $sql+="select nom,prenom,niveau_individu from individus where id_individu = ".$valueFilter;
	break;
	case 2: $sql+="select nom,prenom,niveau_individu from individus where nom like %".$valueFilter;
	break;
	case 3: $sql+="select nom,prenom,niveau_individu from individus where niveau_individu = ".$valueFilter;
	break;
	case 4: $sql+="select nom,prenom,niveau_individu from individus where ref_groupe = ".$valueFilter;
	break;

	default: echo "Erreur : les paramètres indiqué ne sont pris en compte ";

	}
	

	$stid = oci_parse($conn, $sql);
	if (!$stid){
	$e=oci_error();
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	$re = oci_execute($stid);
	if (!$re){
	echo "ERREUR sur exécution requete : $sql";
	$e = oci_error();
	print htmlentities($e['message']);
	}

	$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
	if($row)
	{
	echo "<table border='1'>\n";

	echo '<th> NOM </th><th> Prenom </th><th> Niveau </th>';
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "") . "</td>";
        echo '<td><a href="supprimer.php?nom='.urlencode($row['nom']).'&amp;prenom='. urlencode($row['prenom']).'"><img src="supprimer.png" alt="suppr"/></a></td></tr>'."\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";
}
else
			echo '<p>Aucun etudiant dans la base de données </p>';
}	


/* Affichage des informations des groupes */

public function infoGroupes($bdd,$typeFilter,$valueFilter)
{

	$sql="";

	switch($typeFilter)
	{

	case 0: $sql+="select lib_groupe,fid_type_groupe,annee from groupe";
	break;
	case 1: $sql+="select lib_groupe,fid_type_groupe,annee from groupe where id_groupe = ".$valueFilter;
	break;
	case 2: $sql+="select lib_groupe,fid_type_groupe,annee from groupe where lib_groupe like %".$valueFilter;
	break;
	case 3: $sql+="select lib_groupe,fid_type_groupe,annee from groupe where fid_type_groupe = ".$valueFilter;
	break;
	case 4: $sql+="select lib_groupe,fid_type_groupe,annee from groupe where annee = ".$valueFilter;
	break;

	default: echo "Erreur : les paramètres indiqué ne sont pris en compte ";

	}
	
	$stid = oci_parse($conn, $sql);
	if (!$stid){
	$e=oci_error();
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	$re = oci_execute($stid);
	if (!$re){
	echo "ERREUR sur exécution requete : $sql";
	$e = oci_error();
	print htmlentities($e['message']);
	}
	
	echo "<table border='1'>\n";
	
	echo '<th> Libelle </th><th> Type </th><th> Annee </th>';
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "") . "</td>\n";
        echo '<td><a href="supprimer.php?groupe='.urlencode($row['lib_groupe']).'><img src="supprimer.png" alt="suppr"/></a></td></tr>'."\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";

}

}


?> 