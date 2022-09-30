<form class="form-horizontal" wire:submit.prevent="addCategory">
    @if ($image)
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-6">
                <div class="form-group">
                    <img src="{{ $image->temporaryUrl() }}" alt="" height="200" class="img img-thumbnail">
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 col-lg-6">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control  @error('name') is-invalid @enderror" wire:model="name"
                    wire:keyup="generateURL" value="{{ old('name') }}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-12 col-lg-6">
            <div class="form-group">
                <label for="url">URL</label>
                <input type="text" class="form-control  @error('url') is-invalid @enderror" readonly
                    wire:model="url">
                @error('url')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-12 col-lg-6">
            <div class="form-group">
                <label for="section_id">Sections</label>
                <select wire:model="section" class="form-control  @error('section_id') is-invalid @enderror">
                    <option value="" selected>Select...</option>
                    @foreach ($sections as $section)
                        <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>
                            {{ $section->name }}</option>
                    @endforeach
                </select>
                @error('section_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        @if ($categories)
            <div class="col-md-12 col-lg-6">
                <div class="form-group">
                    <label for="parent_id">Categories</label>
                    <select class="form-control  @error('parent_id') is-invalid @enderror">
                        <option value="" selected>Select...</option>
                        <option value="0">Root</option>
                        @foreach ($categories as $root)
                            <option value="{{ $root->id }}">{{ ucwords($root->name) }}</option>
                            @foreach ($root->subCategories as $child)
                                <option value="{{ $child->id }}">&nbsp;&raquo;
                                    {{ ucwords($child->name) }}
                                </option>
                            @endforeach
                            @if ($loop->iteration < count($categories))
                                <option style="background:#eeeeee; max-height: 1px; height: 1px;" disabled></option>
                            @endif
                        @endforeach
                    </select>
                    @error('parent_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-6">
            <label for="discount">Discount</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                </div>
                <input aria-label="Amount (to the nearest dollar)"
                    class="form-control  @error('discount') is-invalid @enderror" type="number"
                    value="{{ old('discount') }}" wire:model="discount">
                <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                </div>
                @error('discount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <br>

        </div>
        <div class="col-md-12 col-lg-6">
            <div class="form-group">
                <label for="image">Image</label>
                <div class="custom-file">
                    <input class="custom-file-input" id="customFile" type="file" wire:model="image">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-6">
            <div class="form-group">
                <label for="description">Description</label>
                <div class="form-group has-success mg-b-0">
                    <textarea class="form-control @error('description') is-invalid @enderror"="" rows="3" wire:model="description">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-4">
            <div class="form-group">
                <label for="meta_title">Meta title</label>
                <input type="text" class="form-control  @error('meta_title') is-invalid @enderror" id="meta_title"
                    wire:model="meta_title">
                @error('meta_title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-12 col-lg-4">
            <div class="form-group">
                <label for="meta_description">Meta description</label>
                <input type="text" class="form-control  @error('meta_description') is-invalid @enderror"
                    id="meta_description" wire:model="meta_description">
                @error('meta_description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-12 col-lg-4">
            <div class="form-group">
                <label for="meta_keywords">Meta keywords</label>
                <input type="text" class="form-control  @error('meta_keywords') is-invalid @enderror"
                    id="meta_keywords" wire:model="meta_keywords">
                @error('meta_keywords')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
    <hr>
    <div class="form-group mb-0 mt-3 justify-content-end">
        <div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Add</button>
        </div>
    </div>
</form>
