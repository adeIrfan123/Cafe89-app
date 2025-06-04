<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $fillable = [
        'customer_id',
        'total'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
    public function calculateTotal()
    {
        $total = $this->items()->with('product')->get()->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        $this->total = $total;
        $this->save();
    }
}
