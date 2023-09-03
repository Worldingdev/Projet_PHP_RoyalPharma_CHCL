<?php
session_start();
if($_SESSION['Type'] == 'Admin'){
    include("header.php");
  }elseif($_SESSION['Type'] == 'Vendeur'){
    include("headerSaler.php");
  }else{
    header("location:index.php");
  }   
use dao\ProduitsDao;

$produits = new ProduitsDao();
$allProduits = $produits->selectProduit(null);
?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Affichage de tous les produits</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Acceuil</a></li>
      <li class="breadcrumb-item">Gestion Produits</li>
      <li class="breadcrumb-item active">Afficher</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Liste des Produits</h5>

                <!-- Table with stripped rows -->
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Type</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Quantite</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        while($produits = $allProduits->fetch_assoc()){
                            if($produits['etat'] == true){
                        ?>
                    <tr>
                        <th><?php echo htmlentities($produits['Id']);?></th>
                        <td><?php echo htmlentities($produits['Nom']);?></td>
                        <td><?php echo htmlentities($produits['Type']);?></td>
                        <td><?php echo htmlentities($produits['Prix']);?></td>
                        <td><?php echo htmlentities($produits['quantite']);?></td>
                        <td>
                            <form method="post" action="../dao/ProduitsDao.php" >
                                <input type="text" name="id" value="<?php echo htmlentities($produits['Id']);?>"  class="form-control" hidden>
                                <button class="btn btn-secondary me-md-2" name="delete"  type="submit">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                        }}?>
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->

                </div>
            </div>
        </div>  
    </div>
</section>

</main><!-- End #main -->

<?php
include("footer.php");
?>