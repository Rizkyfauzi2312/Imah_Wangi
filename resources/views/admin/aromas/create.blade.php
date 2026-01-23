@extends('layouts.admin')

@section('title', 'Add Aroma')
@section('page-title', 'Add New Aroma')

@section('content')
<div class="admin-card">
    <form action="{{ route('admin.aromas.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label class="form-label-valoria">Aroma Name</label>
            <input type="text" name="name" class="form-control form-control-valoria @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label class="form-label-valoria">Category</label>
            <select name="category" class="form-select form-control-valoria @error('category') is-invalid @enderror" required>
                <option value="">Select Category</option>
                <option value="top" {{ old('category') == 'top' ? 'selected' : '' }}>Top Note</option>
                <option value="middle" {{ old('category') == 'middle' ? 'selected' : '' }}>Middle Note</option>
                <option value="base" {{ old('category') == 'base' ? 'selected' : '' }}>Base Note</option>
            </select>
            @error('category')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label class="form-label-valoria">Description</label>
            <textarea name="description" rows="3" class="form-control form-control-valoria @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-gold">
                <i class="fas fa-save"></i> Save Aroma
            </button>
            <a href="{{ route('admin.aromas.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>
@endsection
