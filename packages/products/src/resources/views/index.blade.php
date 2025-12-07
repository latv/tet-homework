@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Products Module</h1>
        {{-- Route to the Create Form --}}
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            + Create New Product
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Last Updated</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->updated_at->diffForHumans() }}</td>
                        <td class="text-end">
                            {{-- Edit Button --}}
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            {{-- Delete Form --}}
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            No products found in this module.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            {{-- Pagination Links (if using pagination) --}}
            <div class="mt-3">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection