<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Cliente</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg bg-success">
            <div class="container">
              <a class="navbar-brand" href="/home"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#FFFFFF" class="bi bi-coin" viewBox="0 0 16 16">
                <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518z"/>
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11m0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12"/>
            </svg>
               </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="#"> {{ Auth::user()->name }}</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     Logout
                    </a>
                    <ul class="dropdown-menu">
                      <li><div class="dropdown-item" href="#"> <form action="{{ url('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-danger" type="submit">Logout</button>
                    </form>
                </div>
            </li>
                     
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled">Disabled</a>
                  </li>
                </ul>
                <form class="d-flex" role="search">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
              </div>
            </div>
          </nav>
    </header>


<div class="container mt-5">
    <h1>Agregar Nuevo Cliente</h1>
    <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
       
        <div class="mb-3">
            <label for="nombre_cliente" class="form-label">Nombre Cliente</label>
            <input type="text" class="form-control" name="nombre_cliente" required>
        </div>
        <div class="mb-3">
            <label for="nombre_artistico" class="form-label">Nombre Artístico</label>
            <input type="text" class="form-control" name="nombre_artistico" required>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" name="foto" accept="image/*" required>

        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" name="direccion" required>
        </div>
        <div class="mb-3">
          <label for="numero_telefono" class="form-label">Numero de Telefono </label>
          <input type="text" class="form-control" name="numero_telefono" required>
      </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="Cambiar" value="1" checked>
            <label class="form-check-label" for="Cambiar">¿Permitir Cambios?</label>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>


<script>


let numberSecuential = localStorage.getItem('numberSecuential');
? parseInt(localStorage.getItem('numberSecuential')),
:1


doucument.getElementById('numberSecuential').value= numberSecuential;


</script>
</body>
</html>
