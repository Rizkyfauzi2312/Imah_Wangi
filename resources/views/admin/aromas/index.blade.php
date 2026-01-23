@extends('layouts.admin')

@section('title', 'Aromas Management')
@section('page-title', 'Aromas')

@section('page-actions')
    <a href="{{ route('admin.aromas.create') }}" class="btn btn-gold">
        <i class="fas fa-plus"></i> Add Aroma
    </a>
@endsection

@section('content')
<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($aromas as $aroma)
                    <tr>
                        <td>{{ $aroma->id }}</td>
                        <td>{{ $aroma->name }}</td>
                        <td>
                            <span class="badge bg-{{ $aroma->category == 'top' ? 'primary' : ($aroma->category == 'middle' ? 'success' : 'warning') }}">
                                {{ ucfirst($aroma->category) }} Note
                            </span>
                        </td>
                        <td>{{ Str::limit($aroma->description, 50) }}</td>
                        <td>
                            <a href="{{ route('admin.aromas.edit', $aroma->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.aromas.destroy', $aroma->id) }}" method="POST" class="d-inline">
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
                        <td colspan="5" class="text-center">No aromas found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-3">
        {{ $aromas->links() }}
    </div>
</div>
@endsection
