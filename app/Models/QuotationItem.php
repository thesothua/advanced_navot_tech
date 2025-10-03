<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuotationItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quotation_id',
        'product_id',
        'product_name',
        'product_code',
        'hsn_sac_code',
        'make',
        'guarantee',
        'description',
        'gst_percent',
        'price',
        'quantity',
        'discount_type',
        'discount_value',
        'amount',
    ];

    protected $casts = [
        'gst_percent' => 'decimal:2',
        'price' => 'decimal:2',
        'quantity' => 'decimal:2',
        'discount_value' => 'decimal:2',
        'amount' => 'decimal:2',
    ];

    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

