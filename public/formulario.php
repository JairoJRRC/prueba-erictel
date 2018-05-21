<?php include('../UserManagement.php') ?>
<html>
<head>
  <title>Ingrese datos:</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</head>
<body>
  <div class="panel-body">
    <div class="col-md-6 col-md-offset-3">
        <?php

          if(isset($_GET['id'])){
            $user = getUser($_GET['id']);

            $dt = new \DateTime();
            $dt->setTimestamp($user['birth_date']);
            $user['birth_date'] = $dt->format('d/m/Y');

            // var_dump($user);exit;
            ?>


            <form action=<?php echo ("../UserManagement.php?id=".$user['id']); ?> method="POST" scope="user">
              <div class="form-group">
                <label for="name">Nombres :</label>
                <input type="text" class="form-control" id="name" name="name" value=<?php echo $user['name']; ?>>
              </div>
              <div class="form-group">
                <label for="last_name">Apellidos :</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value=<?php echo $user['last_name']; ?>>
              </div>
              <div class="form-group">
                <label for="city">Ciudad :</label>
                <input type="text" class="form-control" id="city" name="city"  value=<?php echo $user['city']; ?>>
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" name="email"  value=<?php echo $user['email']; ?>>
              </div>
              <div class="form-group">
                <label for="cell_phone">Telefono:</label>
                <input type="text" class="form-control" id="cell_phone" name="cell_phone"  value=<?php echo $user['cellphone']; ?>>
              </div>
              <div class="form-group">
                <label for="birth_date">Fecha de nacimiento:</label>
                <input type="text" class="form-control" id="birth_date" name="birth_date"  value=<?php echo $user['birth_date']; ?>>
              </div>
              <button type="submit" class="btn btn-primary" name="formulario" value="edit">Submit</button>
            </form>


            <?php



          }else{

            ?>
                <form method="POST">
                <div class="form-group">
                  <label for="name">Nombres :</label>
                  <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                  <label for="last_name">Apellidos :</label>
                  <input type="text" class="form-control" id="last_name" name="last_name">
                </div>
                <div class="form-group">
                  <label for="city">Ciudad :</label>
                  <input type="text" class="form-control" id="city" name="city">
                </div>
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="text" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                  <label for="cell_phone">Telefono:</label>
                  <input type="text" class="form-control" id="cell_phone" name="cell_phone">
                </div>
                <div class="form-group">
                  <label for="birth_date">Fecha de nacimiento:</label>
                  <input type="text" class="form-control" id="birth_date" name="birth_date">
                </div>
                <button type="submit" class="btn btn-primary" name="formulario" value="insert">Submit</button>
              </form>
            <?php
          }
        ?>
          
    </div>      
</div>    
</body>
</html>

