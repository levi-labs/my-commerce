@extends('layouts.master.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">All Products</h5>
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="row justify-content-between">
                        <div class="col-md-4">
                            <a href="{{ route('product.create') }}" class="btn btn-primary text-white fw-bold fs-4">
                                <i class="ti ti-plus me-1"></i>
                            </a>
                        </div>
                        <div class="col-md-6 text-end">
                            <form action="{{ route('product.index') }}" method="GET">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="search" placeholder="Search">
                                    <button class="btn btn-primary text-white fw-bold fs-4" type="submit">
                                        <i class="ti ti-search me-1"></i>
                                    </button>
                                    <a href="{{ route('product.index') }}"
                                        class="btn btn-gray text-dark fw-bold fs-4 mx-1"><i
                                            class="ti ti-refresh me-1"></i></a>
                                </div>

                            </form>

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
                                        <h6 class="fw-semibold mb-0">Price</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Description</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Action</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">{{ $product->name }}</h6>
                                            {{-- <span class="fw-normal">Stock : {{ $product->stock }}</span> --}}
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $product->description }}</p>
                                            <span
                                                class="badge bg-dark fs-1 fw-normal my-2">{{ $product->category_name }}</span>
                                        </td>
                                        {{-- <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0 fs-4">{{ $product->product_count }}</h6>
                                        </td> --}}
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <a class="btn btn-sm btn-secondary fw-semibold"
                                                    href="{{ route('product.show', $product->id) }}">Detail</a>
                                                <a class="btn btn-sm btn-warning fw-semibold"
                                                    href="{{ route('product.edit', $product->id) }}">Edit</a>
                                                <form method="POST" action="{{ route('product.destroy', $product->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Are you sure?')" type="submit"
                                                        class="btn btn-sm btn-danger fw-semibold">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="border-bottom-0 text-center">
                                            <div class="alert alert-warning">No products found</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
