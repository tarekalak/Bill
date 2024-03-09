<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bill extends Model
{
    use HasFactory;
    protected $table='bills';
    protected $fillable=['id','customer_name','user_name','discount','date','created_at,updated_at'];

/**
 * Get all of the comments for the Bill
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */

public function users(): BelongsTo
{
    return $this->belongsTo(User::class, 'user_id');
}
public function customers(): BelongsTo
{
    return $this->belongsTo(Customer::class, 'customer_id');
}

public function bill_details(): HasMany
{
    return $this->hasMany(Bill_details::class, 'bill_id');
}

/**
 * Get all of the comments for the Bill
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasMany
 */
public function product(): BelongsToMany
{
    return $this->belongsToMany(Product::class);
}


}
