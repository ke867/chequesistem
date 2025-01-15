<!DOCTYPE html>
<html>
<head>
    <title>Create Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function calculateCommission() {
            const amount = parseFloat(document.getElementById('monto').value);
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
            } else if (amount >= 5000 && amount <= 5999) {
                commission = amount * 0.05;
            }

            // Round commission
            const cents = Math.round(commission * 100);
            commission = (cents >= 70) ? Math.ceil(commission) : Math.floor(commission);

            document.getElementById('comision').value = commission.toFixed(2);
        }
    </script>
</head>
<body>
<div class="container mt-5">
    <h1>Create Customer</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="numero_cliente" class="form-label">Numero Cliente</label>
            <input type="text" name="numero_cliente" class="form-control" id="numero_cliente" required>
        </div>
        <div class="mb-3">
            <label for="nombre_cliente" class="form-label">Nombre Cliente</label>
            <input type="text" name="nombre_cliente" class="form-control" id="nombre_cliente" required>
        </div>
        <div class="mb-3">
            <label for="nombre_artistico" class="form-label">Nombre Artístico</label>
            <input type="text" name="nombre_artistico" class="form-control" id="nombre_artistico" required>
        </div>
        <div class="mb-3">
            <label for="numero_de_cheque" class="form-label">Número de Cheque</label>
            <input type="number" name="numero_de_cheque" class="form-control" id="numero_de_cheque" required>
        </div>
        <div class="mb-3">
            <label for="monto" class="form-label">Monto</label>
            <input type="number" step="0.01" name="monto" class="form-control" id="monto" required oninput="calculateCommission()">
        </div>
        <div class="mb-3">
            <label for="comision" class="form-label">Comisión</label>
            <input type="text" name="comision" class="form-control" id="comision" readonly>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" name="foto" class="form-control" id="foto" required>
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control" id="direccion" required>
        </div>
        <div class="mb-3">
            <label for="fecha_cheque" class="form-label">Fecha de Cheque</label>
            <input type="date" name="fecha_cheque" class="form-control" id="fecha_cheque" required>
        </div>
        <div class="mb-3">
            <label for="hora" class="form-label">Hora</label>
            <input type="time" name="hora" class="form-control" id="hora" required>
        </div>
        <div class="mb-3">
            <label for="user_id" class="form-label">User ID</label>
            <input type="number" name="user_id" class="form-control" id="user_id" required>
        </div>
        <div class="mb-3">
            <label for="nombre_pc" class="form-label">Nombre PC</label>
            <input type="text" name="nombre_pc" class="form-control" id="nombre_pc" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
</body>
</html>
