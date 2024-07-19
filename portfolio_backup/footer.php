</div>
<footer class="main-footer">
    <p class="text-center"><strong>Copyright &copy;2024 Aashiq.</strong> All rights reserved.</p>
</footer>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script src="script_admin.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../sweetalert.js"></script>

//for sidebar
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="plugins/adminlte.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<?php
if (isset($_SESSION['status'])) {
?>
    <script>
        swal({
            title: "<?php echo $_SESSION['status'] ?>",
            //text: "You clicked the button!",
            icon: "success",
            button: "OK. Done",
        });
    </script>
<?php
    unset($_SESSION['status']);
}
?>
</body>

</html>