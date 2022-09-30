<div class="row">
    <div class="col-md-12 col-lg-6">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name"
                required wire:model="name" wire:keyup="generateURL">
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
            <input type="text" class="form-control  @error('url') is-invalid @enderror" id="url" name="url"
                required readonly wire:model="url">
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
            <select name="section_id" wire:model="section"
                class="form-control  @error('section_id') is-invalid @enderror">
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
                <label for="parent_id">Sections</label>
                <select name="parent_id" class="form-control  @error('parent_id') is-invalid @enderror">
                    <option value="" selected>Select...</option>
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
