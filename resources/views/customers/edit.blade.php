<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
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
                    <a class="nav-link active text-white" aria-current="page" href="/home">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="/transactions">Transacciones</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="/customers">Clientes</a>
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



<div class="container">
    <h2>Actualizar Cliente</h2>

    <!-- Mostrar mensaje de éxito si existe -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario de actualización del cliente -->
    <form action="{{ route('customers.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Campo: Número de cliente -->
        <div class="mb-3">
            <label for="numero_cliente" class="form-label">Número de Cliente</label>
            <input type="text" class="form-control @error('numero_cliente') is-invalid @enderror" id="numero_cliente" name="numero_cliente" value="{{ old('numero_cliente', $customer->numero_cliente) }}">
            @error('numero_cliente')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo: Nombre del cliente -->
        <div class="mb-3">
            <label for="nombre_cliente" class="form-label">Nombre del Cliente</label>
            <input type="text" class="form-control @error('nombre_cliente') is-invalid @enderror" id="nombre_cliente" name="nombre_cliente" value="{{ old('nombre_cliente', $customer->nombre_cliente) }}">
            @error('nombre_cliente')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo: Nombre artístico -->
        <div class="mb-3">
            <label for="nombre_artistico" class="form-label">Nombre Artístico</label>
            <input type="text" class="form-control @error('nombre_artistico') is-invalid @enderror" id="nombre_artistico" name="nombre_artistico" value="{{ old('nombre_artistico', $customer->nombre_artistico) }}">
            @error('nombre_artistico')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo: Foto (opcional) -->
        <div class="mb-3">
            <label for="foto" class="form-label">Foto (opcional)</label>
            <input type="text" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" value="{{ old('foto', $customer->foto) }}">
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo: Dirección -->
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion" name="direccion" value="{{ old('direccion', $customer->direccion) }}">
            @error('direccion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo: Cambiar Foto -->
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="Cambiar" name="Cambiar" value="1" {{ old('Cambiar', $customer->Cambiar) ? 'checked' : '' }}>
            <label class="form-check-label" for="Cambiar">Cambiar Foto</label>
        </div>

        <!-- Botón de envío -->
        <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

</body>
</html>