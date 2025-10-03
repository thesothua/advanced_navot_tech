<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'authorized_person_name',
        'authorized_person_number',
        'email',
        'gst_no',
        'address',
        'country',
        'state',
        'city',
    ];

    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class);
    }
}

