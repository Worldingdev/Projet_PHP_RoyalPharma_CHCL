<?php
session_start();
if($_SESSION['Type'] == 'Admin'){
  include("header.php");
?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Enregistrer Utilisateur</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Acceuil</a></li>
      <li class="breadcrumb-item">Gestion utilisateur</li>
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
          <form method="post" action="../dao/UtilisateurDao.php" >
            <div class="row mb-3">
              <label for="inputText"  class="col-sm-4 col-form-label">Nom</label>
              <div class="col-sm-10">
                <input type="text" name="name" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputText"  class="col-sm-4 col-form-label">Nom utilisateur</label>
              <div class="col-sm-10">
                <input type="text" name="username" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-4 col-form-label">Telephone</label>
              <div class="col-sm-10">
                <input type="text" id="telephone" placeholder="Ex: +509 xxxx xxxx" onchange="validerNumero()" name="tel" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-4 col-form-label">NIF/CIN</label>
              <div class="col-sm-10">
                <input type="number" name="NUNI" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputPassword" class="col-sm-4 col-form-label">Mot de passe</label>
              <div class="col-sm-10">
                <input type="password" class="form-control">
              </div>
            </div>
            
            
            <fieldset class="row mb-3">
              <legend class="col-form-label col-sm-4 pt-0">Type</legend>
              <div class="col-sm-10">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="Admin" checked>
                  <label class="form-check-label" for="gridRadios1">
                    Admin
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="Vendeur">
                  <label class="form-check-label" for="gridRadios2">
                    Vendeur
                  </label>
                </div>
              </div>
            </fieldset>
            
            <div class="row mb-10">
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
<script src="control.js"></script>

</main><!-- End #main -->
<?php
include("footer.php");
}else{
  header("location:index.php");
}    
?>