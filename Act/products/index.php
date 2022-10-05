<!DOCTYPE html>
<html>
	<head>
		<?php include "../layouts/head.template.php"; ?>
	</head>
	<body>

		<?php include "../layouts/nav.template.php"; ?>

		<!--CONTAINER-->
		<div class="container-fluid">
			
			<div class="row">

				<!--SIDEBAR-->
				<?php include "../layouts/sidebar.template.php"; ?>

				<!--CONTENT-->
				<div class="col-lg-10 col-sm-12">
					
					<!--BREAD-->
					<div class="border-bottom">
						
						<div class="row m-2">
							
							<div class="col">
								<p>Productos</p>
							</div>
							<div class="col">
								<button data-bs-toggle="modal" data-bs-target="#createProductModal" class="btn btn-info float-end">
									Añadir producto
								</button>
							</div>

						</div>

					</div>

					<!--CONTENT-->

					<div class="row">
						<?php 
							
							require '../app/ProductsController.php'; 
							$token = strip_tags($_SESSION['token']);
							$clase = new ProductsController();
							$marcas = $clase->cargarMarcas(); 
							$array = $clase->cargar($token); 
							foreach ($array as $valor) {
								echo '<div class="col-md-3 col-sm-10 p-2">
								
								<div class="card mb-1" >
								  <img src="'.$valor->cover.'" class="card-img-top img-fluid" alt="...">
								  <div class="card-body">
								    <h5 class="card-title text-center">
								    	'.$valor->name.'
								    </h5>
								    <p class="card-text">
								    	'.$valor->description.'
								    </p>
								    <p class="card-text">
								    	'.$valor->brand->name.'
								    </p>
								    <div class="row">
								    	<a href="#" data-bs-toggle="modal" data-bs-target="#createProductModal" class="btn btn-warning col-6">
									    	Editar
									    </a>
									    <a onclick="remove(this)" href="#" class="btn btn-danger col-6">
									    	Eliminar
									    </a>
									    <a href="details.php?slug='.$valor->slug.'" class="btn btn-info col-12">
									    	Detalles
									    </a>
								    </div>
								  </div>
								</div>
							</div>';
							} ?> 
						
					</div>

				</div>

			</div>

		</div>

		<!-- Modal -->
		<div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Añadir producto</h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body">
		        
		        <form method="post" action="../app/ProductsController.php" class="form" enctype="multipart/form-data">

			      	<div class="input-group mb-3">
					  <span class="input-group-text" id="basic-addon1">Name</span>
					  <input type="text" class="form-control" name="name" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1">
					</div>

					<div class="input-group mb-3">
					  <span class="input-group-text" id="basic-addon1">Slug</span>
					  <input type="text" class="form-control" name="slug" placeholder="Slug" aria-label="Slug" aria-describedby="basic-addon1">
					</div>

					<div class="input-group mb-3">
					  <span class="input-group-text" id="basic-addon1">Description</span>
					  <input type="textarea" class="form-control" name="description" placeholder="Description" aria-label="Description" aria-describedby="basic-addon1">
					</div>
					<div class="input-group mb-3">
					  <span class="input-group-text" id="basic-addon1">Features</span>
					  <input type="textarea" class="form-control" name="features" placeholder="Features" aria-label="Features" aria-describedby="basic-addon1">
					</div>

					  <div class="input-group mb-3">
						  <label class="input-group-text" for="inputGroupSelect01">Marcas</label>
						  <select class="form-select" id="inputGroupSelect01" name="brand_id">
						    <option selected>Choose...</option>
						   	<?php		    
							foreach ($marcas as $valor) {
						    echo '<option value="'.$valor->id.','.$valor->name.'" >'.$valor->name.'</option>';
						   	}
						    ?>
						  </select>
						</div>

					<div class="input-group mb-3">
					  <input type="file" class="form-control" id="file" name="file"  accept="image/*" data-max-size="1507459">
					  <label class="input-group-text" for="inputGroupFile02">Upload</label>
					</div>


				

			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-primary">Confirmar</button>
			        <input type="hidden" value="create" name="action">
		        </form>
		      </div>
		    </div>
		  </div>
		</div>

		<?php include "../layouts/scripts.template.php"; ?>

		<script type="text/javascript">
			function remove(target)
			{
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

	</body>
</html>