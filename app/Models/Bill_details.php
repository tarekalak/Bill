<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Bill_details extends Model
{
    use HasFactory;
    protected $fillable=['id','bill_id','product_id','product_price','quantity','created_at','updated_at'];

    /**
     * Get the user that owns the bill_product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
   /**
    * Get the user that owns the Bill_details
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function bill(): BelongsTo
   {
       return $this->belongsTo(Bill::class, 'bill_id');
   }

}
