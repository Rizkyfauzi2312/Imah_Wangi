@extends('layouts.admin')

@section('title', 'Edit Product')
@section('page-title', 'Edit Product')

@section('content')
<div class="admin-card">
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label-valoria">Product Name</label>
            <input type="text" name="name" class="form-control form-control-valoria @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label class="form-label-valoria">Description</label>
            <textarea name="description" rows="4" class="form-control form-control-valoria @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label class="form-label-valoria">Product Image</label>
            
            @if($product->image)
                <div class="mb-2">
                    <label class="text-muted small">Current Image:</label>
                    <div>
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="max-width: 200px; border-radius: 4px;">
                    </div>
                </div>
            @endif
            
            <input type="file" name="image" class="form-control form-control-valoria @error('image') is-invalid @enderror" accept="image/jpeg,image/jpg,image/png" onchange="previewImage(event)">
            <small class="text-muted">Leave empty to keep current image. Max 2MB. Format: JPG, JPEG, PNG</small>
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="mt-2">
                <img id="imagePreview" src="" alt="Preview" style="max-width: 200px; display: none; border-radius: 4px;">
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label-valoria">Price (Rp)</label>
                <input type="number" name="price" class="form-control form-control-valoria @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" min="0" required>
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label-valoria">Stock</label>
                <input type="number" name="stock" class="form-control form-control-valoria @error('stock') is-invalid @enderror" value="{{ old('stock', $product->stock) }}" min="0" required>
                @error('stock')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-gold">
                <i class="fas fa-save"></i> Update Product
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('imagePreview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection
