@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Inquiries</h1>
    <!-- <img src="http://127.0.0.1:8000/storage/9/download-(3).jpg" alt="image"> -->
    {{-- <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.notifications.create') }}" class="btn btn-sm btn-danger">
            <i class="fas fa-plus"></i> Add 
        </a>
    </div> --}}
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="notifications-table" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Created At</th>
                        
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
$(function () {
    $('#notifications-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.notifications.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'email', name: 'email' },
            { data: 'subject', name: 'subject' },
            { data: 'status', name: 'status', orderable: false, searchable: false },
             { data: 'action', name: 'action' },
            { data: 'created_at', name: 'created_at' }
        ]
    });
});
</script>
@endpush
