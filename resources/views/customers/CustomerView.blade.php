<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>


    <header>
        <nav class="navbar navbar-expand-lg bg-success">
            <div class="container">
              <a class="navbar-brand" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#FFFFFF" class="bi bi-coin" viewBox="0 0 16 16">
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
    <h3 class="mt-5">Detalles del Cliente</h3>
    <div class="row">
        <div class="col-md-3">
            <div >
                @if($customer->foto)
                <img src="{{ asset('storage/' . $customer->foto) }}" alt="Foto de {{ $customer->nombre_cliente }}" style="max-width: 300px;"/>
                
                @else
                    <img src="https://via.placeholder.com/150" alt="No hay foto disponible" >
                @endif
            </div>
        </div>
        <div class="col-md-3">
          
          
                    <h5 class="card-title mb-2"> Nombre del Cliente: <br>
                        {{ $customer->nombre_cliente }}</h5>
                    <h6 class="card-subtitle mb-2 "> Nombre Artisitico: {{ $customer->nombre_artistico }}</h6>
                    <p class="card-text mb-2 "><strong>Número de Cliente:</strong> {{ $customer->numero_cliente }}</p>
                    <p class="card-text mb-2"><strong>Dirección:</strong> {{ $customer->direccion }}</p>

                    <p class="card-text mb-2">
                        <strong>Cambiar Cheques:</strong> 
                        @if ($customer->Cambiar == 1)
                            Se pueden  cambiar Cheques
                        @else
                            No se puede cambiar
                        @endif
                    </p>
                    <p><strong>Cantidad de Cheques Cambiados:</strong> {{ $cantidadChequesCambiados }}</p>
    <p><strong>Monto Total de Cheques Cambiados:</strong> ${{ number_format($totalChequesCambiados, 2) }}</p>
                </div>
            </div>
        </div>
  
</div>
<div class="container">
    <h4 class="mt-5">Lista de Cambios de Cheques</h4>
</div>

<div class="container mt-5 d mt-5 shadow p-3 mb-5 bg-body-tertiary rounded">


    <table class="table  table-striped-columns ">
        <thead>
            <tr>
                <th>ID</th>
                <th>Monto</th>
                <th>Fecha y Hora</th>
                <th>Número de Cheque</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            @if ($customer->transactions->isEmpty())
                <tr>
                    <td colspan="5" class="text-center">No hay transacciones para este cliente.</td>
                </tr>
            @else
                @foreach ($customer->transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>${{ number_format($transaction->amount, 2) }}</td>
                        <td>{{ $transaction->datetime_field }}</td>
                        <td>{{ $transaction->numero_cheque }}</td>
                        <td>{{ $transaction->description }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

       
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>   

</body>
</html>
