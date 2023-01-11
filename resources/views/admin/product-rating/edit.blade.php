{{-- Show Review Body --}}
<div class="modal fade" id="edit{{ $review->id }}" tabindex="-1" role="dialog" aria-labelledby="edit{{ $review->id }}Label" aria-hidden="true" data-effect="effect-super-scaled">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Display The Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Review Body</label>
                    <textarea type="text" class="form-control" id="review" rows="6" readonly disabled>{{ $review->review }}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary-gradient modal-effect" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
