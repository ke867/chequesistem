<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Transacción {{ $transaction->id }}</title>
    <style>
        @media print {
            body {
                -webkit-print-color-adjust: exact; /* Para asegurar que los colores se impriman */
            }
            .no-print {
                display: none; /* Ocultar elementos que no se deben imprimir */
            }
        }
    </style>
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
<div class="container mt-5">
    <h2 class="text-center">Detalles de la Transacción</h2>
    <div class="card mb-4">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $transaction->id }}</p>
            <p><strong>Cliente:</strong> {{ $transaction->customer->nombre_cliente }}</p>
            <p><strong>Usuario:</strong> {{ $transaction->user->name }}</p>
            <p><strong>Monto:</strong> ${{ number_format($transaction->amount, 2) }}</p>
            <p><strong>Descripción:</strong> {{ $transaction->description }}</p>
            <p><strong>Comisión:</strong> ${{ number_format($transaction->comision, 2) }}</p>
            <p><strong>Ganancia:</strong> ${{ number_format($transaction->ganancia, 2) }}</p>
            <p><strong>Número de Cheque:</strong> {{ $transaction->numero_cheque }}</p>
            <p><strong>Fecha y Hora:</strong> {{ $transaction->datetime_field }}</p>
            <p><strong>Cantidad de Cheques:</strong> {{ $transaction->cantidad_cheques }}</p>
            <p><strong>Total Comisión:</strong> ${{ number_format($transaction->total_comision, 2) }}</p>
            <p><strong>Total Ganancias:</strong> ${{ number_format($transaction->total_ganancias, 2) }}</p>
            <p><strong>Total Monto:</strong> ${{ number_format($transaction->total_monto, 2) }}</p>
        </div>
    </div>
    <div class="text-center no-print">
        <a href="{{ route('transactions.index') }}" class="btn btn-primary">Volver a Transacciones</a>
    </div>
</div>

<script>
    window.onload = function() {
        window.print();
       
    };
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
