    {{-- Add New Filter Modal --}}
    <div class="modal effect-rotate-left" id="edit{{ $filter->id }}" tabindex="-1" role="dialog"
        aria-labelledby="edit{{ $filter->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Filter</h5>
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
                    <form action="{{ route('admin.filters.update', $filter) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="filter_name">Filter Name</label>
                            <input type="text" class="form-control  @error('filter_name') is-invalid @enderror"
                                readonly disabled value="{{ old('filter_name', $filter->filter_name) }}">
                        </div>
                        <div class="form-group">
                            <label for="category_ids">Categories</label>
                            <select name="category_ids[]"
                                class=" @error('category_ids') is-invalid @enderror form-control select2"
                                multiple="multiple">
                                @foreach ($sections as $section)
                                    <optgroup label="{{ ucwords(str_replace('-', ' ', $section->name)) }}">
                                    </optgroup>
                                    @foreach ($section->categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ in_array($category->id, explode(',', $filter->category_ids)) ? 'selected' : '' }}>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ ucwords(str_replace('-', ' ', $category->name)) }}
                                        </option>
                                        @foreach ($category->subCategories as $subCategory)
                                            <option value="{{ $subCategory->id }}"
                                                {{ in_array($subCategory->id, explode(',', $filter->category_ids)) ? 'selected' : '' }}>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;
                                                {{ ucwords(str_replace('-', ' ', $subCategory->name)) }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </select>
                            @error('category_ids')
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
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}
                                    {{ $filter->status == '1' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}
                                    {{ $filter->status == '0' ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary-gradient" data-dismiss="modal"> <i
                                    class="fas fa-times"></i> Close</button>
                            <button type="submit" class="btn btn-primary-gradient">
                                <i class="fas fa-edit"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
