@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold">Quotation {{ $quotation->quotation_no }}</h1>
        <a href="{{ route('admin.quotations.index') }}" class="text-blue-600">Back</a>
    </div>

    <div class="bg-white rounded shadow p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <div class="font-semibold">Customer</div>
                <div>{{ $quotation->customer->company_name ?? '-' }}</div>
            </div>
            <div>
                <div class="font-semibold">Date</div>
                <div>{{ $quotation->quotation_date->format('d M Y') }}</div>
            </div>
            <div>
                <div class="font-semibold">Currency</div>
                <div>{{ $quotation->currency }}</div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded shadow p-4 mb-6 overflow-auto">
        <table class="min-w-full border">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-2 py-1 text-left">Product</th>
                    <th class="px-2 py-1">GST(%)</th>
                    <th class="px-2 py-1">Price</th>
                    <th class="px-2 py-1">Qty</th>
                    <th class="px-2 py-1">Disc.</th>
                    <th class="px-2 py-1 text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quotation->items as $item)
                <tr>
                    <td class="border px-2 py-1">
                        <div class="font-medium">{{ $item->product_name }}</div>
                        @if($item->description)
                        <div class="text-sm text-gray-600">{{ $item->description }}</div>
                        @endif
                        <div class="text-xs text-gray-500">Code: {{ $item->product_code }} | HSN: {{ $item->hsn_sac_code }} | Make: {{ $item->make }} | Guarantee: {{ $item->guarantee }}</div>
                    </td>
                    <td class="border px-2 py-1 text-center">{{ number_format($item->gst_percent, 2) }}</td>
                    <td class="border px-2 py-1 text-right">{{ number_format($item->price, 2) }}</td>
                    <td class="border px-2 py-1 text-center">{{ number_format($item->quantity, 2) }}</td>
                    <td class="border px-2 py-1 text-center">{{ $item->discount_type }} {{ number_format($item->discount_value, 2) }}</td>
                    <td class="border px-2 py-1 text-right">{{ number_format($item->amount, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="bg-white rounded shadow p-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div></div><div></div>
            <div class="space-y-2">
                <div class="flex justify-between"><span>Sub Total</span><span>{{ number_format($quotation->subtotal, 2) }}</span></div>
                <div class="flex justify-between"><span>Total Discount</span><span>{{ number_format($quotation->total_discount, 2) }}</span></div>
                <div class="flex justify-between"><span>Total GST</span><span>{{ number_format($quotation->total_gst, 2) }}</span></div>
                <div class="flex justify-between font-semibold text-lg"><span>Total Amount</span><span>{{ number_format($quotation->grand_total, 2) }}</span></div>
            </div>
        </div>
    </div>
</div>
@endsection

