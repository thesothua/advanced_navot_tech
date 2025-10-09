@extends('admin.layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Quotations</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.quotations.create') }}" class="btn btn-sm btn-danger">
                <i class="fas fa-plus"></i> New Quotation
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Quotation No</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th class="text-end">Grand Total</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quotations as $quotation)
                        <tr>
                            <td>{{ $quotation->quotation_no }}</td>
                            <td>{{ $quotation->quotation_date->format('d M Y') }}</td>
                            <td>{{ $quotation->customer->company_name ?? '-' }}</td>
                            <td class="text-end">{{ number_format($quotation->grand_total, 2) }}</td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.quotations.show', $quotation) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">No quotations yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div>
                    {{ $quotations->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
