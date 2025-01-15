<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction1'; // Especifica el nombre de la tabla

    protected $fillable = [
        'customer_id',
        'user_id',
        'amount',
        'description',
        'pc_name',
       'comision',
        'ganancia',
        'numero_cheque',
        'datetime_field',
        'cantidad_cheques',
        'total_comision',
        'total_ganancias',
        'total_monto',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    
}
