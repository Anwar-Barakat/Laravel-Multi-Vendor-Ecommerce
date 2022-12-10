<div>
    <div class="spinner-grow  spinner-grow-sm {{ $status == '1' ? 'green' : 'red' }}" role="status">
        <span class="sr-only">Loading...</span>
    </div>
    <span class="text text-{{ $status == '1' ? 'success' : 'danger' }} cursor-pointer" wire:click="updateStatus({{ $section_id }})">
        {{ $status == '1' ? 'Active' : 'Inactive' }}
    </span>
</div>
