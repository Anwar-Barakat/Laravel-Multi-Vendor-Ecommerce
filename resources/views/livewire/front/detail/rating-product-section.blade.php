<div class="tab-pane fade" id="review" wire:ignore>
    <div class="review-whole-container">
        <div class="row r-1 u-s-m-b-26 u-s-p-b-22">
            <div class="col-lg-6 col-md-6">
                <div class="total-score-wrapper">
                    <h6 class="review-h6">Average Rating</h6>
                    <div class="circle-wrapper">
                        <h1>{{ $average_rating }}</h1>
                    </div>
                    <h6 class="review-h6">Based on {{ $rating_count ?? 0 }} Reviews</h6>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="total-star-meter">
                    @foreach ($reviews as $review)
                        <div class="star-wrapper">
                            <span class="inline-flex justify-content-start w-1/4">{{ $review->rating }} Stars</span>
                            <span class=" inline-flex justify-content-end w-1/4">
                                @php
                                    $count = 1;
                                @endphp
                                @while ($count <= $review->rating)
                                    <span class="text-yellow-500 font-bold text-lg">&#9733;</span>
                                    @php
                                        $count++;
                                    @endphp
                                @endwhile
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row r-2 u-s-m-b-26 u-s-p-b-22">
            <div class="col-lg-12">
                <div class="your-rating-wrapper">
                    <h6 class="review-h6">Your Review is matter.</h6>
                    <h6 class="review-h6">Have you used this product before?</h6>
                    <form id="rating-form">
                        <div class="star-wrapper">
                            <span class="star__container">
                                <input type="radio" name="rating" value="1" id="star-1" class="star__radio visuhide" wire:model="rating">
                                <input type="radio" name="rating" value="2" id="star-2" class="star__radio visuhide" wire:model="rating">
                                <input type="radio" name="rating" value="3" id="star-3" class="star__radio visuhide" wire:model="rating">
                                <input type="radio" name="rating" value="4" id="star-4" class="star__radio visuhide" wire:model="rating">
                                <input type="radio" name="rating" value="5" id="star-5" class="star__radio visuhide" wire:model="rating">

                                <label class="star__item" for="star-1"><span class="visuhide">1 star</span></label>
                                <label class="star__item" for="star-2"><span class="visuhide">2 stars</span></label>
                                <label class="star__item" for="star-3"><span class="visuhide">3 stars</span></label>
                                <label class="star__item" for="star-4"><span class="visuhide">4 stars</span></label>
                                <label class="star__item" for="star-5"><span class="visuhide">5 stars</span></label>
                            </span>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <x-label for="email" :value="__('Review')" />
                                <textarea id="email" class="text-field mb-2 shadow-none pt-2" rows="5" required style="height: 130px;" wire:model="review"></textarea>
                            </div>
                        </div>


                        <button class="button button-outline-secondary" type="submit" wire:click.prevent="addRating">Submit
                            Review</button>
                    </form>
                </div>
            </div>
        </div>
        @if ($reviews->count() > 0 && isset($reviews))
            <!-- Get-Reviews -->
            <div class="get-reviews u-s-p-b-22">
                <!-- Review-Options -->
                <div class="review-options u-s-m-b-16">
                    <div class="review-option-heading">
                        <h6>Reviews
                            <span> ({{ $reviews->count() }}) </span>
                        </h6>
                    </div>
                    <div class="review-option-box">
                        <div class="select-box-wrapper">
                            <label class="sr-only" for="review-sort">Review Sorter</label>
                            <select class="select-box" id="review-sort">
                                <option value="">Sort by: Best Rating</option>
                                <option value="">Sort by: Worst Rating</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Review-Options /- -->
                <!-- All-Reviews -->
                <div class="reviewers">
                    @foreach ($reviews as $review)
                        <div class="review-data pt-1">
                            <div class="reviewer-name-and-date">
                                <h6 class="reviewer-name">{{ $review->user->name }}</h6>
                                <h6 class="review-posted-date">{{ $review->created_at }}</h6>
                            </div>
                            <div class="reviewer-stars-title-body">
                                @php
                                    $count = 1;
                                @endphp
                                @while ($count <= $review->rating)
                                    <span class="text-yellow-500 font-bold text-lg">&#9733;</span>
                                    @php
                                        $count++;
                                    @endphp
                                @endwhile
                                <p class="review-body">
                                    {{ $review->review }}
                                </p>
                            </div>
                        </div>
                    @endforeach

                </div>
                <!-- All-Reviews /- -->
                <!-- Pagination-Review -->
                {{-- {{ $reviews->links() }} --}}
                <!-- Pagination-Review /- -->
            </div>
            <!-- Get-Reviews /- -->
        @endif
    </div>
</div>

<style>
    .visuhide {
        position: absolute !important;
        overflow: hidden;
        width: 1px;
        height: 1px;
        clip: rect(1px, 1px, 1px, 1px);
    }

    .star__container:hover .star__item,
    .star__radio:checked~.star__item {
        filter: grayscale(0);
    }

    .star__item:hover~.star__item,
    .star__item,
    .star__container:not(:hover)>.star__radio:nth-of-type(5):checked~.star__item:nth-of-type(5)~.star__item,
    .star__container:not(:hover)>.star__radio:nth-of-type(4):checked~.star__item:nth-of-type(4)~.star__item,
    .star__container:not(:hover)>.star__radio:nth-of-type(3):checked~.star__item:nth-of-type(3)~.star__item,
    .star__container:not(:hover)>.star__radio:nth-of-type(2):checked~.star__item:nth-of-type(2)~.star__item,
    .star__container:not(:hover)>.star__radio:nth-of-type(1):checked~.star__item:nth-of-type(1)~.star__item {
        filter: grayscale(1);
    }

    .star__radio:nth-of-type(1):checked~.star__item:nth-of-type(1)::before {
        transform: scale(1.5);
        transition-timing-function: cubic-bezier(0.5, 1.5, 0.25, 1);
    }

    .star__radio:nth-of-type(2):checked~.star__item:nth-of-type(2)::before {
        transform: scale(1.5);
        transition-timing-function: cubic-bezier(0.5, 1.5, 0.25, 1);
    }

    .star__radio:nth-of-type(3):checked~.star__item:nth-of-type(3)::before {
        transform: scale(1.5);
        transition-timing-function: cubic-bezier(0.5, 1.5, 0.25, 1);
    }

    .star__radio:nth-of-type(4):checked~.star__item:nth-of-type(4)::before {
        transform: scale(1.5);
        transition-timing-function: cubic-bezier(0.5, 1.5, 0.25, 1);
    }

    .star__radio:nth-of-type(5):checked~.star__item:nth-of-type(5)::before {
        transform: scale(1.5);
        transition-timing-function: cubic-bezier(0.5, 1.5, 0.25, 1);
    }

    .star__container {
        display: flex;
        border-radius: 0.25em;
        background-color: #00a39b;
        box-shadow: 0 0.25em 1em rgb(0 0 0 / 25%);
        transition: box-shadow 0.3s ease;
        justify-content: center;
        margin: 1rem 0;
    }

    .star__container:focus-within {
        box-shadow: 0 0.125em 0.5em rgba(0, 0, 0, 0.5);
    }

    .star__item {
        display: inline-flex;
        width: 1.25em;
        height: 1.5em;
    }

    .star__item::before {
        content: "⭐️";
        display: inline-block;
        margin: auto;
        font-size: 0.75em;
        vertical-align: top;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        transform-origin: 50% 33.3%;
        transition: transform 0.3s ease-out;
    }

    #rating-form .star__container label {
        font-size: 25px;
    }
</style>
