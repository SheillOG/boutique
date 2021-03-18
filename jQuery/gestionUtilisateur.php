<?php
/**
 * @author ncyr
 *
 *
 */
class gestionUtilisateur {
//attributs / proprits
public $connexion;
public $donnees;
//mthodes
//constructeur.
function __construct($nomUtilisateur,$motDePasse,$baseDeDonnees) {
//connexion la base de donnes
$serveur = "pgsql:dbname=jquery;host=10.0.10.130;port=3306";
//connexion en utilisant la classe d'accs aux donnes : PDO
try {
 $this->connexion = new PDO($serveur, $nomUtilisateur, $motDePasse);
 $this->connexion->setAttribute(PDO::ATTR_ERRMODE,
PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
 echo 'Echec lors de la connexion : ' . $e->getMessage();
$this->connexion=null;
}
}
public function connexionActive(){
return $this->connexion!=null;

//equivalent :
// if($this->connexion!=null) return true;
// else return false;
}
function requeteSelection($requete){
try {
if($this->connexionActive()==false){
return null;
}else{
$this->donnees=$this->connexion->query($requete);
return $this->donnees;
}
} catch (PDOException $e) {
 echo "Echec lors de l'execution de la requete : " . $e->getMessage();
 return null;
}
}
function requeteAction($requete){
try {
if($this->connexionActive()==false){
return null;
}else{
$this->donnees=$this->connexion->exec($requete);
return $this->donnees;
}
} catch (PDOException $e) {
 echo "Echec lors de l'execution de la requete : " . $e->getMessage();
 return null;
}
}
}


?>
