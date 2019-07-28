
<?php
include ('entete.html');
include ('menu.php');
require ('includes/db_connect.php');
include ('class/controllerClass.php');
include ('class/viewClass.php');
?>

<div>
<?php 

$view = new viewClass(); 
$controller = new controllerClass();

	if(isset($_GET['nom']) && isset($_GET['prenom']) && $controller->individuExiste($conn,$_GET['nom'],$_GET['prenom']) )
	{
?>

<form action="individu.php" method="post">
<p> Voulez-vous vraiment supprimer cet individu ? <?php echo $_GET['nom'] . ' ' .  $_GET['prenom'] ; ?> ?
<input type="hidden" name="nom" value="<?php echo $_GET['nom'];?>"/>
<input type="hidden" name="prenom" value="<?php echo $_GET['prenom'];?>"/></p>
<p><input type="submit" value="oui" name="suppression"/><input type="submit" value="non" name="suppression"/></p>
</form>

<?php
	}
	else
	{
?>

	<p> Problème : retourner à la <a href="individu.php">liste des individus</a>.
<?php }

if(isset($_GET['groupe']) && $controller->groupeExiste($conn,$_GET['groupe']) )
	{
?>
<form action="groupe.php" method="post">
<p> Voulez-vous vraiment supprimer cet individu ? <?php echo $_GET['nom']; ?> ?
<input type="hidden" name="groupe" value="<?php echo $_GET['groupe'];?>"/></p>
<p><input type="submit" value="oui" name="suppression"/><input type="submit" value="non" name="suppression"/></p>
</form>

<?php
	}
	else
	{
?>

	<p> Problème : retourner à la <a href="groupe.php">liste des groupes</a>.
<?php }

	 ?>




</div>

