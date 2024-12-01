@extends('layouts.master.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0 fw-semibold">Product Details</h5>
                        </div>
                        <div class="ms-auto">
                            <a href="{{ route('product.index') }}" class="btn btn-primary text-white fw-bold fs-4">
                                <i class="ti ti-arrow-left me-1"></i>
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                        </div>
                        <div class="col-md-8">
                            <p><strong>Name:</strong> {{ $product->name }}</p>
                            <p><strong>Category:</strong> {{ $product->category->name }}</p>
                            <p><strong>Price:</strong> Rp.{{ number_format($product->price, 0, ',', '.') }}</p>
                            <p><strong>Stock:</strong> {{ $product->stock }}</p>
                            <p><strong>Description:</strong> {{ $product->description }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row align-items-center justify-content-end">
                        <div class="col-md-2 text-end">
                            <a class="btn btn-sm btn-warning fw-semibold"
                                href="{{ route('product.edit', $product->id) }}">Edit</a>
                            <form class="d-inline" method="POST" action="{{ route('product.destroy', $product->id) }}">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" type="submit"
                                    class="btn btn-sm btn-danger fw-semibold">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
