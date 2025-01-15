<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Customer; // Asegúrate de importar el modelo Customer
use App\Models\User; // Asegúrate de importar el modelo User
use Illuminate\Http\Request;
use Carbon\Carbon;
class TransactionController extends Controller
{
    public function index(Request $request)
    {
        // Recuperar la fecha de filtro, si está presente
        $filterDate = $request->input('filter_date');
    
        // Cargar las transacciones con sus clientes y usuarios, y aplicar el filtro si es necesario
        $transactions = Transaction::with(['customer', 'user'])
            ->when($filterDate, function ($query, $filterDate) {
                return $query->whereDate('datetime_field', $filterDate);
            })
            ->paginate(10);
    
        // Calcular los totales por día
        $dailyTotals = $transactions->groupBy(function ($transaction) {
            return \Carbon\Carbon::parse($transaction->datetime_field)->format('d-m-y');
        })->map(function ($group) {
            return $group->sum('amount');
        });
        
        // Calcular las comisiones totales por día
        $dailyCommissions = $transactions->groupBy(function ($transaction) {
            return \Carbon\Carbon::parse($transaction->datetime_field)->format('d-m-y');
        })->map(function ($day) {
            return $day->sum('comision');
        });
    
        // Calcular el total de comisiones
        $totalCommissions = $transactions->sum('comision');
    
        // Pasar los datos a la vista
        return view('transactions.index', compact('transactions', 'dailyTotals', 'dailyCommissions', 'totalCommissions'));
    }
    public function create()
    {
        $fecha = Carbon::now();
        $fechaFormateada= $fecha->format('y-m-d');

        

        $customers = Customer::all(); // Obtener todos los clientes
        $users = User::all(); // Obtener todos los usuarios
        return view('transactions.create', compact('customers', 'users','fechaFormateada',)); // Pasar ambos a la vista
    }

    public function store(Request $request)
    {
        

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            'description' => 'nullable|string|max:255',
            'pc_name' => 'required|string|max:255',
            'comision' => 'nullable|numeric',
            'ganancia' => 'nullable|numeric',
            'numero_cheque' => 'nullable|string|max:50',
            'datetime_field' => 'required|date',
            'cantidad_cheques' => 'nullable|integer|min:0',
            'total_comision' => 'nullable|numeric',
            'total_ganancias' => 'nullable|numeric',
            'total_monto' => 'nullable|numeric',
        ]);

        $transaction = Transaction::create($request->all());
        return redirect()->route('transactions.create', $transaction->id);
    }

    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }
    






    public function edit(Transaction $transaction)
    {
        $customers = Customer::all();
        $users = User::all();
        return view('transactions.edit', compact('transaction', 'customers', 'users'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            'description' => 'nullable|string|max:255',
            'pc_name' => 'required|string|max:255',
            'comision' => 'nullable|numeric',
            'ganancia' => 'nullable|numeric',
            'numero_cheque' => 'nullable|string|max:50',
            'datetime_field' => 'required|date',
            'cantidad_cheques' => 'nullable|integer|min:0',
            'total_comision' => 'nullable|numeric',
            'total_ganancias' => 'nullable|numeric',
            'total_monto' => 'nullable|numeric',
        ]);

        $transaction->update($request->all());
        return redirect()->route('transactions.index')->with('success', 'Transacción actualizada con éxito.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transacción eliminada con éxito.');
    }
}
