<?php
session_start();
if($_SESSION['Type'] == 'Admin'){
  include("header.php");
?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Enregistrer Produits</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Acceuil</a></li>
      <li class="breadcrumb-item">Gestion Produits</li>
      <li class="breadcrumb-item active">Enregistrer</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-8">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Formulaire d'enregistrement</h5>

          <!-- General Form Elements -->
          <form method="post" action="../dao/ProduitsDao.php" >
            <div class="row mb-3">
              <label for="inputText" class="col-sm-4 col-form-label">Nom</label>
              <div class="col-sm-10">
                <input type="text" name="nom" class="form-control">
              </div>
            </div>
            
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-4 col-form-label">Prix</label>
              <div class="col-sm-10">
                <input type="number" name="prix" class="form-control">
              </div>
            </div>
            
            <div class="row mb-3">
              <label for="inputText" class="col-sm-4 col-form-label"> Type du Produit</label>
              <div class="col-sm-10">
                <select class="form-select" name="type" aria-label="Default select example">
                  <option selected>selectionnez le type</option>
                  <option value="pillule">pillule</option>
                  <option value="sirop">sirop</option>
                  <option value="autre">autre</option>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-4 col-form-label">Quantite</label>
              <div class="col-sm-10">
                <input type="number" name="quantite" class="form-control">
              </div>
            </div>
            
            
            <div class="row mb-3">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-secondary me-md-2" name="save" type="submit">Enregistrer</button>
                    <button class="btn btn-outline-secondary" type="reset">Annuler</button>
                </div>
            </div>

          </form><!-- End General Form Elements -->

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