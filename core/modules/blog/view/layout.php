<html>
<head>
<title>ListHub | To-do List Administration</title>
<link rel="stylesheet" type="text/css" href="res/bootstrap3/css/bootstrap-yeti.min.css">
<script type="text/javascript" src="res/jquery.min.js"></script>
</head>

<body>
<header class="navbar navbar-default navbar-fixed-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="./">List</a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
          <li><a href="index.php?view=home"><i class="glyphicon glyphicon-home"></i></a></li>

      </ul>
<ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-cog"></i> <b class="caret"></b></a>
        <ul class="dropdown-menu">
<?php if(Session::getUID()!=""):?>
          <li><a href="logout.php">Salir</a></li>
<?php else: ?>
          <li><a href="index.php?view=login">Iniciar Sesion</a></li>
<?php endif; ?>
        </ul>
      </li>
    </ul>
    </nav>
  </div>
</header><br><br><br>
<div class='container'>
<div class="row">
<div class="col-md-12">
<?php 
	View::load("index");
?>
</div>
</div>
</div>

<script src="res/jquery.min.js"></script>
<script type="text/javascript" src="res/bootstrap3/js/bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(
    function()
    {
      $('.tip').tooltip();
    }
  );
  </script>

</body>

</html>