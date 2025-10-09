<?php
namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection; // ✅ must be here
use Maatwebsite\Excel\Concerns\WithHeadings;   // (optional, for CSV headings)

class CustomersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Customer::select('customer_name','phone','status','company_name','address','contact_source')->get();
    }

    public function headings(): array
    {
        return ['Name', 'Phone', 'Status', 'Company', 'Address', 'Contact Source'];
    }
}
