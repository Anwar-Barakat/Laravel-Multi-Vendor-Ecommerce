<div class="card-header pb-0">
    <div class="d-flex justify-content-between">
        <h4 class="card-title mg-b-0">Added Attributes</h4>
    </div>
</div>
<div class="card-body product-attributes-info">
    <form action="{{ route('admin.products.attributes.update', ['product' => $product]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="table-responsive">
            <table class="table text-md-nowrap  table-striped" id="example1">
                <thead>
                    <tr>
                        <th class="wd-15p border-bottom-0">#</th>
                        <th class="wd-15p border-bottom-0">Size</th>
                        <th class="wd-15p border-bottom-0">SKU</th>
                        <th class="wd-15p border-bottom-0">Price</th>
                        <th class="wd-15p border-bottom-0">Stock</th>
                        <th class="wd-15p border-bottom-0">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product->attributes as $attribute)
                        <input type="text" class="d-none" name="attribute_id[]" value="{{ $attribute['id'] }}">
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><input type="text" class="form-control" name="size[]"
                                    value="{{ ucwords($attribute['size']) }}" style="height: 2rem;"></td>
                            <td>{{ $attribute['sku'] }}</td>
                            <td>
                                <input type="number" class="form-control" name="price[]"
                                    value="{{ $attribute['price'] }}" style="height: 2rem;">
                            </td>
                            <td>
                                <input type="number" class="form-control" name="stock[]"
                                    value="{{ $attribute['stock'] }}" style="height: 2rem;">
                            </td>
                            <td>
                                @livewire('admin.product.attribute.update-status', ['status' => $attribute->status, 'attribute_id' => $attribute->id])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="form-group mb-0 mt-3 justify-content-end">
            <button type="submit" class="btn btn-primary-gradient">
                <i class="fas fa-edit"></i> Update
            </button>
        </div>
    </form>
</div>
