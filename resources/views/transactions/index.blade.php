<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Transacciones</title>
</head>
<body>
<style>
    .pagination .page-link {
        padding: 0.1rem 0.75rem; /* Ajusta el padding según sea necesario */
    }
</style>

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
    <h1>Transacciones</h1>
    <a href="{{ route('transactions.create') }}" class="btn btn-primary mb-3">Crear Transacción</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Formulario de Filtro -->
  <!-- Formulario de Filtro -->
<div class="row mb-4">
    <div class="col-md-4">
        <input type="date" id="filter_date" class="form-control" placeholder="Filtrar por Fecha" value="{{ request('filter_date') ?: now()->format('Y-m-d') }}">
    </div>
    <div class="col-md-4">
        <input type="text" id="filter_pc_name" class="form-control" placeholder="Filtrar por Nombre de PC">
    </div>
    <div class="col-md-4">
        <input type="text" id="filter_user" class="form-control" placeholder="Filtrar por Usuario">
    </div>
</div>
<button class="btn btn-success mb-3" onclick="filterTransactions()">Filtrar</button>
<button class="btn btn-info mb-3" onclick="printReport()">Imprimir Reporte</button>


    <div class="row shadow p-3 mb-5 bg-body-tertiary rounded">
        <div class="col-md-6">
            <h3 class="mt-4">Suma Total por Día</h3>
            <div class="mb-3">
                <table class="table table-bordered" id="total_amounts_table">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Total Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dailyTotals as $date => $total)
                            <tr data-date="{{ $date }}">
                                <td>{{ $date }}</td>
                                <td>${{ number_format($total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <h3 class="mt-4">Total de Comisiones por Día</h3>
            <table class="table table-bordered"  id="total_commissions_table">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Total Comisiones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dailyCommissions as $date => $totalCommission)
                        <tr  data-date="{{ $date }}">
                            <td>{{ $date }}</td>
                            <td>${{ number_format($totalCommission, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        
        </div>
      
      
    </div>

    <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
        <h2 class="mt-4">Lista de Transacciones</h2>
        <table class="table table-striped" id="transactions_table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Usuario</th>
                    <th>PC Name</th>
                    <th>Monto</th>
                    <th>Descripción</th>
                    <th>Comisión</th>
                    <th>Total Pagar </th>
                    <th>Número de Cheque</th>
                    <th>Fecha y Hora</th>
                    <th>Cantidad de Cheques</th>
                    <th>Total Comisión</th>
                    <th>Total a pagar </th>
                    <th>Total Monto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->customer->nombre_cliente }}</td>
                        <td>{{ $transaction->user->name }}</td>
                        <td>{{ $transaction->pc_name }}</td>
                        <td>${{ number_format((float)$transaction->amount, 2) }}</td>
                        <td>{{ $transaction->description }}</td>
                        <td>${{ number_format((float)$transaction->comision, 2) }}</td>
                        <td>${{ number_format((float)$transaction->ganancia, 2) }}</td>
                        <td>{{ $transaction->numero_cheque }}</td>
                        <td>{{ $transaction->datetime_field }}</td>
                        <td>{{ $transaction->cantidad_cheques }}</td>
                        <td>${{ number_format((float)$transaction->total_comision, 2) }}</td>
                        <td>${{ number_format((float)$transaction->total_ganancias, 2) }}</td>
                        <td>${{ number_format((float)$transaction->total_monto, 2) }}</td>
                    </tr>
                @endforeach
               
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="mt-4">
            {{ $transactions->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>

function filterTransactions() {
    const dateFilter = document.getElementById('filter_date').value;

    // Verifica si se ha seleccionado una fecha y redirige con el parámetro
    if (dateFilter) {
        window.location.href = window.location.pathname + '?filter_date=' + dateFilter;
    } else {
        // Si no hay fecha, redirige sin el filtro
        window.location.href = window.location.pathname;
    }
}

function printReport() {
    const printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write('<html><head><title>Reporte de Transacciones</title>');
    printWindow.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">');
    printWindow.document.write('</head><body>');
    printWindow.document.write('<h1>Reporte de Transacciones</h1>');
    
    // Seleccionar las tres tablas por sus ID
    const transactionsTable = document.getElementById('transactions_table').cloneNode(true);
    const totalAmountsTable = document.getElementById('total_amounts_table').cloneNode(true);
    const totalCommissionsTable = document.getElementById('total_commissions_table').cloneNode(true);
    
    // Escribir las tablas en la ventana de impresión
    printWindow.document.write('<h2>Lista de Transacciones</h2>');
    printWindow.document.write(transactionsTable.outerHTML);

    printWindow.document.write('<h2>Suma Total por Día</h2>');
    printWindow.document.write(totalAmountsTable.outerHTML);

    printWindow.document.write('<h2>Total de Comisiones por Día</h2>');
    printWindow.document.write(totalCommissionsTable.outerHTML);

    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}


</script>
</body>
</html>
