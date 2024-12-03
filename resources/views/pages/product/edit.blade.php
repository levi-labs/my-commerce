@extends('layouts.master.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0 fw-semibold">{{ $title }}</h5>
                </div>
                <div class="ms-auto">
                    <a href="{{ route('product.index') }}" class="btn btn-primary text-white fw-bold fs-4">
                        <i class="ti ti-arrow-left me-1"></i>
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('product.update', $product->id) }}" method="post" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $product->name }}" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">Samsung S24 Ultra, or anything else.</div>
                            @error('name')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" min="0" class="form-control" id="price" name="price"
                                value="{{ number_format($product->price, 0, ',', '.') }}" onchange="formatRupiah(event)"
                                oninput="validateNumber(event)">
                            @error('price')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" min="0" class="form-control" id="stock" name="stock"
                                value="{{ $product->stock }}">
                            @error('stock')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" aria-label="Default select example" name="category_id">
                                <option selected disabled>Open this select menu</option>
                                @foreach ($categories as $category)
                                    <option {{ $category->id == $product->category_id ? 'selected' : '' }}
                                        value="{{ $category->id }}">
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        @php
                            $str_image = explode('/', $product->image_url);
                            $image_name = end($str_image);
                        @endphp
                        <div class="mb-3">
                            <label for="image_url" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image_url"
                                onchange="previewImage(event)"> {{ $image_name }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="image-preview-container-old" style="display: block; margin-top: 10px;">
                                        <label>Preview old image:</label>
                                        @if ($product->image_url)
                                            <img id="image-preview-old" src="{{ $product->image_url }}" alt="Image preview"
                                                style="max-width: 400px; min-height: 200px; margin-top: 10px;">
                                        @else
                                            <p>No image</p>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="image-preview-container-new" style="display: none; margin-top: 10px;">
                                        <label>Preview new image:</label>
                                        <img id="image-preview-new" src="" alt="Image preview"
                                            style="max-width: 400px; min-height: 250px; margin-top: 10px;">
                                    </div>
                                </div>
                            </div>
                            @error('image_url')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea cols="50" class="form-control" id="description" name="description"
                                placeholder="Tulis deskripsi di sini...">{{ $product->description }}</textarea>
                            @error('description')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewImage(event) {
            const previewContainer = document.getElementById('image-preview-container-new');
            const previewImage = document.getElementById('image-preview-new');

            // Menampilkan preview container jika file dipilih
            previewContainer.style.display = 'block';

            const file = event.target.files[0];
            // Jika ada file yang dipilih, tampilkan pratinjau gambar
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    console.log(e.target);
                }
                reader.readAsDataURL(file);
            }
        }

        // Fungsi untuk memformat angka menjadi format Rupiah
        function formatRupiah(event) {
            const input = event.target; // Ambil elemen input yang dipicu
            let value = input.value; // Ambil nilai input

            // Hapus karakter selain angka
            value = value.replace(/[^\d]/g, "");

            // Format angka menjadi format Rupiah
            const formattedValue = formatCurrency(value);

            // Update nilai input dengan format yang benar
            input.value = formattedValue;
        }

        // Fungsi untuk format angka menjadi format Rupiah
        function formatCurrency(value) {
            // Menambahkan format Rupiah dengan titik sebagai pemisah ribuan
            return value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Fungsi untuk memvalidasi angka
        function validateNumber(event) {
            const input = event.target; // Ambil elemen input yang dipicu
            let value = input.value; // Ambil nilai input

            // Hapus karakter selain angka
            value = value.replace(/[^\d]/g, "");

            // Update nilai input dengan format yang benar
            input.value = value;
        }
    </script>
@endsection
