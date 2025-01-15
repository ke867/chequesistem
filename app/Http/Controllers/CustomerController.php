<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Mostrar todos los clientes
    public function index(Request $request)
    {
        // Obtener el valor del filtro de nombre del cliente desde la solicitud
        $nombre_cliente = $request->input('nombre_cliente');
    
        // Iniciar la consulta de clientes
        $customers = Customer::query();
    
        // Si se proporciona un filtro de nombre, lo aplicamos
        if ($nombre_cliente) {
            $customers->where('nombre_cliente', 'like', '%' . $nombre_cliente . '%');
        }
    
        // Ejecutar la consulta y obtener los resultados
        $customers = $customers->get();
    
        // Retornar la vista con los clientes filtrados
        return view('customers.show', compact('customers'));
    }

    // Mostrar el formulario para crear un nuevo cliente
    public function create()
    {

        return view('customers.CreateCustomer');

        
    }

    // Almacenar un nuevo cliente
    public function store(Request $request)
{
    $request->validate([
        'nombre_cliente' => 'required|string|max:255',
        'nombre_artistico' => 'required|string|max:255',
        'foto' => 'nullable|image|max:2048',
        'Cambiar' => 'boolean',
        'direccion' => 'required|string|max:255',
        'numero_telefono' => 'required|string|max:25'
    ]);

    // Manejar la subida de la imagen
    $path = null;

    if ($request->hasFile('foto')) {
        $path = $request->file('foto')->store('fotos', 'public'); // Guardar en public
    }

    // Obtener el último número de cliente y aumentar en uno
    $ultimoCliente = Customer::orderBy('numero_cliente', 'desc')->first();
    $nuevoNumeroCliente = $ultimoCliente ? $ultimoCliente->numero_cliente + 1 : 1; // Comienza en 1 si no hay clientes

    // Crear el cliente, asegurando que el campo 'foto' se almacene correctamente
    $customerData = $request->all();
    $customerData['numero_cliente'] = $nuevoNumeroCliente; // Asignar el nuevo número de cliente
    $customerData['foto'] = $path; // Asegura que 'foto' tenga la ruta

    Customer::create($customerData);

    return redirect()->route('customers.index')->with('success', 'Cliente creado con éxito.');
}
    

    // Mostrar un cliente específico
    public function show(Customer $customer)
    {

        $transactions = $customer->transactions;
        $customer->load('transactions');

        $cambiosDeCheques = $customer->transactions->where('cantidad_cheques', '>', 0);
        $totalChequesCambiados = $cambiosDeCheques->sum('amount');
        $cantidadChequesCambiados = $cambiosDeCheques->count();
    
        return view('customers.CustomerView', compact('customer', 'cantidadChequesCambiados', 'totalChequesCambiados'));
       
    }

    // Mostrar el formulario para editar un cliente
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    // Actualizar un cliente
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'numero_cliente' => 'required|integer',
            'nombre_cliente' => 'required|string|max:255',
            'nombre_artistico' => 'required|string|max:255',
            'foto' => 'nullable|string|max:255',
            'Cambiar' => 'boolean',
            'direccion' => 'required|string|max:255',
        ]);

        $customer->update($request->all());
        return redirect()->route('customers.index')->with('success', 'Cliente actualizado con éxito.');
    }


    public function updateStatus(Request $request, Customer $customer)
{
    $request->validate([
        'Cambiar' => 'required|boolean',
    ]);

    $customer->Cambiar = $request->Cambiar;
    $customer->save();

    return response()->json(['success' => 'Estado actualizado.']);
}

    // Eliminar un cliente
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Cliente eliminado con éxito.');
    }
}
