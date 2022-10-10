    {{-- Edit Banner Modal --}}
    <div class="modal fade" id="edit{{ $banner->id }}" tabindex="-1" role="dialog"
        aria-labelledby="edit{{ $banner->id }}Label" aria-hidden="true" data-effect="effect-super-scaled">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Brand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.banners.update', $banner) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-4">
                            <div class="col-12">
                                @if ($banner->getFirstMediaUrl('banners', 'slider'))
                                    <img class="img img-thumbnail"
                                        src="{{ $banner->getFirstMediaUrl('banners', 'slider') }}">
                                @else
                                    <img class="img img-thumbnail"
                                        src="{{ asset('assets/img/banners/banner-default.jpg') }}">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control  @error('title') is-invalid @enderror"
                                        id="title" name="title" placeholder="Banner Title"
                                        value="{{ old('title', $banner->title) }}" required>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="alternative">Alternative</label>
                                    <input type="text"
                                        class="form-control  @error('alternative') is-invalid @enderror"
                                        id="alternative" name="alternative" placeholder="Banner alternative"
                                        value="{{ old('alternative', $banner->alternative) }}" required>
                                    @error('alternative')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status"
                                name="status" required>
                                <option value="">Select...</option>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}
                                    {{ $banner->status == '1' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="0" {{ old('status') == '1' ? 'selected' : '' }}
                                    {{ $banner->status == '0' ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <div class="custom-file">
                                <input class="custom-file-input" id="customFile" type="file" name="image"> <label
                                    class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary-gradient"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary-gradient">
                                <i class="fas fa-edit"></i> update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
