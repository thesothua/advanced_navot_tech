<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'phone',
        'status',
        'company_name',
        'address',
        'description',
        'contact_source',
        'email',
        'gst_no',
    ];

    protected $casts = [
        'address' => 'array',
    ];

    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class);
    }
}
