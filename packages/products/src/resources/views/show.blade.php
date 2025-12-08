

<div class="container">
@if(isset($product) && count($product))

<a href="{{ route('products.index') }}" class="btn btn-secondary">
        Back to Products
</a>
<a href="{{ route('products.edit.view', ['id' => $product['id']])}}" class="btn btn-primary">
    Edit Product
</a>

    <h1>Product Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $product['name'] }}</h5>
            <p class="card-text"><strong>Description:</strong> {{ $product['description'] }}</p>
            <p class="card-text"><strong>Price:</strong> {{ number_format($product['price'], 2) }} EUR</p>
            <p class="card-text"><strong>In stock:</strong> {{ $product['stock'] }}</p>
            <p class="card-text"><strong>Total sum in stocks:</strong> {{ $product['totalAmount'] }} EUR</p>
            <p class="card-text"><strong>Created At:</strong> {{ \Carbon\Carbon::parse($product['created_at'])->format('Y-m-d') }}</p>
        </div>
    </div>
<form action="{{ route('products.destroy', $product['id']) }}" method="POST" onsubmit="return confirm('Are you sure?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
</form>
@else
    <div class="alert alert-warning text-center mb-0">
        No products found.
    </div>
@endif
</div>