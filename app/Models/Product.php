<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    protected $table='products';
    protected $fillable=['id','product_name','product_company','note','product_price'];

    public function bill(): BelongsToMany
    {
        return $this->belongsToMany(Bill::class);
    }

}
