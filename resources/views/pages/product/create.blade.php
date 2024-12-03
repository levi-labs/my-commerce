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
                    <form action="{{ route('product.post') }}" method="post" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">Samsung S24 Ultra, or anything else.</div>
                            @error('name')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" min="0" class="form-control" id="price" name="price"
                                value="{{ old('price') }}" onchange="formatRupiah(event)" oninput="validateNumber(event)">
                            @error('price')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" min="0" class="form-control" id="stock" name="stock"
                                value="{{ old('stock') }}">
                            @error('stock')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" aria-label="Default select example" name="category_id">
                                <option selected disabled>Open this select menu</option>
                                @foreach ($categories as $category)
                                    <option {{ old('category_id') == $category->id ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image_url" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image_url" name="image_url"
                                onchange="previewImage(event)">
                            <div id="image-preview-container" style="display: none; margin-top: 10px;">
                                <label>Preview:</label>
                                <img id="image-preview" src="" alt="Image preview"
                                    style="max-width: 400px; margin-top: 10px;">
                            </div>
                            @error('image_url')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea cols="50" class="form-control" id="description" name="description"
                                placeholder="Tulis deskripsi di sini...">{{ old('description') }}</textarea>
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
            const previewContainer = document.getElementById('image-preview-container');
            const previewImage = document.getElementById('image-preview');

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
