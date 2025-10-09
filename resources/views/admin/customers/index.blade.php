@extends('admin.layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Customers</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.customers.create') }}" class="btn btn-sm btn-danger">
                <i class="fas fa-plus"></i> Add Customer
            </a>
            <a href="{{ route('admin.customers-export-csv') }}" class="btn btn-sm btn-secondary ms-2">
                <i class="fas fa-file-csv"></i> Export to CSV
            </a>

        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="customers-table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Company</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Source</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Include DataTables JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(function() {
            $('#customers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.customers.index') }}',
                columns: [{
                        data: 'customer_name',
                        name: 'customer_name'
                    },
                    {
                        data: 'company_name',
                        name: 'company_name'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'contact_source',
                        name: 'contact_source'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush
