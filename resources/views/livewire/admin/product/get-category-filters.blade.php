<div class="row">
    <div class="col-md-12 col-lg-6">
        <div class="form-group">
            <label for="category_id">Categories</label>
            <select name="category_id" class="form-control  @error('category_id') is-invalid @enderror"
                wire:model="category">
                <option value="" selected>Select...</option>
                @foreach ($sections as $section)
                    <optgroup label="{{ ucwords(str_replace('-', ' ', $section->name)) }}">
                    </optgroup>
                    @foreach ($section->categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ ucwords(str_replace('-', ' ', $category->name)) }}
                        </option>
                        @foreach ($category->subCategories as $subCategory)
                            <option value="{{ $subCategory->id }}"
                                {{ old('category_id') == $subCategory->id ? 'selected' : '' }}>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;
                                {{ ucwords(str_replace('-', ' ', $subCategory->name)) }}
                            </option>
                        @endforeach
                    @endforeach
                @endforeach
            </select>
            @error('category_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    @if ($allFilters)
        @foreach ($allFilters as $filter)
            @if (in_array($selectedCategoryId, explode(',', $filter->category_ids)))
                <div class="col-md-12 col-lg-6">
                    <div class="form-group">
                        <label for="filters">Select {{ ucwords($filter->filter_name) }}</label>
                        <select name="{{ $filter->filter_column }}"
                            class="form-control  @error('filters') is-invalid @enderror">
                            <option value="" selected>Select...</option>
                            @foreach ($filter->filterValues as $filterValue)
                                <option value="{{ $filterValue->filter_value }}"
                                    {{ old('filters') == $filterValue->filter_value ? 'selected' : '' }}>
                                    {{ ucwords(str_replace('-', ' ', $filterValue->filter_value)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
        @endforeach
    @endif

</div>
