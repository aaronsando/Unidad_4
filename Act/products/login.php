<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Acceso al panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

	<link href="main.css" rel="stylesheet" type="text/css"v=1>
    <script>
        tailwind.config = {
          theme: {
            container: {
                center: true,
            },
            extend: {
              colors: {
                clifford: '#da373d',
              }
            }
          }
        }
      </script>
</head>
<body>
	<div class="container-fluid">
        <div class="row align-items-center d-flex justify-content-center">
            <div class="col-2"> 
                <form action="../app/AuthController.php" method="POST" name="iniciarsesion">
                    <fieldset>
                        <legend>
                            Datos de acceso
                        </legend>
                        <label class="form-label">
                            Email:
                        </label>
                        <input type="text" name="email" class="form-control form-control-lg">
                        <label class="form-label">
                            Password;
                        </label>
                        <input type="password" name="password" class="form-control form-control-lg">
                        <button type="submit" class="btn btn-outline-primary">Acceder</button>
                    </fieldset>
                </form>
        </div>

        </div>
        <?php
            if (isset($_POST['iniciarsesion'])) {
		
                if($_POST['email'] == '' or $_POST['password'] == ''){
        
                         echo "<script>
                        alert('Por favor ingrese todos los datos');
                        window.location= 'iniciarsesion.php'
                            </script>";
        
                }else{
                        $authController= new AuthController();
                        $email = strip_tags($_POST['email']);
                        $password = strip_tags($_POST['password']);
                        $authController->login($email,$password);
                    
                    }
            }
        ?>

	</div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>