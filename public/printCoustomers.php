<?php
session_start();
if($_SESSION['Type'] == 'Admin'){
    include("header.php");
  }elseif($_SESSION['Type'] == 'Vendeur'){
    include("headerSaler.php");
  }else{
    header("location:index.php");
  }   
use dao\ClientDao;

$clients = new ClientDao();
$allClients = $clients->selectClient(null);
?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Affichage de tous les clients</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Acceuil</a></li>
      <li class="breadcrumb-item">Clients</li>
      <li class="breadcrumb-item active">Afficher</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-14">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Liste des Clients</h5>

                <!-- Table with stripped rows -->
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prenom</th>
                        <th scope="col">Sexe</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Telephone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Date Naissance</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        while($clients = $allClients->fetch_assoc()){
                            if($clients['etat'] == true){
                        ?>
                    <tr>
                        <th><?php echo htmlentities($clients['Id']);?></th>
                        <td><?php echo htmlentities($clients['Nom']);?></td>
                        <td><?php echo htmlentities($clients['Prenom']);?></td>
                        <td><?php echo htmlentities($clients['Sexe']);?></td>
                        <td><?php echo htmlentities($clients['Adresse']);?></td>
                        <td><?php echo htmlentities($clients['Telephone']);?></td>
                        <td><?php echo htmlentities($clients['Email']);?></td>
                        <td><?php echo $clients['Dob'];?></td>
                        <td>
                            <form method="post" action="../dao/ClientDao.php" >
                                <input type="text" name="id" value="<?php echo htmlentities($clients['Id']);?>"  class="form-control" hidden>
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