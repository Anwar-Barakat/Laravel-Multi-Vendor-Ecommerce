    {{-- Add New Filter Value Modal --}}
    <div class="modal effect-rotate-left" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Filter Value</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <ul class="list-unstyled alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form action="{{ route('admin.filters-values.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="filter_id">Filters</label>
                            <select name="filter_id"
                                class=" @error('filter_id') is-invalid @enderror form-control select2">
                                <option value="" selected>Select...</option>
                                @foreach ($filters as $filter)
                                    <option value="{{ $filter->id }}"
                                        {{ old('filter_id') == $filter->id ? 'selected' : '' }}>
                                        {{ $filter->filter_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('filter_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="filter_value">Filter Value</label>
                            <input type="text" class="form-control  @error('filter_value') is-invalid @enderror"
                                name="filter_value" placeholder="Filter Name" required>
                            @error('filter_value')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status"
                                name="status" required>
                                <option value="">Select...</option>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="0" {{ old('status') == '1' ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary-gradient"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary-gradient">
                                <i class="fas fa-plus"></i> Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
