@extends('layouts.admin')

@section('title', 'Add Bottle Size')
@section('page-title', 'Add New Bottle Size')

@section('content')
<div class="admin-card">
    <form action="{{ route('admin.bottle-sizes.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label class="form-label-valoria">Size (ml)</label>
            <input type="number" name="size_ml" class="form-control form-control-valoria @error('size_ml') is-invalid @enderror" value="{{ old('size_ml') }}" min="1" required>
            @error('size_ml')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label class="form-label-valoria">Base Price (Rp)</label>
            <input type="number" name="base_price" class="form-control form-control-valoria @error('base_price') is-invalid @enderror" value="{{ old('base_price') }}" min="0" required>
            @error('base_price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-gold">
                <i class="fas fa-save"></i> Save Bottle Size
            </button>
            <a href="{{ route('admin.bottle-sizes.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>
@endsection
