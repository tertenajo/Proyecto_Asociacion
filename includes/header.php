<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo NAME_ASOC; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
  <link rel="stylesheet" href="<?php echo MAIN_LINK; ?>bower_components/bootstrap/dist/css/bootstrap.min.css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo MAIN_LINK; ?>bower_components/font-awesome/css/font-awesome.min.css" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo MAIN_LINK; ?>bower_components/Ionicons/css/ionicons.min.css" />
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo MAIN_LINK; ?>bower_components/select2/dist/css/select2.min.css"/>
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo MAIN_LINK; ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo MAIN_LINK; ?>dist/css/AdminLTE.min.css" />
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="<?php echo MAIN_LINK; ?>dist/css/skins/skin-green.min.css" />
    <!-- fullCalendar -->
  <link rel="stylesheet" href="<?php echo MAIN_LINK; ?>bower_components/fullcalendar/dist/fullcalendar.min.css" />
  <link rel="stylesheet" href="<?php echo MAIN_LINK; ?>bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print" />
  <!-- Others CSS -->
  <link rel="stylesheet" href="<?php echo MAIN_LINK; ?>dist/css/estilos.css" />
  <link rel="shortcut icon" href="<?php echo MAIN_LINK; ?>dist/img/favicon.png" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" />
</head>

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo MAIN_LINK; ?>index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="<?php echo MAIN_LINK; ?>dist/img/logo-mini.png" /></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="<?php echo MAIN_LINK; ?>dist/img/logo.png" /></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <i class="fa fa-user-o" aria-hidden="true"></i>
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php if(isset($_SESSION["user"])){ echo ucwords($_SESSION["user"]); } ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
              <span class="hidden-xs"><?php if(isset($_SESSION["permission"])){ echo $_SESSION["permission"]; } ?></span>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo MAIN_LINK; ?>controllers/logOutController.php" class="btn btn-default btn-flat">Desconectarse</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional)
      <div class="user-panel">
        <div class="pull-left image">
          <i class="fa fa-user-o fa-3x" aria-hidden="true"></i>
        </div>
        <div class="pull-left info">
          <p><?php if(isset($_SESSION["user"])){ echo ucwords($_SESSION["user"]); } ?></p>
        </div>
      </div> -->
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENÚ DE GESTIÓN</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="<?php if($page == "home"){ echo "active";} ?>"><a href="<?php echo MAIN_LINK; ?>index.php"><i class="fa fa-home" aria-hidden="true"></i><span>Inicio</span></a></li>
        <?php
            if($_SESSION["permission"]!="NO")
            {
                if($_SESSION["permission"]=="admin" || $_SESSION["permission"]=="jefeproyecto")
                {
        ?>
        <li class="<?php if($page == "professionals"){ echo "active";} ?>"><a href="<?php echo MAIN_LINK; ?>pages/professionals.php"><i class="ion ion-person"></i><span>Profesionales</span></a></li>
        <?php
                }
        ?>
        <li><a href="#"><i class="ion ion-ios-albums"></i><span>Sesiones</span></a></li>        
        <li><a href="#"><i class="ion ion-ios-people"></i><span>Usuarios</span></a></li>
        <?php
                if($_SESSION["permission"]=="admin")
                {
        ?>
        <li class="treeview">
          <a href="#"><i class="fa fa-plus"></i><span>Otras gestiones</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo MAIN_LINK; ?>pages/projects.php"><span>Proyectos</span></a></li>
            <li><a href="#">Prestación Social</a></li>
            <li><a href="#">Nivel Formativo</a></li>
            <li><a href="#">Situación Laboral</a></li>
            <li><a href="#">Tipos de Atención</a></li>
          </ul>
        </li>
        <?php
                }
            }
        ?>                
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
