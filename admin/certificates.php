<?php
include '../include/config.php';
session_start();
$title = "Certificate";
include 'header.php';

$certificate = $con->query("SELECT * FROM certificate");
?>

<div class="col">

  <?php if (isset($_SESSION['certificate_added'])) { ?><!-- data add message alert  -->
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong><?= $_SESSION['certificate_added'] ?></strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php }
  unset($_SESSION['certificate_added']);
  ?><!-- aleart end -->

  <?php if (isset($_SESSION['certificate_deleted'])) { ?><!-- data delete message alert  -->
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong><?= $_SESSION['certificate_deleted'] ?></strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php }
  unset($_SESSION['certificate_deleted']);
  ?><!-- aleart end -->

  <?php if (isset($_SESSION['certificate_updated'])) { ?><!-- data update message alert  -->
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong><?= $_SESSION['certificate_updated'] ?></strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php }
  unset($_SESSION['certificate_updated']);
  ?><!-- aleart end -->

  <table id='example' class="table table-bordered text-center">
    <thead>
      <tr>
        <th>Icon</th>
        <th>Title</th>
        <th>Description1</th>
        <th>Description2</th>
      </tr>
    </thead>
    <tbody>
      <!-- php code -->
      <?php foreach ($certificate as $result) {
      ?>
        <tr>
          <td><img src="../Images/course/<?php echo $result['icon'] ?>" alt="" width="50px"></td>
          <td><?= $result['title'] ?></td>
          <td><?= $result['description1'] ?></td>
          <td><?= $result['description2'] ?></td>
          <td>
            <div class="btn-group">
              <a class="btn btn-sm btn-warning" href="certificate_update.php?id=<?= base64_encode($result['id']) ?>">Update</a>
              <a class="btn btn-sm btn-danger" href="javascript:void(0);" onclick="confirmDeleteCertificate('<?= base64_encode($result['id']) ?>')">Delete</a>
            </div>
          </td>
        </tr>
        <!-- end foreach -->
      <?php } ?>
    </tbody>
  </table>
  <div class="row">
    <div class="col-12 text-center">
      <a class="btn btn-primary col-6" href="certificate_add.php">Add Another Certificate or Course</a>
      <a href="../index.php" target="_blank"><button class="btn btn-success col-5">Go to Portfolio</button></a>
    </div>
  </div>
</div><!-- col -->

<?php include 'footer.php'; ?>