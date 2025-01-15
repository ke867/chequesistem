<?php

namespace App\Models;

// App\Models\Customer.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Desactiva el seguimiento de tiempo
    public $timestamps = false;

    // Definir atributos asignables
    protected $fillable = [
        'numero_cliente',
        'nombre_cliente',
        'nombre_artistico',
        'foto',
        'direccion',
        'Cambiar',
        'numero_telefono'
    ];


    

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($customer) {
            // Obtener el último número de cliente y aumentar en 1
            $lastCustomer = self::orderBy('numero_cliente', 'desc')->first();
            $customer->numero_cliente = $lastCustomer ? $lastCustomer->numero_cliente + 1 : 1;
        });
    }
}
