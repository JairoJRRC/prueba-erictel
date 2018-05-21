<?php session_start();?>
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
		include ("config.php");
		if(isset($_POST['submit']))
		{
		   createConnection();
		} 

		function createConnection()
	   	{
			$config = new Config(
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
			$config = new Config(
				$_SESSION['serverName'],
				$_SESSION['user'],
				$_SESSION['password']
			);
	?>

		<div class="col-lg-10 offset-lg-2" content-wrapper”>
		   <h3 class=”text-primary”>Información de base de datos: </h3>
		      <div class=”row”>
		         <div class="col-lg-12">
		             <div class=”card”>
		                <div class=”card-block”>  
		                    <table class="table">
		                       <thead>
		                          <tr class=”text-primary”>
		                             <th>#</th>
		                             <th>Name</th>
		                             <th>Email ID</th>
		                             <th>Customer ID</th>
		                             <th>Country</th>
		                          </tr>
		                       </thead>
									<?php
										$exportData=[];
										$sql = "SELECT * from TB_USUARIO";

										$stmt = sqlsrv_query( $config->conn, $sql );

										if( $stmt === false) {
										    die( print_r( sqlsrv_errors(), true) );
										}
											
										while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
										
									?>
				                        <tbody>
				                           <tr>
				                              <th scope="row">
				                              </th>
				                              <td>
				                              <?php echo $row['id']; ?>
				                              </td>
				                              <td>
				                              <?php echo $row['name']; ?>
				                              </td>
				                              <td>
				                              <?php echo $row['last_name']; ?>
				                              </td>
				                              <td>
				                              <?php echo $row['address']; ?>
				                              </td>
				                           </tr>
				                        </tbody>
										<?php
											$exportData[] = $row; 
												}
											
										?>
			                </table>
			            </div>
			          </div>
			     </div>
			  </div>
		</div>
		<form action="separar.php" method="POST">
			<?php 
				$_POST['exportData'] = $exportData;
			?>
	        <button type="submit" class="btn btn-primary" name="export">Exportar Excel</button>
	    </form>
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
