    {{-- Edit Brand Modal --}}
    <div class="modal fade" id="edit{{ $brand->id }}" tabindex="-1" role="dialog" aria-labelledby="edit{{ $brand->id }}Label" aria-hidden="true" data-effect="effect-super-scaled">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Brand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.brands.update', $brand) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" value="{{ $brand->name }}" placeholder="Brand Name" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value=""> Select...</option>
                                <option value="1" {{ old('status', $brand->status) == '1' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="0" {{ old('status', $brand->status) == '0' ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary-gradient modal-effect" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary-gradient">
                                <i class="fas fa-edit"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
