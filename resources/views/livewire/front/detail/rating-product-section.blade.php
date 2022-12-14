<div class="tab-pane fade" id="review" wire:ignore>
    <div class="review-whole-container">
        <div class="row r-1 u-s-m-b-26 u-s-p-b-22">
            <div class="col-lg-6 col-md-6">
                <div class="total-score-wrapper">
                    <h6 class="review-h6">Average Rating</h6>
                    <div class="circle-wrapper">
                        <h1>4.5</h1>
                    </div>
                    <h6 class="review-h6">Based on 23 Reviews</h6>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="total-star-meter">
                    <div class="star-wrapper">
                        <span>5 Stars</span>
                        <div class="star">
                            <span style='width:0'></span>
                        </div>
                        <span>(0)</span>
                    </div>
                    <div class="star-wrapper">
                        <span>4 Stars</span>
                        <div class="star">
                            <span style='width:67px'></span>
                        </div>
                        <span>(23)</span>
                    </div>
                    <div class="star-wrapper">
                        <span>3 Stars</span>
                        <div class="star">
                            <span style='width:0'></span>
                        </div>
                        <span>(0)</span>
                    </div>
                    <div class="star-wrapper">
                        <span>2 Stars</span>
                        <div class="star">
                            <span style='width:0'></span>
                        </div>
                        <span>(0)</span>
                    </div>
                    <div class="star-wrapper">
                        <span>1 Star</span>
                        <div class="star">
                            <span style='width:0'></span>
                        </div>
                        <span>(0)</span>
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
                            @error('rating')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <x-label for="review" :value="__('Review')" />
                                <textarea id="review" class="text-field mb-2 shadow-none pt-2  @error('review') is-invalid @enderror" rows="5" required style="height: 130px;" wire:model="review"></textarea>
                                @error('review')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <button class="button button-outline-secondary" type="submit" wire:click.prevent="addRating">Submit
                            Review</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Get-Reviews -->
        <div class="get-reviews u-s-p-b-22">
            <!-- Review-Options -->
            <div class="review-options u-s-m-b-16">
                <div class="review-option-heading">
                    <h6>Reviews
                        <span> (15) </span>
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
                <div class="review-data">
                    <div class="reviewer-name-and-date">
                        <h6 class="reviewer-name">John</h6>
                        <h6 class="review-posted-date">10 May 2018</h6>
                    </div>
                    <div class="reviewer-stars-title-body">
                        <div class="reviewer-stars">
                            <div class="star">
                                <span style='width:67px'></span>
                            </div>
                            <span class="review-title">Good!</span>
                        </div>
                        <p class="review-body">
                            Good Quality...!
                        </p>
                    </div>
                </div>
                <div class="review-data">
                    <div class="reviewer-name-and-date">
                        <h6 class="reviewer-name">Doe</h6>
                        <h6 class="review-posted-date">10 June 2018</h6>
                    </div>
                    <div class="reviewer-stars-title-body">
                        <div class="reviewer-stars">
                            <div class="star">
                                <span style='width:67px'></span>
                            </div>
                            <span class="review-title">Well done!</span>
                        </div>
                        <p class="review-body">
                            Cotton is good.
                        </p>
                    </div>
                </div>
                <div class="review-data">
                    <div class="reviewer-name-and-date">
                        <h6 class="reviewer-name">Tim</h6>
                        <h6 class="review-posted-date">10 July 2018</h6>
                    </div>
                    <div class="reviewer-stars-title-body">
                        <div class="reviewer-stars">
                            <div class="star">
                                <span style='width:67px'></span>
                            </div>
                            <span class="review-title">Well done!</span>
                        </div>
                        <p class="review-body">
                            Excellent condition
                        </p>
                    </div>
                </div>
                <div class="review-data">
                    <div class="reviewer-name-and-date">
                        <h6 class="reviewer-name">Johnny</h6>
                        <h6 class="review-posted-date">10 March 2018</h6>
                    </div>
                    <div class="reviewer-stars-title-body">
                        <div class="reviewer-stars">
                            <div class="star">
                                <span style='width:67px'></span>
                            </div>
                            <span class="review-title">Bright!</span>
                        </div>
                        <p class="review-body">
                            Cotton
                        </p>
                    </div>
                </div>
                <div class="review-data">
                    <div class="reviewer-name-and-date">
                        <h6 class="reviewer-name">Alexia C. Marshall</h6>
                        <h6 class="review-posted-date">12 May 2018</h6>
                    </div>
                    <div class="reviewer-stars-title-body">
                        <div class="reviewer-stars">
                            <div class="star">
                                <span style='width:67px'></span>
                            </div>
                            <span class="review-title">Well done!</span>
                        </div>
                        <p class="review-body">
                            Good polyester Cotton
                        </p>
                    </div>
                </div>
            </div>
            <!-- All-Reviews /- -->
            <!-- Pagination-Review -->
            <div class="pagination-review-area">
                <div class="pagination-review-number">
                    <ul>
                        <li style="display: none">
                            <a href="single-product.html" title="Previous">
                                <i class="fas fa-angle-left"></i>
                            </a>
                        </li>
                        <li class="active">
                            <a href="single-product.html">1</a>
                        </li>
                        <li>
                            <a href="single-product.html">2</a>
                        </li>
                        <li>
                            <a href="single-product.html">3</a>
                        </li>
                        <li>
                            <a href="single-product.html">...</a>
                        </li>
                        <li>
                            <a href="single-product.html">10</a>
                        </li>
                        <li>
                            <a href="single-product.html" title="Next">
                                <i class="fas fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Pagination-Review /- -->
        </div>
        <!-- Get-Reviews /- -->
    </div>
</div>
