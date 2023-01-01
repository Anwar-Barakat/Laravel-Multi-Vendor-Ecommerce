<div class="table-responsive">
    <form>
        <div class="form-group">
            <select class="form-control" wire:model="status">
                @foreach (App\Models\Order::STATUSES as $status)
                    <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <button class="btn btn-primary" type="submit" wire:click.prevent="updateStatus">
                <i class="fas fa-edit"></i> Update
            </button>
        </div>
    </form>
</div>
