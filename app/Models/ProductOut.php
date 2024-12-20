<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductOut extends Model
{
    use HasFactory;

    protected $table = 'product_outs';

    protected $guarded = [
    ];

    protected $dates = ['date'];

    public function productList(): BelongsTo
    {
        return $this->belongsTo(ProductList::class, 'product_list_id');
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function productStock(): BelongsTo
    {
        return $this->belongsTo(ProductStock::class, 'product_stock_id');
    }

}
