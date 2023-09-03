<?php
session_start();
use dao\ProduitsDao;
if($_SESSION['Type'] == 'Admin'){
include("header.php");

$produitDao = new ProduitsDao();
?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Modifier Produit</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Acceuil</a></li>
      <li class="breadcrumb-item">Gestion Produits</li>
      <li class="breadcrumb-item active">Modifier</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-8">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Formulaire de modification</h5>

          <form class="d-flex" method="post" action="">
                <div class="col-sm-8">
                    <input class="form-control" name="id" type="search" placeholder="Entrer l'Id du produit" aria-label="Search">
                </div>
                <button class="btn btn-outline-success" name="search" type="submit">Search</button>
          </form>

          <?php
              if(isset($_POST['id']) && isset($_POST['search'])){
                $allProduits = $produitDao->selectProduit(htmlentities($_POST['id']));
                $produit = $allProduits->fetch_assoc();
                if($produit != null){
            ?>

          <!-- General Form Elements -->
          <form method="post" action="../dao/ProduitsDao.php" >
            <div class="row mb-3">
              <label for="inputText" class="col-sm-4 col-form-label">Nom</label>
              <div class="col-sm-10">
                <input type="text" name="nom" value="<?php echo htmlentities($produit['Nom']);?>" class="form-control">
              </div>
            </div>
            
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-4 col-form-label">Prix</label>
              <div class="col-sm-10">
                <input type="number" name="prix" value="<?php echo htmlentities($produit['Prix']);?>" class="form-control">
              </div>
            </div>
            
            <div class="row mb-3">
              <label for="inputText" class="col-sm-4 col-form-label"> Type du Produit</label>
              <div class="col-sm-10">
                <select class="form-select" name="type" aria-label="Default select example">
                  <option <?php echo (htmlentities($produit['Type']) == 'pillule')? 'selected' : '' ;?> value="pillule">pillule</option>
                  <option <?php echo (htmlentities($produit['Type']) == 'sirop')? 'selected' : '' ;?> value="sirop">sirop</option>
                  <option <?php echo (htmlentities($produit['Type']) == 'autre')? 'selected' : '' ;?> value="autre">autre</option>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-4 col-form-label">Quantite</label>
              <div class="col-sm-10">
                <input type="number" name="quantite" value="<?php echo htmlentities($produit['quantite']);?>" class="form-control">
              </div>
            </div>
            
            
            <div class="row mb-3">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <input type="text" name="id" value="<?php echo htmlentities($produit['Id']);?>"  class="form-control" hidden>
                    <button class="btn btn-secondary me-md-2" name="modifier" type="modifier">Modifier</button>
                    <button class="btn btn-outline-secondary" type="reset">Annuler</button>
                </div>
            </div>

          </form><!-- End General Form Elements -->
          <?php
                }else{
                  ?>
                   <div class="alert alert-warning alert-dismissible fade show col-sm-10" role="alert">
                Aucun correspondant pour cet ID !!!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php
                }
          }?>
        </div>
      </div>

    </div>
  </div>
</section>

</main><!-- End #main -->
<?php
include("footer.php");   
        }else{
  header("location:index.php");
}    
?>