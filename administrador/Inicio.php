<!doctype html>
<html lang="en">

<head>
  <title>Administrador Veterinaria</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <header>
    <!-- place navbar here -->

    
  </header>
  <main>
  <div class="container">
        <div class="row">

        <div class="col-md-4"><!--centralizo--->

        </div>
        
            <div class="col-md-4">
            <br><br><br>   
            <form action="seccion/validar.php" method= "post">
              <div class="card" >
                <div class="card-header">
                    Inicio de Sesion
                </div>

                <div class="card-body">

                   <form method= >
                   <div class = "form-group">
                   <label >Usuario</label>
                   <input type="text" class="form-control" name="usuario" aria-describedby="nombre" 
                   placeholder="Usuario">
                   <small id= "helpId" class= "form-text text-muted">Escriba su usuario </small>
                   </div>

                   <div class="form-group">
                   <label for="exampleInputPassword1">Contraseña:</label>
                   <input type="password" class="form-control" name="password" placeholder="Contraseña">
                   <small id= "helpId" class= "form-text text-muted">Escriba su Contraseña </small>
                   </div>

                  <br>
                   <button type="submit" class="btn btn-primary">Entrar</button>
                   </form>
                   
                   
                </div>
                </form>
              </div>
            
            </div>
            
        </div>
    </div>  
  
  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>