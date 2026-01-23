@extends('layouts.admin')

@section('title', 'Edit Banner')
@section('page-title', 'Edit Banner')

@section('content')
<div class="admin-card">
    <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label-valoria">Title</label>
            <input type="text" name="title" class="form-control form-control-valoria @error('title') is-invalid @enderror" value="{{ old('title', $banner->title) }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label class="form-label-valoria">Subtitle</label>
            <input type="text" name="subtitle" class="form-control form-control-valoria @error('subtitle') is-invalid @enderror" value="{{ old('subtitle', $banner->subtitle) }}">
            @error('subtitle')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label class="form-label-valoria">Banner Image</label>
            
            @if($banner->image)
                <div class="mb-2">
                    <label class="text-muted small">Current Image:</label>
                    <div>
                        <img src="{{ asset($banner->image) }}" alt="{{ $banner->title }}" style="max-width: 300px; border-radius: 4px;">
                    </div>
                </div>
            @endif
            
            <input type="file" name="image" class="form-control form-control-valoria @error('image') is-invalid @enderror" accept="image/jpeg,image/jpg,image/png" onchange="previewImage(event)">
            <small class="text-muted">Leave empty to keep current image. Recommended size: 1920x600px. Max 2MB. Format: JPG, JPEG, PNG</small>
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="mt-2">
                <img id="imagePreview" src="" alt="Preview" style="max-width: 300px; display: none; border-radius: 4px;">
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label-valoria">Link (Optional)</label>
            <input type="url" name="link" class="form-control form-control-valoria @error('link') is-invalid @enderror" value="{{ old('link', $banner->link) }}" placeholder="https://example.com">
            @error('link')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label-valoria">Order</label>
                <input type="number" name="order" class="form-control form-control-valoria @error('order') is-invalid @enderror" value="{{ old('order', $banner->order) }}" min="0" required>
                <small class="text-muted">Lower numbers appear first</small>
                @error('order')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label-valoria">Status</label>
                <div class="form-check form-switch mt-2">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
        </div>
        
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-gold">
                <i class="fas fa-save"></i> Update Banner
            </button>
            <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
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
