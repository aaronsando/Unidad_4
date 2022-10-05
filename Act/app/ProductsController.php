<?php
session_start();

	if (isset($_POST['action'])) {
	switch ($_POST['action']) {
		case 'create':
			
			$ProductsController = new ProductsController();
			$brand = $_POST['brand_id'];
			$brand_explode = explode(',', $brand);
			$brand_id=$brand_explode[0];
			$brand_name=$brand_explode[1];
			$name = strip_tags($_POST['name']);
			$slug = strip_tags($_POST['slug']);
			$description = strip_tags($_POST['description']);
			$features = strip_tags($_POST['features']);
			
			
			
			$ProductsController->createProduct($name,$slug,$description,$features,$brand_id,$brand_name);

		break; 
	}
}

	Class ProductsController{
		 public function cargar($token){
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'http://crud.jonathansoto.mx/api/products',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			  CURLOPT_HTTPHEADER => array(
			  'Authorization: Bearer '.$token.'',
            'Cookie: XSRF-TOKEN=eyJpdiI6ImdWbDVRYjBzOEJTRzNvVERrejNmUFE9PSIsInZhbHVlIjoiYzlaM1EyRXBSSit5dzdOV2RzRHNkc2JVRjArZGZ2Q2lCZVM1ejJFMmRsSFdtTkFpNUJyblpoMEdiV002NEpoUUVDSkdvNGtxeXp5YlNFa2dwK3FrRDV0bFZXR0NNQ01qcTdkY0pqZElodDNyc0tZNEpMcEdrNllFRk1IMXBINnEiLCJtYWMiOiI3YzYxMWIxZGM5MDZjMTlhMDMwZjhjOWJiN2Y2ZmJjNzJlNmEwZDViZGMwODRmMDRiNzBkYWJkZDQxOTc5MzdhIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlhyL0dwZWxTL3MxbHU5Zk1FVTBId3c9PSIsInZhbHVlIjoiM3UzU1BocUFDZjhjUlhiM2hldElPM0RrQWxFdm1DSnh2Q1FjYnoyOTNLa1BFeW1CbWVoSmpZR05abHZMQVJ6NXBLWGZaalNtc3VwMkovdE5lYWY5dzhLOXZXaVFhNlBrdGFuMXdndVA4WWJLQmQ3SkN0cS8yc0RNajY3NFExNFQiLCJtYWMiOiI5MzIxZjZiODczMzY2YTNjYWQzZGZkNTNjNDUxMDRkNTliZWMzMjY5ZDdhNmI0OGYyNjdkNjRjNTFkZGRkYTc2IiwidGFnIjoiIn0%3D'
        ),

		));

			$response = curl_exec($curl);
			curl_close($curl);
			$response = json_decode($response);
			return $response->data;

		}
		public function createProduct($name,$slug,$description,$features,$brand_id,$brand_name)
		{

			$cover = $_FILES['file']['tmp_name'];
			$curl = curl_init();
			
			
			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS => array('name' => $name,'slug' => $slug,'description' => $description,'features' => $features,'brand_id'=>$brand_id,'brand_name' =>$brand_name,
			  	'cover'=> new CURLFILE($cover)
			 
			),
			  CURLOPT_HTTPHEADER => array(
			  'Authorization: Bearer '.$_SESSION['token'].''
        ),
			));
			$response = curl_exec($curl);

	        curl_close($curl);
	        $response = json_decode($response);
			if( isset($response->code) && $response->code > 0) {
			
			    header("Location:../products");
			

			
		}else{


			#var_dump($response);
			header("Location:../?error=true");
		}
		}

		public function cargarMarcas()
		{
			  $curl = curl_init();
			  curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://crud.jonathansoto.mx/api/brands',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			  CURLOPT_HTTPHEADER => array(
			  'Authorization: Bearer '.$_SESSION['token'].'',
			  'Cookie: XSRF-TOKEN=eyJpdiI6ImdWbDVRYjBzOEJTRzNvVERrejNmUFE9PSIsInZhbHVlIjoiYzlaM1EyRXBSSit5dzdOV2RzRHNkc2JVRjArZGZ2Q2lCZVM1ejJFMmRsSFdtTkFpNUJyblpoMEdiV002NEpoUUVDSkdvNGtxeXp5YlNFa2dwK3FrRDV0bFZXR0NNQ01qcTdkY0pqZElodDNyc0tZNEpMcEdrNllFRk1IMXBINnEiLCJtYWMiOiI3YzYxMWIxZGM5MDZjMTlhMDMwZjhjOWJiN2Y2ZmJjNzJlNmEwZDViZGMwODRmMDRiNzBkYWJkZDQxOTc5MzdhIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlhyL0dwZWxTL3MxbHU5Zk1FVTBId3c9PSIsInZhbHVlIjoiM3UzU1BocUFDZjhjUlhiM2hldElPM0RrQWxFdm1DSnh2Q1FjYnoyOTNLa1BFeW1CbWVoSmpZR05abHZMQVJ6NXBLWGZaalNtc3VwMkovdE5lYWY5dzhLOXZXaVFhNlBrdGFuMXdndVA4WWJLQmQ3SkN0cS8yc0RNajY3NFExNFQiLCJtYWMiOiI5MzIxZjZiODczMzY2YTNjYWQzZGZkNTNjNDUxMDRkNTliZWMzMjY5ZDdhNmI0OGYyNjdkNjRjNTFkZGRkYTc2IiwidGFnIjoiIn0%3D'
			)));

			$response = curl_exec($curl);
			curl_close($curl);
			$response = json_decode($response);
			return $response->data;
		}

		public function cargarDetalles($slug)
		{
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/slug/'.$slug.'',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			  CURLOPT_HTTPHEADER => array(
			  'Authorization: Bearer '.$_SESSION['token'].'')

			));

			$response = curl_exec($curl);
			curl_close($curl);
			$response = json_decode($response);
			return $response->data;
			
			}
		}
?>