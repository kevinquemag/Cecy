<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cerificado</title>
</head>

<body>

<div class="container">
	<h3 class="mb-5">Carga el archivo xlsx para importar los datos</h3>
         
    <form action="{{ url('certificate/pdf-studentData') }}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="row">
             <div class="col">
                 <input type="file" name="excel" id="" class="form-group">
             </div>
             <div class="col">
                 <input type="submit" value="Importar" class="btn btn-outline-info">
             </div>
        </div>
    </form>
		</div>

		
</body>

</html>