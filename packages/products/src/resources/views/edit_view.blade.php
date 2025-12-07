<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4 text-center">Edit Product: {{ $product['name'] }}</h1>

            <div class="card shadow-sm">
                <div class="card-body">
                    
                    <form action="{{ route('products.update', $product['id']) }}" method="POST">
                        @csrf
                        @method('PUT') 

                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $product['name']) }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" 
                                      id="description" 
                                      name="description" 
                                      rows="4" 
                                      required>{{ old('description', $product['description']) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price (EUR)</label>
                            <input type="number" 
                                   class="form-control" 
                                   id="price" 
                                   name="price"  
                                   step="0.01" 
                                   min="0" 
                                   value="{{ old('price', $product['price']) }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock Quantity</label>
                            <input type="number" 
                                   class="form-control" 
                                   id="stock" 
                                   name="stock" 
                                   min="0" 
                                   value="{{ old('stock', $product['stock']) }}"
                                   required>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" 
                                   class="form-check-input" 
                                   id="is_active" 
                                   name="is_active" 
                                   value="1" 
                                   {{ old('is_active', $product['is_active']) ? 'checked' : '' }} >
                            <label class="form-check-label" for="is_active">Is Active (Visible on site)</label>
                        </div>
                        
                        <div class="d-flex justify-content-between pt-3">
                            <a href="{{ route('products.show', $product['id']) }}" class="btn btn-secondary">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Update Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>