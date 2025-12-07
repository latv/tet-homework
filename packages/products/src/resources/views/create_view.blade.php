<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4 text-center">Create New Product</h1>

            <div class="card shadow-sm">
                <div class="card-body">
                    {{-- 
                        Form setup:
                        - action: Uses the Laravel route helper to point to the store method ('products.store').
                        - method: Always 'POST' for creation.
                        - @csrf: Mandatory Blade directive for security (Cross-Site Request Forgery protection).
                    --}}
                    <form action="{{ route('products.store') }}" method="POST">
                        @csrf

                        {{-- Name Field --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="name" 
                                   name="name" 
                                   required>
                            {{-- Removed: @error('name') and old('name') --}}
                        </div>

                        {{-- Description Field --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" 
                                      id="description" 
                                      name="description" 
                                      rows="4" 
                                      required></textarea>
                            {{-- Removed: @error('description') and old('description') --}}
                        </div>

                        {{-- Price Field --}}
                        <div class="mb-3">
                            <label for="price" class="form-label">Price ($)</label>
                            <input type="number" 
                                   class="form-control" 
                                   id="price" 
                                   name="price"  
                                   step="0.01" 
                                   min="0" 
                                   required>
                            {{-- Removed: @error('price') and old('price') --}}
                        </div>

                        {{-- Stock Field --}}
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock Quantity</label>
                            <input type="number" 
                                   class="form-control" 
                                   id="stock" 
                                   name="stock" 
                                   min="0" 
                                   required>
                            {{-- Removed: @error('stock') and old('stock') --}}
                        </div>

                        {{-- Is Active Checkbox --}}
                        <div class="mb-3 form-check">
                            <input type="checkbox" 
                                   class="form-check-input" 
                                   id="is_active" 
                                   name="is_active" 
                                   value="1" >
                            <label class="form-check-label" for="is_active">Is Active (Visible on site)</label>
                        </div>
                        
                        <div class="d-flex justify-content-between pt-3">
                            {{-- Back Button (Assumes 'products.index' route exists) --}}
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>

                            {{-- Submit Button --}}
                            <button type="submit" class="btn btn-primary">
                                Create Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>