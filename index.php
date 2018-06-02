<?php
require_once("includes/initializer.php");
require_once(CLASS_DIR."access.php");
$access->checkSessions();
require_once(LIB_DIR."header.php");
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Page Header
        <small>Optional description</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
require_once(LIB_DIR."footer.php");
?>