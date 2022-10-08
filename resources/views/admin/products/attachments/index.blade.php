<div class="table-responsive mt-3">
    <table class="table text-md-nowrap" id="example1">
        <thead>
            <tr>
                <th class="wd-15p border-bottom-0">#</th>
                <th class="wd-50 border-bottom-0">Attachment</th>
                <th class="wd-15p border-bottom-0">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product->getMedia('product_attachments') as $key => $attachment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img width="200" src="{{ $attachment->getUrl('small') }}" class="img img-thumbnail">
                    </td>
                    <td>
                        <div class="dropdown dropup">
                            <button class="btn btn-outline-secondary dropdown-toggle btn-sm btn-group-sm" type="button"
                                id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bars fa-1x"></i>
                            </button>
                            <div class="dropdown-menu tx-13">
                                <form action="{{ route('admin.products.attachments.destroy', $attachment->id) }}"
                                    method="post">
                                    @csrf
                                    <a href="{{ route('admin.products.attachments.destroy', $attachment->id) }}"
                                        class="dropdown-item" data-image="{{ $attachment->id }}" title="Delete">
                                        <i class="fas fa-trash-alt text-danger"></i>
                                        Delete
                                    </a>
                                </form>
                                <a href="{{ route('admin.products.attachments.download', $attachment->id) }}"
                                    class="dropdown-item" title="Download">
                                    <i class="fas fa-download text-primary"></i>
                                    Download
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div><!-- bd -->
