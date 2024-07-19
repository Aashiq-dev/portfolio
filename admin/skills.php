<?php
include '../include/config.php';
session_start();
$title = "Skill";
include 'header.php';
$skills = $con->query("SELECT * FROM skills");
?>

<div class="col">
  <!-- data add message alert  -->
  <?php if (isset($_SESSION['skill_added'])) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong><?= $_SESSION['skill_added'] ?></strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php }
  unset($_SESSION['skill_added']);
  ?>
  <!-- aleart end -->

  <!-- data delete message alert  -->
  <?php if (isset($_SESSION['skill_deleted'])) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong><?= $_SESSION['skill_deleted'] ?></strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php }
  unset($_SESSION['skill_deleted']);
  ?>
  <!-- aleart end -->

  <!-- data update message alert  -->
  <?php if (isset($_SESSION['skill_updated'])) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong><?= $_SESSION['skill_updated'] ?></strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php }
  unset($_SESSION['skill_updated']);
  ?>
  <!-- aleart end -->

  <table id='example' class="table table-bordered text-center">
    <thead>
      <tr>
        <th>Image</th>
        <th>Title</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
      <!-- php code -->
      <?php foreach ($skills as $result) {
      ?>
        <tr>
          <td><img src="../Images/skill/<?= $result['image'] ?>" alt="" style="width: 50px;"></td>
          <td><?= $result['title'] ?></td>
          <td><?= $result['description'] ?></td>
          <td>
            <div class="btn-group">
              <a class="btn btn-sm btn-warning" href="skill_update.php?id=<?= base64_encode($result['id']) ?>">Update</a>
              <a class="btn btn-sm btn-danger" href="javascript:void(0);" onclick="confirmDeleteSkill('<?= base64_encode($result['id']) ?>')">Delete</a>
            </div>
          </td>
        </tr>
        <!-- end foreach -->
      <?php } ?>
    </tbody>
  </table>
  <div class="row">
    <div class="col-12 text-center">
      <a class="btn btn-primary col-6" href="skills_add.php">Add Another Skill</a>
      <a href="../index.php" target="_blank"><button class="btn btn-success col-5">Go to Portfolio</button></a>
    </div>
  </div>
</div><!-- col -->

<?php include 'footer.php'; ?>