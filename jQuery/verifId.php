<?php
	include_once("connexion.php");
	include_once "gestionUtilisateur.php";
	try{
	$co=new gestionUtilisateur(USR ,MDP ,BDD );
	//évite les injections de code
	$id=strip_tags($_POST['identifiant']);
	$id=htmlspecialchars($id);
	$req="select * from utilisateur where identifiant='$id'";
	$res=$co->requeteSelection($req);
	if($ligne=$res->fetch()){
	echo 'non ok';
	}else{
	echo 'ok';
	}
	}
	catch (PDOException $ex){
	echo "Erreur lors de la connexion à la bd...";
	}
?>
