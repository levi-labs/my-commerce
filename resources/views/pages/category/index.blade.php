@extends('layouts.master.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">All Categories</h5>
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('category.create') }}" class="btn btn-primary text-white fw-bold fs-4">
                                <i class="ti ti-plus me-1"></i>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">No</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Name</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Description</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Products</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Action</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">{{ $category->name }}</h6>
                                            <span class="fw-normal">Web Designer</span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $category->description }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0 fs-4">{{ $category->product_count }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <a class="btn btn-sm btn-warning fw-semibold"
                                                    href="{{ route('category.edit', $category->id) }}">Edit</a>
                                                <form method="POST"
                                                    action="{{ route('category.destroy', $category->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Are you sure?')" type="submit"
                                                        class="btn btn-sm btn-danger fw-semibold">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-warning">No categories found</div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
