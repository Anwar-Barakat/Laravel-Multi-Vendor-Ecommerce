<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">Edit Coupon</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            <div class="card-body">
                <form class="form-horizontal">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="coupon_option">Coupon Option</label>
                                <select wire:model="coupon_option" class="form-control  @error('coupon_option') is-invalid @enderror">
                                    <option value="" selected>Select...</option>
                                    <option value="manual">Manual</option>
                                    <option value="automatic">Automatic</option>
                                </select>
                                @error('coupon_option')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @if ($available == true)
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <label for="coupon_code">Coupon Code</label>
                                    <input type="text" class="form-control  @error('coupon_code') is-invalid @enderror" id="coupon_code" wire:model="coupon_code">
                                    @error('coupon_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="categories">Categories</label>
                                <select wire:model="categories" class=" @error('categories') is-invalid @enderror form-control select" multiple>
                                    @foreach ($sections as $section)
                                        <optgroup label="{{ ucwords(str_replace('-', ' ', $section->name)) }}">
                                        </optgroup>
                                        @foreach ($section->categories as $category)
                                            <option value="{{ $category->id }}">
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ ucwords(str_replace('-', ' ', $category->name)) }}
                                            </option>
                                            @foreach ($category->subCategories as $subCategory)
                                                <option value="{{ $subCategory->id }}">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;
                                                    {{ ucwords(str_replace('-', ' ', $subCategory->name)) }}
                                                </option>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </select>
                                @error('categories')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="users">Users</label>
                                <select wire:model="users" class=" @error('users') is-invalid @enderror form-control select" multiple>
                                    @foreach ($activeUsers as $user)
                                        <option value="{{ $user->id }}">
                                            {{ $user->email }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('users')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="coupon_type">Coupon Type</label>
                                <select wire:model="coupon_type" class="form-control  @error('coupon_type') is-invalid @enderror">
                                    <option value="" selected>Select...</option>
                                    <option value="single">Single Time</option>
                                    <option value="multiple">Multiple Time</option>
                                </select>
                                @error('coupon_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <label for="amount">Amount</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input aria-label="Amount (to the nearest dollar)" wire:model="amount" class="form-control  @error('amount') is-invalid @enderror" type="number">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="amount_type">Amount Type</label>
                                <select wire:model="amount_type" class="form-control  @error('amount_type') is-invalid @enderror">
                                    <option value="" selected>Select...</option>
                                    <option value="fixed">Fixed ($)</option>
                                    <option value="percentage">Percentage</option>
                                </select>
                                @error('amount_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="input-group-prepend">
                                <label for="">Expiry Date</label>
                            </div>
                            <input class="form-control fc-datepicker @error('expiry_date') is-invalid @enderror" placeholder="MM/DD/YYYY" type="date" wire:model="expiry_date">
                            @error('expiry_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="form-group mb-0 mt-3 justify-content-end">
                        <div>
                            <button type="submit" wire:click.prevent="update" class="btn btn-primary-gradient">
                                <i class="fas fa-edit"></i> Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
