<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>

    <style>


        .checkbox-container {
            display: flex;
            align-items: center;
        }
    
        .change-checkbox {
            display: none; /* Ocultamos el checkbox original */
        }
    
        .checkbox-label {
           
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
    
        .checkbox-label.checked {
            background-color: green;
            color: white;
            width: 120px
        }
    
        .checkbox-label.unchecked {
            background-color: red;
            color: white;
            width: 120px
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
    
    <h1>Lista de Clientes</h1>
    <form method="GET" action="{{ route('customers.index') }}">
        <div class="col-md-3 mb-3">
            <label for="nombre_cliente">Nombre del cliente:</label>
            <input type="text" class="form-control col-md-3" id="nombre_cliente" name="nombre_cliente" value="{{ request()->input('nombre_cliente') }}">
        </div>
        
        <button type="submit" class="btn btn-primary  ">Filtrar</button>
    </form>
    <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3 mt-5" id="delete">Agregar Nuevo Cliente</a>
    <table class="table">
        <thead>
            <tr>
            
                <th>Número de Cliente</th>
                <th>Nombre Cliente</th>
                <th>Nombre Artístico</th>
                <th>Dirección</th>
                <th>Número Telefono</th>
                <th>Cambiar Cheques </th>
                <th>ver </th>
                <th>Editar </th>
                <th>Eliminar </th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                
                <td>{{ $customer->numero_cliente }}</td>
                <td>{{ $customer->nombre_cliente }}</td>
                <td>{{ $customer->nombre_artistico }}</td>
                <td>{{ $customer->direccion }}</td>
                <td>{{ $customer->numero_telefono }}</td>
                <td> 
                    <input type="checkbox" class="change-checkbox text-center" id="checkbox-{{ $customer->id }}" data-id="{{ $customer->id }}" {{ $customer->Cambiar ? 'checked' : '' }}>
                    <label class="checkbox-label {{ $customer->Cambiar ? 'checked' : 'unchecked' }}" for="checkbox-{{ $customer->id }}">
                        {{ $customer->Cambiar ? 'Cambio ' : 'No Cambiar' }}
                    </label>                </td>
                <td>
                    <a href="{{ route('customers.show', $customer) }}" class="btn btn-info">Ver</a>
                
                   
                </td>

                <td>
                    <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning">Editar</a>
                </td>

                <td>
                    <form action="{{ route('customers.destroy', $customer) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="deleteUser()" id="delete" type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('.change-checkbox').change(function() {
            const customerId = $(this).data('id');
            const isChecked = $(this).is(':checked');
            const label = $(this).next('.checkbox-label');

            // Cambiar el color y texto del label
            if (isChecked) {
                label.addClass('checked').removeClass('unchecked');
                label.text('Se puede Cambiar Cheques');
            } else {
                label.addClass('unchecked').removeClass('checked');
                label.text('No se puede Cambiar');
            }

            // Hacer la solicitud AJAX
            $.ajax({
                url: `/customers/${customerId}/update-status`,
                method: 'PUT',
                data: {
                    Cambiar: isChecked ? 1 : 0,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('Estado actualizado con éxito.');
                },
                error: function() {
                    alert('Error al actualizar el estado.');
                }
            });
        });
    });
    function deleteUser() {
    const button = document.getElementById("delete");

    const confirmDelete = confirm("¿Desea Eliminar este usuario ?")

    if (confirmDelete) {
        alert("Usuario Eliminado con Exito ")
    }else{
        alert("Eliminarcion de usuario Cancelada")
    }


}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>   

</body>
</html>
