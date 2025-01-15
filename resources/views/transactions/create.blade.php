<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Crear Transacción</title>
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

    <div class="container mt-5 shadow p-4 mb-5 bg-body rounded">
        <h1 class="mb-4">Crear Transacción</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="customer_number" class="form-label">Número de Cliente:</label>
                    <input type="text" id="customer_number" class="form-control" oninput="filterCustomer()" placeholder="Ingrese el número de cliente">
                </div>
                <div class="col-md-6">
                    <label for="customer_id" class="form-label">Cliente:</label>
                    <select name="customer_id" id="customer_id" class="form-select" required>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" data-number="{{ $customer->numero_cliente }}">{{ $customer->nombre_cliente }}</option>
                        @endforeach
                    </select>

                   
                </div>
            </div>
            <div class="col-md-6">
                <label for="user_id" class="form-label" hidden>Usuario:</label>
                <input name="user_id" id="user_id" class="form-select" required value="{{ Auth::user()->id }}" readonly hidden/>
            </div>
            <div class="mb-3">
                <label for="numero_cheque" class="form-label">Número de Cheque:</label>
                <input type="text" name="numero_cheque" id="numero_cheque" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Monto:</label>
                <input type="text" name="amount" id="monto" class="form-control" oninput="calculateCommission()" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Maker:</label>
                <input type="text" name="description" class="form-control">
            </div>
            <div class="mb-3">
                <label for="pc_name" class="form-label" >Nombre de la PC:</label>
                <select name="pc_name" class="form-select" required>
                    <option name="pc_name" value="PC1">PC1</option>
                    <option name="pc_name" value="PC2">PC2</option>
                </select>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="comision" class="form-label">Comisión:</label>
                    <input type="text" name="comision" id="comision" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <label for="ganancia" class="form-label">Total a pagar:</label>
                    <input type="text" name="ganancia" id="ganancia" class="form-control" readonly>
                </div>
            </div>
         
            <div class="mb-3">
            
                <label for="datetime_field" class="form-label">Fecha y Hora:</label>
                <input  name="datetime_field" class="form-control" required  value="{{ $fechaFormateada }}" readonly >
            </div>
            <div class="mb-3">
                <label for="cantidad_cheques" class="form-label" hidden>Cantidad de Cheques:</label>
                <input type="number" name="cantidad_cheques" hidden id="cantidad_cheques" min="0" value="1" class="form-control" oninput="calculateCommission()">
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="total_comision" class="form-label">Total Comisión:</label>
                    <input type="text" name="total_comision" id="total_comision" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <label for="total_ganancias" class="form-label">Total a pagar:</label>
                    <input type="text" name="total_ganancias" id="total_ganancias" class="form-control" readonly>
                </div>
            </div>
            <div class="mb-3">
                <label for="total_monto" class="form-label">Total Monto:</label>
                <input type="text" name="total_monto" id="total_monto" class="form-control" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
    </div>

    <script>
document.addEventListener("DOMContentLoaded", function() {
    // Evento de "keydown" en el campo "Número de Cliente"
    document.getElementById('customer_number').addEventListener('keydown', function(event) {
        if (event.key === 'Tab') {
            // Verificar si el foco está en el campo "Número de Cliente"
            if (document.activeElement.id === 'customer_number') {
                // Prevenir el comportamiento predeterminado de tabulación
                event.preventDefault();

                // Cambiar el foco al campo "Número de Cheque"
                document.getElementById('numero_cheque').focus();
            }
        }
    });
});


        function filterCustomer() {
            const customerNumber = document.getElementById('customer_number').value.toLowerCase();
            const select = document.getElementById('customer_id');
            const options = Array.from(select.options);

            // Resetear la selección
            select.selectedIndex = -1;

            options.forEach(option => {
                const number = option.getAttribute('data-number').toLowerCase();
                if (number.includes(customerNumber)) {
                    select.value = option.value; // Establecer el cliente si coincide
                }
            });
        }

        function calculateCommission() {
            const amount = parseFloat(document.getElementById('monto').value) || 0;
            const cantidadCheques = parseInt(document.getElementById('cantidad_cheques').value) || 0;
            let commission = 0;

            if (amount >= 1 && amount <= 1000) {
                commission = amount * 0.01;
            } else if (amount >= 1001 && amount <= 1999) {
                commission = amount * 0.015;
            } else if (amount >= 2000 && amount <= 2999) {
                commission = amount * 0.02;
            } else if (amount >= 3000 && amount <= 3999) {
                commission = amount * 0.03;
            } else if (amount >= 4000 && amount <= 4999) {
                commission = amount * 0.04;
            } else if (amount >= 5000) {
                commission = amount * 0.05;
            }

            const cents = Math.round(commission * 100);
            commission = (cents >= 70) ? Math.ceil(commission) : Math.floor(commission);
            document.getElementById('comision').value = commission.toFixed(2);

            const ganancia = amount - commission; 
            document.getElementById('ganancia').value = ganancia.toFixed(2);
            document.getElementById('total_comision').value = (commission * cantidadCheques).toFixed(2);
            document.getElementById('total_ganancias').value = (ganancia * cantidadCheques).toFixed(2);
            document.getElementById('total_monto').value = (amount * cantidadCheques).toFixed(2);
        }
        document.addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
            event.preventDefault(); // Evita que el Enter envíe el formulario
        }
    });


    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
