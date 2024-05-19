<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>OSP Easy Editor</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <!-- Theme style -->
  <link rel="stylesheet" href="/css/adminlte/adminlte.min.css">
  
<link rel="stylesheet" href="/css/custom.css" />
<link rel="stylesheet" href="/css/dataTables.dataTables.css" />
<link rel="stylesheet" href="/css/dataTables.jqueryui.css" />
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/ekko-lightbox.css">
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">

<script>var app = {};</script>
<script src="/js/jquery-3.6.0.min.js"></script>
<script src="/js/jquery-ui.js"></script>
<script src="/js/dataTables.js"></script>
<script src="/js/dataTables.jqueryui.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/ekko-lightbox.min.js"></script>
<script src="/js/ekko-lightbox.custom.js"></script>
  
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
        <div class="container">
        <a href="#" class="navbar-brand">
            <span class="brand-text font-weight-light"><a href="https://ospanel.io/" target="_blank">OSP</a>&nbsp;<a href="https://github.com/viansoft/osp/" target="_blank">Easy Editor</a></span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <ul class="navbar-nav">
            <li class="nav-item"><a href="/project/" class="<?= (app()->controllerName == 'project' ? 'active ' : '') ?>nav-link">Projects</a></li>
            <li class="nav-item"><a href="/system/" class="<?= (app()->controllerName == 'system' ? 'active ' : '') ?>nav-link">System</a></li>
        </ul>
        </div>
    </nav>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> <?= controller()->getTitle() ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6"><?= controller()->getBreadcrumb() ?></div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container"><?= $content ?></div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Write here: <a href="https://t.me/OspEasyEditor" target="_blank">https://t.me/OspEasyEditor</a> is it usefull for you and if you need something else?
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2024 <a href="https://github.com/viansoft/osp/" target="_blank">viansoft</a>. All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<!-- Bootstrap 4 -->
<script src="/js/adminlte/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/js/adminlte/adminlte.min.js"></script>
</body>
</html>
