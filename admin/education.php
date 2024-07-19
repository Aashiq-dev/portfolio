<?php
include '../include/config.php';
session_start();
$title = "Education";
include 'header.php';

$education = $con->query("SELECT * FROM education");
?>

<div class="col">
  <!-- data add message alert  -->
  <?php if (isset($_SESSION['education_added'])) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong><?= $_SESSION['education_added'] ?></strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php }
  unset($_SESSION['education_added']);
  ?>
  <!-- aleart end -->

  <!-- data delete message alert  -->
  <?php if (isset($_SESSION['education_deleted'])) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong><?= $_SESSION['education_deleted'] ?></strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php }
  unset($_SESSION['education_deleted']);
  ?>
  <!-- aleart end -->

  <!-- data update message alert  -->
  <?php if (isset($_SESSION['education_updated'])) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong><?= $_SESSION['education_updated'] ?></strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php }
  unset($_SESSION['education_updated']);
  ?>
  <!-- aleart end -->

  <table id='example' class="table table-bordered text-center">
    <thead>
      <tr>
        <th>Year</th>
        <th>Title</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
      <!-- php code -->
      <?php foreach ($education as $result) {
      ?>
        <tr>
          <td><?= $result['year'] ?></td>
          <td><?= $result['title'] ?></td>
          <td><?= $result['description'] ?></td>
          <td>
            <div class="btn-group">
              <a class="btn btn-sm btn-warning" href="education_update.php?id=<?= base64_encode($result['id']) ?>">Update</a>
              <a class="btn btn-sm btn-danger" href="javascript:void(0);" onclick="confirmDeleteEducation('<?= base64_encode($result['id']) ?>')">Delete</a>
            </div>
          </td>
        </tr>
        <!-- end foreach -->
      <?php } ?>
    </tbody>
  </table>
  <div class="row">
    <div class="col-12 text-center">
      <a class="btn btn-primary col-6" href="education_add.php">Add Another Degree</a>
      <a href="../index.php" target="_blank"><button class="btn btn-success col-5">Go to Portfolio</button></a>
    </div>
  </div>
</div><!-- col -->
<?php include 'footer.php'; ?>