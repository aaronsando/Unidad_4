<?php include "../app/config.php"; ?>
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
							require '../app/BrandsController.php'; 
							$token = strip_tags($_SESSION['token']);
							$clase = new ProductsController();
							$claseMarcas = new BrandsController();
							$marcas = $claseMarcas->cargarMarcas(); 
							$array = $clase->cargar($token); 
							foreach ($array as $valor): ?> 
								<div class="col-md-3 col-sm-10 p-2">
								
								<div class="card mb-1" >
								  <img src="<?=$valor->cover?>" class="card-img-top img-fluid" alt="...">
								  <div class="card-body">
								    <h5 class="card-title text-center">
								    	<?= $valor->name?>
								    </h5>
								    <p class="card-text">
								    	<?= $valor->description?>
								    </p>
								    <p class="card-text">
								    	<?=$valor->brand->name?>
								    </p>
								    <div class="row">
								    	<a href="#" data-product='<?= json_encode($valor) ?>' data-bs-toggle="modal" data-bs-target="#createProductModal" class="btn btn-warning col-6" onclick='editProduct(this)'>
									    	Editar
									    </a>
									    <a onclick="remove(<?= $valor->id?>)" href="#" class="btn btn-danger col-6">
									    	Eliminar
									    </a>
									    <a href="<?=BASE_PATH?>products/details/<?=$valor->slug ?>/" class="btn btn-info col-12">
									    	Detalles
									    </a>
								    </div>
								  </div>
								</div>


							</div>
						<?php endforeach; ?>
							
						
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
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="addProduct()"></button>
		      </div>
		      <div class="modal-body">
		        
		        <form method="post" action="<?=BASE_PATH?>prods" class="form" enctype="multipart/form-data">

			      	<div class="input-group mb-3">
					  <span class="input-group-text" id="basic-addon1">Name</span>
					  <input type="text" class="form-control" id="name" name="name" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1">
					</div>

					<div class="input-group mb-3">
					  <span class="input-group-text" id="basic-addon1">Slug</span>
					  <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" aria-label="Slug" aria-describedby="basic-addon1">
					</div>

					<div class="input-group mb-3">
					  <span class="input-group-text"  id="basic-addon1">Description</span>
					  <input type="textarea" class="form-control" id="description" name="description" placeholder="Description" aria-label="Description" aria-describedby="basic-addon1">
					</div>

					<div class="input-group mb-3">
					  <span class="input-group-text" id="basic-addon1">Features</span>
					  <input type="textarea" class="form-control" id="features" name="features" placeholder="Features" aria-label="Features" aria-describedby="basic-addon1">
					</div>

					  <div class="input-group mb-3">
						  <label class="input-group-text" for="inputGroupSelect01">Marcas</label>
						  <select class="form-select" id="inputGroupSelect01" id="brand_id" name="brand_id">
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
			        <input type="hidden" name="id" id="id" value="">
         			<input type="hidden" id="action" name="action" value="create">
         			<input type="hidden" name="global_token" value="<?= $_SESSION['global_token']?>">
		        </form>
		      </div>
		    </div>
		  </div>
		</div>
<!--uWV9K24K5a&0Rk -->
		<?php include "../layouts/scripts.template.php"; ?>

		<script type="text/javascript">

			function addProduct(){
				document.getElementById('action').value = "create";
			}

			function editProduct(target){
			    
			    document.getElementById('action').value = "edit";

			    let product =JSON.parse(target.getAttribute('data-product'));
			    
			    document.getElementById('name').value = product.name;
			    document.getElementById('slug').value = product.slug;
			    document.getElementById('description').value = product.description;
			    document.getElementById('features').value = product.features;
			    document.getElementById('brand_id').value = product.brand_id;
			    document.getElementById('id').value = product.id;
			}


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
				  	const data = new FormData();
				      data.append("id", target);
				      data.append("action", "delete");
				      data.append("global_token",'<?= $_SESSION['global_token']?>');
				      axios.post('<?=BASE_PATH?>prods', data)
				      .then(function (response) {
				      	swal("Poof! Your imaginary file has been deleted!", {
					      icon: "success",
					    });
				        location.reload();
				      })
				      .catch(function (error) {
				        console.log(error);
				      });
				    
				  } else {
				    swal("Your imaginary file is safe!");
				  }
				});
			}
		</script>

	</body>
</html>