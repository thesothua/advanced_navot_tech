@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Category</h1>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-danger">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label">Category Name *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name', $category->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="parent_id" class="form-label">Parent Category</label>
                <select class="form-select @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
                    <option value="">None (Top Level Category)</option>
                    @foreach($categories as $parentCategory)
                        <option value="{{ $parentCategory->id }}" {{ old('parent_id', $category->parent_id) == $parentCategory->id ? 'selected' : '' }}>
                            {{ $parentCategory->name }}
                        </option>
                        @if($parentCategory->children)
                            @foreach($parentCategory->children as $child)
                                <option value="{{ $child->id }}" {{ old('parent_id', $category->parent_id) == $child->id ? 'selected' : '' }}>
                                    &nbsp;&nbsp;&nbsp;└ {{ $child->name }}
                                </option>
                                @if($child->children)
                                    @foreach($child->children as $grandchild)
                                        <option value="{{ $grandchild->id }}" {{ old('parent_id', $category->parent_id) == $grandchild->id ? 'selected' : '' }}>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└ {{ $grandchild->name }}
                                        </option>
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </select>
                @error('parent_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="3">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                               id="sort_order" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}" min="0">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="image" class="form-label">Category Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                           value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">
                        Active
                    </label>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-save"></i> Update Category
                </button>
            </div>
        </form>
    </div>
</div>
@endsection