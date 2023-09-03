<?php
namespace dao;


require __DIR__ . '/../vendor/autoload.php';
use config\Connection;
use controller\ProduitController;

class ProduitsDao{


    public function save(){
        $con = new Connection();
        $produitController = new ProduitController();
        $produit = $produitController->save();
        $con = $con->connection();
        $name = $produit->getNom();
        $prix = $produit->getprix();
        $type = $produit->getType();
        $quantite = $produit->getQte();
        $etat = true;
        do{
            $id = 'Prod-'.substr($name, 0,2).'-'.random_int(100,999);
            $query = $con->prepare("SELECT  * FROM Produit where Id=?");
            $query->execute(array($id));
            $query->store_result();
            $produits = $query->num_rows();
        }while($produits>0);
        $query2 = $con->prepare("INSERT INTO `Produit`(`Id`, `Nom`, `Prix`, `quantite`, `Type`,`etat`) VALUES (?,?,?,?,?,?)");
        $query2->execute(array($id,$name,$prix,$quantite,$type,$etat));
        $con->close();
        header('location:../public/printProduct.php');
    }

    public function modifier(){
        $con = new Connection();
        $produitController = new ProduitController();
        $produit = $produitController->modifier();
        $con = $con->connection();
        $id = $produit->getId();
        $name = $produit->getNom();
        $prix = $produit->getprix();
        $type = $produit->getType();
        $quantite = $produit->getQte();
        $query2 = $con->prepare("UPDATE Produit SET Nom=?, Prix=?, quantite=?,Type=? WHERE Id=?");
        $query2->bind_param("sdiss",$name,$prix,$quantite,$type,$id);
        $query2->execute();
        $con->close();
        header('location:../public/printProduct.php');
    }

    public function delete(){
        $con = new Connection();
        $produitController = new ProduitController();
        $produit = $produitController->delete();
        $con = $con->connection();
        $id = $produit->getId();
        $query2 = $con->prepare("UPDATE Produit SET  etat= false WHERE Id=? ");
        $query2->bind_param("s",$id);
        $query2->execute();
        $con->close();
        header('location:../public/printProduct.php');
    }


    public function selectProduit($id){
        $con = new Connection();
        $con = $con->connection();
        if($id == null){
            $produits = $con->query("SELECT  * FROM Produit");
        }
        else{
            $produits = $con->prepare("SELECT  * FROM Produit where Id=?");
            $produits->execute(array($id));
            $produits = $produits->get_result();
        }
        
        return $produits;
    }

}
$produitDao = new ProduitsDao();
if (isset($_POST['save'])){
    $produitDao->save();
}
if (isset($_POST['delete'])){
    $produitDao->delete();
}
if (isset($_POST['modifier'])){
    $produitDao->modifier();
}