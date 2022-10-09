<div>
    <div class="modal fade" id="delete{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="deleteLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteLabel">
                        {{ $title }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ $action }}">
                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
                        <div class="row">
                            <div class="col">
                                <h5>{{ ucwords('are sure of the deleting process ?') }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer m-2">
                        <button type="button" class="btn btn-secondary-gradient" data-dismiss="modal"><i
                                class="fas fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-danger-gradient"> <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
