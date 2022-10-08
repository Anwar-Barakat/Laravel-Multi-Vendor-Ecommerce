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
            @foreach ($product->getMedia('product_attachments') as $key => $image)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img width="130" src="{{ $image->getUrl('small') }}" class="img img-thumbnail  admin-image">
                    </td>
                    <td>
                        <div class="d-flex align-items-center justify-content-around">
                            <form action="" method="post">
                                @csrf
                                <a href="javascript:void(0);" class="confirmationDelete"
                                    data-image="{{ $image->id }}" title="Delete Attachment">
                                    <i class="fas fa-trash-alt text-danger"></i>
                                </a>
                            </form>
                            <a href="" title="Download Attachment">
                                <i class="fas fa-download text-primary"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div><!-- bd -->
