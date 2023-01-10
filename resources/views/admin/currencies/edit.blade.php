{{-- Add New Currency Modal --}}
<div class="modal effect-rotate-left" id="edit{{ $currency->id }}" tabindex="-1" role="dialog" aria-labelledby="edit{{ $currency->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Brand</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.currencies.update', $currency) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" value="{{ old('code', $currency->code) }}" class="form-control  @error('code') is-invalid @enderror" id="code" name="code" required autofocus>
                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="exchange_rate">Exchange rate</label>
                                <input type="number" value="{{ old('exchange_rate', $currency->exchange_rate) }}" class="form-control  @error('exchange_rate') is-invalid @enderror" id="exchange_rate" name="exchange_rate" required autofocus>
                                @error('exchange_rate')
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
