{{-- Add New Brand Modal --}}
<div class="modal effect-rotate-left" id="edit{{ $cms_page->id }}" tabindex="-1" role="dialog" aria-labelledby="edit{{ $cms_page->id }}" aria-hidden="true">
    <div class="modal-dialog wider lg:max-w-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Page</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.cms-pages.update', ['cms_page' => $cms_page]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" value="{{ old('title', $cms_page->title) }}" class="form-control  @error('title') is-invalid @enderror" id="title" name="title" required autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" value="{{ old('description', $cms_page->description) }}" class="form-control  @error('description') is-invalid @enderror" id="description" name="description" required autofocus>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" value="{{ old('meta_title', $cms_page->meta_title) }}" class="form-control  @error('meta_title') is-invalid @enderror" id="meta_title" name="meta_title" required autofocus>
                                @error('meta_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <input type="text" value="{{ old('meta_description', $cms_page->meta_description) }}" class="form-control  @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" required autofocus>
                                @error('meta_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="meta_keywords">Meta Keywords</label>
                                <input type="text" value="{{ old('meta_keywords', $cms_page->meta_keywords) }}" class="form-control  @error('meta_keywords') is-invalid @enderror" id="meta_keywords" name="meta_keywords" required autofocus>
                                @error('meta_keywords')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary-gradient" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary-gradient">
                            <i class="fas fa-save"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
