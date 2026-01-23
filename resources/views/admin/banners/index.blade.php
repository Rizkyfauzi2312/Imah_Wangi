@extends('layouts.admin')

@section('title', 'Banners Management')
@section('page-title', 'Banners Management')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.banners.create') }}" class="btn btn-gold">
        <i class="fas fa-plus"></i> Add New Banner
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-valoria">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Subtitle</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($banners as $banner)
                    <tr>
                        <td>
                            <img src="{{ asset($banner->image) }}" alt="{{ $banner->title }}" style="width: 100px; height: 60px; object-fit: cover; border-radius: 4px;">
                        </td>
                        <td>{{ $banner->title }}</td>
                        <td>{{ $banner->subtitle ?? '-' }}</td>
                        <td>{{ $banner->order }}</td>
                        <td>
                            <form action="{{ route('admin.banners.toggle', $banner->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $banner->is_active ? 'btn-success' : 'btn-secondary' }}">
                                    {{ $banner->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this banner?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No banners found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($banners->hasPages())
        <div class="mt-3">
            {{ $banners->links() }}
        </div>
    @endif
</div>
@endsection
