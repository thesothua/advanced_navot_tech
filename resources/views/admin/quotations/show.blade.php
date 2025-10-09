@extends('admin.layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Quotation {{ $quotation->quotation_no }}</h1>
        <a href="{{ route('admin.quotations.index') }}" class="btn btn-sm btn-danger">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <a href="{{ route('admin.quotations.revise', $quotation) }}" class="btn btn-sm btn-primary ms-2">
            <i class="fas fa-redo"></i> Revise Quotation
        </a>
        <a href="{{ route('admin.quotations.preview', $quotation) }}" class="btn btn-sm btn-info ms-2" target="_blank">
            <i class="fas fa-eye"></i> Preview PDF
        </a>
        <a href="{{ route('admin.quotations.download', $quotation) }}" class="btn btn-sm btn-success ms-2">
            <i class="fas fa-download"></i> Download PDF
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Quotation Information</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="fw-semibold">Customer</div>
                            <div>{{ $quotation->customer_name ?? ($quotation->customer->company_name ?? '-') }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="fw-semibold">Date</div>
                            <div>{{ $quotation->quotation_date->format('d M Y') }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="fw-semibold">Currency</div>
                            <div>{{ $quotation->currency }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Products</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th class="text-center">GST(%)</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Disc.</th>
                                    <th class="text-end">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($quotation->items as $item)
                                <tr>
                                    <td>
                                        <div class="fw-semibold">{{ $item->product_name ?? ($item->product->name ?? '-') }}</div>
                                        @php $brandName = $item->product?->brand?->name; @endphp
                                        @if($brandName)
                                            <div class="small text-muted">Brand: {{ $brandName }}</div>
                                        @endif
                                        @if($item->description)
                                            <div class="small text-muted">{{ $item->description }}</div>
                                        @endif
                                        @if($item->product_code || $item->guarantee)
                                            <div class="text-muted small">
                                                @if($item->product_code)
                                                    Code: {{ $item->product_code }}
                                                @endif
                                                @if($item->product_code && $item->guarantee)
                                                    |
                                                @endif
                                                @if($item->guarantee)
                                                    Guarantee: {{ $item->guarantee }}
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ optional($item->product?->categories()->first())->name }}</td>
                                    <td class="text-center">{{ number_format($item->gst_percent, 2) }}</td>
                                    <td class="text-end">{{ number_format($item->price, 2) }}</td>
                                    <td class="text-center">{{ number_format($item->quantity, 2) }}</td>
                                    <td class="text-center">{{ $item->discount_type }} {{ number_format($item->discount_value, 2) }}</td>
                                    <td class="text-end">{{ number_format($item->amount, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Totals</h5>
                </div>
                <div class="card-body">
                    @if($quotation->make)
                    <div class="d-flex justify-content-between mb-2"><span>Make</span><span>{{ $quotation->make }}</span></div>
                    @endif
                    <div class="d-flex justify-content-between mb-2"><span>Sub Total</span><span>{{ number_format($quotation->subtotal, 2) }}</span></div>
                    <div class="d-flex justify-content-between mb-2"><span>Total Discount</span><span>{{ number_format($quotation->total_discount, 2) }}</span></div>
                    <div class="d-flex justify-content-between mb-2"><span>Total GST</span><span>{{ number_format($quotation->total_gst, 2) }}</span></div>
                    <div class="d-flex justify-content-between fs-5 fw-semibold"><span>Total Amount</span><span>{{ number_format($quotation->grand_total, 2) }}</span></div>
                </div>
            </div>
        </div>
    </div>
@endsection
