<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'customer_name',
        'customer_email',
        'customer_gst_no',
        'customer_street',
        'customer_city',
        'customer_state',
        'customer_zip',
        'customer_country',
        'selected_terms_and_conditions',
        'quotation_no',
        'quotation_date',
        'currency',
        'make',
        'subtotal',
        'total_gst',
        'total_discount',
        'grand_total',
    ];

    protected $casts = [
        'quotation_date' => 'date',
        'subtotal'       => 'decimal:2',
        'total_gst'      => 'decimal:2',
        'total_discount' => 'decimal:2',
        'grand_total'    => 'decimal:2',
        'selected_terms_and_conditions' => 'array',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(QuotationItem::class);
    }
}
