@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold">Quotations</h1>
        <a href="{{ route('admin.quotations.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">New Quotation</a>
    </div>

    <div class="bg-white shadow rounded">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left">Quotation No</th>
                    <th class="px-4 py-2 text-left">Date</th>
                    <th class="px-4 py-2 text-left">Customer</th>
                    <th class="px-4 py-2 text-right">Grand Total</th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($quotations as $quotation)
                <tr>
                    <td class="px-4 py-2">{{ $quotation->quotation_no }}</td>
                    <td class="px-4 py-2">{{ $quotation->quotation_date->format('d M Y') }}</td>
                    <td class="px-4 py-2">{{ $quotation->customer->company_name ?? '-' }}</td>
                    <td class="px-4 py-2 text-right">{{ number_format($quotation->grand_total, 2) }}</td>
                    <td class="px-4 py-2 text-right">
                        <a class="text-blue-600" href="{{ route('admin.quotations.show', $quotation) }}">View</a>
                    </td>
                </tr>
                @empty
                <tr><td class="px-4 py-6 text-center" colspan="5">No quotations yet.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">{{ $quotations->links() }}</div>
    </div>
</div>
@endsection

