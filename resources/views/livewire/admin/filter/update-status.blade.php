<div>
    <div class="spinner-grow  spinner-grow-sm {{ $status == '1' ? 'green' : 'red' }}" role="status">
        <span class="sr-only">Loading...</span>
    </div>
    <span class="text text-{{ $status == '1' ? 'success' : 'danger' }}" wire:click="updateStatus({{ $filter_id }})"
        style="cursor: pointer">
        {{ $status == '1' ? 'Active' : 'Inactive' }}
    </span>
</div>
