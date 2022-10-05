<!DOCTYPE html>
<html>
<head>
		<?php include "../templates/head.php"?>
	</head>
	<body>

	<?php include "../templates/navbar.php"?>

		<!--CONTAINER-->
		<div class="container-fluid">
			
			<div class="row">

			<?php include "../templates/side.php"?>

				<!--CONTENT-->
				<div class="col-lg-10 col-sm-12">
					
					<!--BREAD-->
					<div class="border-bottom">
						
						<div class="row m-2">
							
							<div class="col">
								<p>Productos</p>
							</div>
							<div class="col">
							<button type="button" class="btn btn-info float-end" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
								Añadir producto
							</button>
							</div>

						</div>

					</div>

					<!--CONTENT-->

					<div class="row">
						

						
						<div class="col-md-3 col-sm-10 p-2">
							
							<div class="card mb-1" >
							  <img src="../public/img/logo.png" class="card-img-top img-fluid" alt="...">
							  <div class="card-body">
							    <h5 class="card-title text-center">
							    	Tostachos
							    </h5>
    							<h6 class="card-subtitle mb-2 text-muted text-center">
    								Botanas
    							</h6>
							    <p class="card-text">
							    	Some quick example text to build on the card title and make up the bulk of the card's content
							    </p>
							    <div class="row">
									<button type="button" class="btn btn-warning col-6" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
									Editar 
								</button>
							    	
								    <button type="button" class="btn btn-danger col-6" onClick="delete(e)">
								    	Eliminar
								    </a>
								    
							    </div>
							  </div>
							</div>


						</div>

					</div>

				</div>

			</div>

		</div>
		<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Añadir producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	  <label for="recipient-name" class="col-form-label">Recipient:</label>
	  <input type="text" class="form-control" id="recipient-name">
	  <label for="recipient-name" class="col-form-label">Recipient:</label>
	  <input type="text" class="form-control" id="recipient-name">
	  <label for="recipient-name" class="col-form-label">Recipient:</label>
	  <input type="text" class="form-control" id="recipient-name">
	  <label for="recipient-name" class="col-form-label">Recipient:</label>
	  <input type="text" class="form-control" id="recipient-name">
	  <label for="recipient-name" class="col-form-label">Recipient:</label>
	  <input type="text" class="form-control" id="recipient-name">
	  <label for="recipient-name" class="col-form-label">Recipient:</label>
	  <input type="text" class="form-control" id="recipient-name">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Aceptar</button>
      </div>
    </div>
  </div>
</div>				
		<script type="text/javascript">
			function delete(target){
				swal({
					title: "Are you sure?",
					text: "Once deleted, you will not be able to recover this imaginary file!",
					icon: "warning",
					buttons: true,
					dangerMode: true,
					})
					.then((willDelete) => {
					if (willDelete) {
						swal("Poof! Your imaginary file has been deleted!", {
						icon: "success",
						});
					} else {
						swal("Your imaginary file is safe!");
					}
					});
			}
		</script>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
	</body>
</html>