@extends('layouts.admin')

@section('title', 'Bottle Sizes Management')
@section('page-title', 'Bottle Sizes')

@section('page-actions')
    <a href="{{ route('admin.bottle-sizes.create') }}" class="btn btn-gold">
        <i class="fas fa-plus"></i> Add Bottle Size
    </a>
@endsection

@section('content')
<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Size (ml)</th>
                    <th>Base Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bottleSizes as $size)
                    <tr>
                        <td>{{ $size->id }}</td>
                        <td><strong>{{ $size->size_ml }} ml</strong></td>
                        <td>Rp {{ number_format($size->base_price, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('admin.bottle-sizes.edit', $size->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.bottle-sizes.destroy', $size->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No bottle sizes found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-3">
        {{ $bottleSizes->links() }}
    </div>
</div>
@endsection
