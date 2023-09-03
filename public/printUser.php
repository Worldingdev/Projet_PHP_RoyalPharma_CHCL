<?php
use dao\UtilisateurDao;
session_start();
if($_SESSION['Type'] == 'Admin'){
    include("header.php");
$users = new UtilisateurDao();
$allUsers = $users->selectUser(null);
?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Affichage de tous les utilisateurs</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Acceuil</a></li>
      <li class="breadcrumb-item">Gestion Utilisateur</li>
      <li class="breadcrumb-item active">Afficher</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Liste des utilisateurs</h5>

                <!-- Table with stripped rows -->
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Nom Utilisateur</th>
                        <th scope="col">Telephone</th>
                        <th scope="col">CIN/NIF</th>
                        <th scope="col">type</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($user = $allUsers->fetch_assoc()){
                            if($user['etat'] == true){
                        ?>
                    <tr>
                        <td><?php echo htmlentities($user['Id']);?></td>
                        <td><?php echo htmlentities($user['Nom']);?></td>
                        <td><?php echo htmlentities($user['Username']);?></td>
                        <td><?php echo htmlentities($user['Telephone']);?></td>
                        <td><?php echo htmlentities($user['NINU']);?></td>
                        <td><?php echo htmlentities($user['Type']);?></td>
                        <td>
                            <form method="post" action="../dao/UtilisateurDao.php" >
                                <input type="text" name="id" value="<?php echo htmlentities($user['Id']);?>"  class="form-control" hidden>
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
}else{
    header("location:index.php");
  }    
?>

