  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      
    </div>
    <!-- Default to the left -->
      <strong>Copyright &copy; 2018 <a href="https://www.linkedin.com/in/francisco-d%C3%ADaz-quintero-ab3300164/" target="_blank">Francisco Díaz</a> &amp; <a href="https://www.linkedin.com/in/ezequiel-garc%C3%ADa-prieto-177279145/" target="_blank">Ezequiel García</a>.</strong> All rights reserved.
  </footer>

  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="<?php echo MAIN_LINK ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo MAIN_LINK ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?php echo MAIN_LINK ?>bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- DataTables -->
<script src="<?php echo MAIN_LINK ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo MAIN_LINK ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo MAIN_LINK ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo MAIN_LINK ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo MAIN_LINK ?>dist/js/adminlte.min.js"></script>
<!-- fullCalendar -->
<script src="<?php echo MAIN_LINK; ?>bower_components/moment/moment.js"></script>
<script src="<?php echo MAIN_LINK; ?>bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<!-- OTHER JS -->
<?php
    if($page != "home")
    {
?>
        <script src="<?php echo MAIN_LINK; ?>dist/js/<?php echo $page; ?>.js"></script>
<?php
    }
?>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>