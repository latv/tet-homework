<h1 class="mb-4 text-center">Product List</h1>
        <a href="{{ route('products.create.view') }}" class="btn btn-success">
            Create Product
        </a>
<form 
    action="{{ route('products.import') }}" 
    method="POST" 
    enctype="multipart/form-data" 
    class="d-flex gap-2 align-items-center mt-1"> 
    @csrf
    <input type="file" name="file" class="form-control form-control-sm" required accept=".csv, .xlsx">
    <button type="submit" class="btn btn-warning btn-sm">Import</button>
</form>
<div class="card shadow-sm">

    <div class="card-body">

    <div class="d-flex justify-content-end mb-3">

    </div>
        @if(isset($products) && count($products))
            <ul class="list-group list-group-flush">
                @foreach($products as $product)
                <a href="{{ route('products.show', $product['id']) }}" class="stretched-link"></a>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $product['name'] }}</span>
                        <span class="badge bg-primary rounded-pill">${{ $product['price'] }}</span>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="alert alert-warning text-center mb-0">
                No products found.
            </div>
        @endif
    </div>
</div>
