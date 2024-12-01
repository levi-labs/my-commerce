@extends('layouts.master.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">{{ $title }}</h5>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('category.post') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">Samsung S24 Ultra, or anything else.</div>
                            @error('name')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" min="0" class="form-control" id="price" name="price">
                            @error('price')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" min="0" class="form-control" id="stock" name="stock">
                            @error('price')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Category</label>
                            <select class="form-select" aria-label="Default select example" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('price')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image"
                                onchange="previewImage(event)">
                            <div id="image-preview-container" style="display: none; margin-top: 10px;">
                                <label>Preview:</label>
                                <img id="image-preview" src="" alt="Image preview"
                                    style="max-width: 400px; margin-top: 10px;">
                            </div>
                            @error('image')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea cols="50" class="form-control" id="description" name="description"
                                placeholder="Tulis deskripsi di sini..."></textarea>
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
    </script>
@endsection