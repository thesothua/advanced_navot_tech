@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Notification Details</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
   
        <a href="{{ route('admin.notifications.index') }}" class="btn btn-sm btn-danger">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="row">



  

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Notification Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> {{ $notification->name }}</p>
                        <p><strong>Suject:</strong> {{ $notification->subject }}</p>
                        <p><strong>Email:</strong> {{ $notification->email }}</p>
                   
                    </div>
                    <div class="col-md-6">
                     
                        <p><strong>Status:</strong> 
                            @if($notification->read_at)
                                <span class="badge bg-success">Read</span>
                            @else
                                <span class="badge bg-secondary">Unread</span>
                            @endif
                        </p>
                      
                    </div>
                </div>
                
                @if($notification->message)
                <div class="mt-3">
                    <h6>Message:</h6>
                    <p>{{ $notification->message }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

   </div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">notification Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="" class="img-fluid" style="max-width: 100%; height: auto;">
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<style>
    .notification-image:hover {
        transform: scale(1.05);
    }
    
    /* .image-container:hover .image-overlay {
        opacity: 1 !important;
    } */
    
    .image-container {
        transition: transform 0.3s ease;
    }
    
    .image-container:hover {
        transform: translateY(-2px);
    }
</style>

<script>
// function showImageModal(imageUrl, notificationName) {
//     document.getElementById('modalImage').src = imageUrl;
//     document.getElementById('modalImage').alt = notificationName;
//     document.getElementById('imageModalLabel').textContent = notificationName + ' - Image';
    
//     const modal = new bootstrap.Modal(document.getElementById('imageModal'));
//     modal.show();
// }
</script>
@endpush 