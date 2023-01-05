<div class="table-responsive">
    <form>
        <div class="form-group">
            <select class="form-control" wire:model="status">
                @foreach (App\Models\Order::STATUSES as $status)
                    <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
            </select>
        </div>

        @if ($courierAndTracking)
            <div class="row mb-4">
                <div class="col-md-12 col-lg-6">
                    <div class="form-group">
                        <x-label for="courier_name" :value="__('Courier Name')" />
                        <x-input id="courier_name" class="form-control" type="text" wire:model="courier_name" />
                        @error('courier_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="form-group">
                        <x-label for="tracking_number" :value="__('Tracking Number')" />
                        <x-input id="tracking_number" class="form-control" type="text" wire:model="tracking_number" />
                        @error('tracking_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        @endif

        <div class="form-group">
            <button class="btn btn-primary" type="submit" wire:click.prevent="updateOrderStatus">
                <i class="fas fa-edit"></i> Update
            </button>
        </div>


    </form>
</div>
