<?php
include '../include/config.php';
session_start();
$title = "Project";
include 'header.php';

$project = $con->query("SELECT * FROM project");
?>
<div class="col">
  <!-- data add message alert  -->
  <?php if (isset($_SESSION['project_added'])) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong><?= $_SESSION['project_added'] ?></strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php }
  unset($_SESSION['project_added']);
  ?>
  <!-- aleart end -->

  <!-- data delete message alert  -->
  <?php if (isset($_SESSION['project_deleted'])) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong><?= $_SESSION['project_deleted'] ?></strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php }
  unset($_SESSION['project_deleted']);
  ?>
  <!-- aleart end -->

  <!-- data update message alert  -->
  <?php if (isset($_SESSION['project_updated'])) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong><?= $_SESSION['project_updated'] ?></strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php }
  unset($_SESSION['project_updated']);
  ?>
  <!-- aleart end -->

  <table id='example' class="table table-bordered text-center">
    <thead>
      <tr>
        <th>Project Name</th>
        <th>Image</th>
        <th>Project Category</th>
        <th>Short Description</th>
      </tr>
    </thead>
    <tbody>
      <!-- php code -->
      <?php foreach ($project as $result) {
      ?>
        <tr>
          <td><?= $result['projectName'] ?></td>
          <td><img src="../Images/project/project_main/<?= $result['image'] ?>" alt="" style="width: 50px;"></td>
          <td><?= $result['layerTitle'] ?></td>
          <td><?= $result['layerDescription'] ?></td>
          <td>
            <div class="btn-group">
              <a class="btn btn-sm btn-warning" href="project_update.php?id=<?= base64_encode($result['id']) ?>">Update</a>
              <a class="btn btn-sm btn-danger" href="javascript:void(0);" onclick="confirmDeleteProject('<?= base64_encode($result['id']) ?>')">Delete</a>
            </div>
          </td>
        </tr>
        <!-- end foreach -->
      <?php } ?>
    </tbody>
  </table>
  <div class="row">
    <div class="col-12 text-center">
      <a class="btn btn-primary col-6" href="project_add.php">Add Another Project</a>
      <a href="../index.php" target="_blank"><button class="btn btn-success col-5">Go to Portfolio</button></a>
    </div>
  </div>
</div><!-- col -->

<?php include 'footer.php'; ?>