<?php 
include('config.php');
session_start();?>
<html>
<head>
  <title>Erictel</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</head>
<body>
  <?php

    if(isset($_POST['submit'])) {

          $config = Config::config(
            $_POST['serverName'],
            $_POST['user'],
            $_POST['password']
          );

          $_SESSION['connection'] = true;
          $_SESSION['serverName'] = $_POST['serverName'];
          $_SESSION['user'] = $_POST['user'];
          $_SESSION['password'] = $_POST['password'];
          
    } 

    if(!isset($_SESSION['connection'])) {
      echo "<script type='text/javascript'>
          $(document).ready(function(){
          $('#exampleModalCenter').modal('show');
          });
          </script>";
    } else { 
      
  ?>
    <ul class="nav nav-pills nav-fill">
      <li class="nav-item">
        <a class="nav-link active" href="../question_one.php">Listado - pregunta 1</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="formulario.php">Formulario -pregunta 2</a>
      </li>
    </ul>
    
  <?php
    } 
  ?>

  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Ingrese sus datos de conexion:</h5>
        </div>
        <div class="modal-body">
          <form method="POST">
        <div class="form-group">
          <label for="exampleInputEmail1">Server:</label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="serverName">
        </div>
        <div class="form-group">
          <label for="a">User:</label>
          <input type="text" class="form-control" id="a"name="user">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password:</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Guardar</button>
      </form>
        </div>
      </div>
    </div>
  </div>            
</body>
</html>
