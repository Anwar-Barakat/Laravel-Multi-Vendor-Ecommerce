<div class="tab-pane fade" id="rating" wire:ignore.self>
    <div class="review-whole-container">
        <div class="row r-1 u-s-m-b-26 u-s-p-b-22">
            <div class="col-lg-6 col-md-6">
                <div class="total-score-wrapper">
                    <h6 class="review-h6">Average Rating</h6>
                    <div class="circle-wrapper">
                        <h1>{{ round($average_rating, 1) }}</h1>
                    </div>
                    <h6 class="review-h6">Based on {{ $rating_count ?? 0 }} Reviews</h6>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="total-star-meter">
                    <div class="star-wrapper ">
                        <span class="flex justify-between">
                            <span style="width: 40%" class="flex justify-end">Reviews ({{ App\Models\ProductRating::where(['product_id' => $product_id, 'rating' => 1])->count() }})</span>
                            <span class="w-50 flex items-center justify-start gap-1">
                                <i class="fas fa-star text-warning"></i>
                                <i class="far fa-star text-secondary"></i>
                                <i class="far fa-star text-secondary"></i>
                                <i class="far fa-star text-secondary"></i>
                                <i class="far fa-star text-secondary"></i>
                            </span>
                        </span>

                        <span class="flex justify-between">
                            <span style="width: 40%" class="flex justify-end">Reviews ({{ App\Models\ProductRating::where(['product_id' => $product_id, 'rating' => 2])->count() }})</span>
                            <span class="w-50 flex items-center justify-start gap-1">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="far fa-star text-secondary"></i>
                                <i class="far fa-star text-secondary"></i>
                                <i class="far fa-star text-secondary"></i>
                            </span>
                        </span>

                        <span class="flex justify-between">
                            <span style="width: 40%" class="flex justify-end">Reviews ({{ App\Models\ProductRating::where(['product_id' => $product_id, 'rating' => 3])->count() }})</span>
                            <span class="w-50 flex items-center justify-start gap-1">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="far fa-star text-secondary"></i>
                                <i class="far fa-star text-secondary"></i>
                            </span>
                        </span>

                        <span class="flex justify-between">
                            <span style="width: 40%" class="flex justify-end">Reviews ({{ App\Models\ProductRating::where(['product_id' => $product_id, 'rating' => 4])->count() }})</span>
                            <span class="w-50 flex items-center justify-start gap-1">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="far fa-star text-secondary"></i>
                            </span>
                        </span>

                        <span class="flex justify-between">
                            <span style="width: 40%" class="flex justify-end">Reviews ({{ App\Models\ProductRating::where(['product_id' => $product_id, 'rating' => 5])->count() }})</span>
                            <span class="w-50 flex items-center justify-start gap-1">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row r-2 u-s-m-b-26 u-s-p-b-22">
            <div class="col-lg-12">
                <div class="your-rating-wrapper">
                    <h6 class="review-h6">Your Review is matter.</h6>
                    <h6 class="review-h6">Have you used this product before?</h6>
                    <form id="rating-form">
                        <div class="star-wrapper mb-3">
                            <span class="star__container mb-0">
                                <input type="radio" name="rating" value="1" id="star-01" class="star__radio visuhide" wire:model="rating">
                                <input type="radio" name="rating" value="2" id="star-02" class="star__radio visuhide" wire:model="rating">
                                <input type="radio" name="rating" value="3" id="star-03" class="star__radio visuhide" wire:model="rating">
                                <input type="radio" name="rating" value="4" id="star-04" class="star__radio visuhide" wire:model="rating">
                                <input type="radio" name="rating" value="5" id="star-05" class="star__radio visuhide" wire:model="rating">

                                <label class="star__item" for="star-01"><span class="visuhide">1 star</span></label>
                                <label class="star__item" for="star-02"><span class="visuhide">2 stars</span></label>
                                <label class="star__item" for="star-03"><span class="visuhide">3 stars</span></label>
                                <label class="star__item" for="star-04"><span class="visuhide">4 stars</span></label>
                                <label class="star__item" for="star-05"><span class="visuhide">5 stars</span></label>
                            </span>
                            @error('rating')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <x-label for="review" :value="__('Review')" />
                                <textarea id="review" class="text-field shadow-none pt-2" rows="5" required style="height: 130px;" wire:model="review"></textarea>
                                @error('review')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>


                        <button class="button button-outline-secondary" type="submit" wire:click.prevent="addRating">
                            Submit Review
                        </button>
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
                            <select class="select-box" id="review-sort" wire:model='sortBy'>
                                <option value="desc">Sort by: Best Rating</option>
                                <option value="asc">Sort by: Worst Rating</option>
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
