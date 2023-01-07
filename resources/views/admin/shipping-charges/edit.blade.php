<div class="modal fade" id="editshippingCharges{{ $shippingCharges->id }}" tabindex="-1" role="dialog" aria-labelledby="editshippingCharges{{ $shippingCharges->id }}Label" aria-hidden="true" data-effect="effect-super-scaled">
    <div class="modal-dialog" role="document" style="max-width: 750px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Update Shipping Charges</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.shipping-charges.update', ['shipping_charge' => $shippingCharges]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12 col-xl-6">
                            <div class="form-group">
                                <label for="country_id">Country</label>
                                <input type="text" class="form-control" value="{{ $shippingCharges->country->name }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12 col-xl-6">
                            <div class="form-group">
                                <label for="zero_500g">Shipping Charges
                                    (0-500g)
                                </label>
                                <input type="number" class="form-control  @error('zero_500g') is-invalid @enderror" id="zero_500g" name="zero_500g" value="{{ old('zero_500g', $shippingCharges->zero_500g) }}">
                                @error('zero_500g')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xl-6">
                            <div class="form-group">
                                <label for="_501_1000g"> Shipping Charges(501-1000g)</label>
                                <input type="number" class="form-control  @error('_501_1000g') is-invalid @enderror" id="_501_1000g" name="_501_1000g" value="{{ old('_501_1000g', $shippingCharges->_501_1000g) }}">
                                @error('_501_1000g')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 col-xl-6">
                            <div class="form-group">
                                <label for="_1001_2000g">Shipping Charges (1001-2000g)</label>
                                <input type="number" class="form-control  @error('_1001_2000g') is-invalid @enderror" id="_1001_2000g" name="_1001_2000g" value="{{ old('_1001_2000g', $shippingCharges->_1001_2000g) }}">
                                @error('_1001_2000g')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xl-6">
                            <div class="form-group">
                                <label for="_2001_5000g">Shipping Charges(2001-5000g)
                                </label>
                                <input type="number" class="form-control  @error('_2001_5000g') is-invalid @enderror" id="_2001_5000g" name="_2001_5000g" value="{{ old('_2001_5000g', $shippingCharges->_2001_5000g) }}">
                                @error('_2001_5000g')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 col-xl-6">
                            <div class="form-group">
                                <label for="above_5000g">Shipping Charges(Above 5000g)</label>
                                <input type="number" class="form-control  @error('above_5000g') is-invalid @enderror" id="above_5000g" name="above_5000g" value="{{ old('above_5000g', $shippingCharges->above_5000g) }}">
                                @error('above_5000g')
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
                            <i class="fas fa-edit"></i> update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
