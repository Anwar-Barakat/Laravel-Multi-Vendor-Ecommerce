<div>
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Cart</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ route('front.home') }}">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="javascriot:;">Shopping Cart</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Cart-Page -->
    <div class="page-cart u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form>
                        <!-- Products-List-Wrapper -->
                        <div class="table-wrapper u-s-m-b-60">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Size</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse (Cart::instance('cart')->content() as $item)
                                        <tr class="hover:shadow-lg transition">
                                            <td>
                                                <div class="cart-anchor-image">
                                                    <a class="d-flex align-items-center gap-2" href="{{ route('front.product.detail', ['productId' => $item->model->id]) }}">
                                                        <img src="{{ $item->model->getFirstMediaUrl('main_img_of_product', 'small') }}" alt="{{ $item->model->name }}" loading="lazy" class="img img-thumbnail" />
                                                        <h6 class="grid">
                                                            <span>{{ ucwords($item->model->name) }}</span>
                                                            <span>{{ $item->model->code }} -
                                                                {{ $item->model->color }}
                                                            </span>
                                                        </h6>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="cart-price">
                                                    {{ $item->options['size'] }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="cart-price">
                                                    ${{ $item->price }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="cart-quantity">
                                                    <div class="quantity">
                                                        <input type="text" class="quantity-text-field" value="{{ $item->qty }}">
                                                        <a href="#" class="plus-a" data-max="1000" wire:click.prevent="increaseQty('{{ $item->rowId }}')">&#43;</a>
                                                        <a href="#" class="minus-a" data-min="1" wire:click.prevent="decreaseQty('{{ $item->rowId }}')">&#45;</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="action-wrapper">
                                                    <button class=" button button-outline-secondary fas fa-trash hover:text-red-600 border-red-600" wire:click.prevent="deleteItem('{{ $item->rowId }}')"></button>
                                                </div>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="5">
                                                <div class="cart-price">
                                                    No items yet !!
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="coupon-continue-checkout u-s-m-b-60">
                            <div class="coupon-area">
                                <h6>Enter your coupon code if you have one.</h6>
                                <div class="coupon-field">
                                    <label class="sr-only" for="coupon-code">Apply Coupon</label>
                                    <input id="coupon-code" type="text" class="text-field" placeholder="Coupon Code" wire:model="couponCode">
                                    <button type="submit" class="button" wire:click.prevent="applyCouponCode">Apply Coupon</button>
                                </div>
                            </div>
                            <div class="button-area">
                                <a href="{{ route('front.shopping.store') }}" class="continue">Continue Shopping</a>
                                <a href="checkout.html" class="checkout">Proceed to Checkout</a>
                            </div>
                        </div>
                    </form>
                    <!-- Billing -->
                    <div class="calculation u-s-m-b-60">
                        <div class="table-wrapper-2">
                            <table>
                                <thead>
                                    <tr>
                                        <th colspan="2">Cart Totals</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Subtotal</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">${{ Cart::instance('cart')->subtotal() }}</span>
                                        </td>
                                    </tr>
                                    @if (session()->has('coupon'))
                                        <tr>
                                            <td>
                                                <h3 class="calc-h3 u-s-m-b-0">Discount ({{ session()->get('coupon')['coupon_code'] }})</h3>
                                            </td>
                                            <td>
                                                <span class="calc-text">${{ $discount }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h3 class="calc-h3 u-s-m-b-0" id="tax-heading">Tax</h3>
                                            </td>
                                            <td>
                                                <span class="calc-text">${{ $taxAfterDiscount }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h3 class="calc-h3 u-s-m-b-0">Subtotal With Discount</h3>
                                            </td>
                                            <td>
                                                <span class="calc-text">${{ $subTotalAfterDiscount }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h3 class="calc-h3 u-s-m-b-0">Total</h3>
                                            </td>
                                            <td>
                                                <span class="calc-text">${{ $totalAfterDiscount }}</span>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>
                                                <h3 class="calc-h3 u-s-m-b-8">Shipping</h3>
                                                <div class="calc-choice-text u-s-m-b-4">Flat Rate: Not Available</div>
                                                <div class="calc-choice-text u-s-m-b-4">Free Shipping: Not Available</div>
                                                <a data-toggle="collapse" href="#shipping-calculation" class="calc-anchor u-s-m-b-4">Calculate Shipping
                                                </a>
                                                <div class="collapse" id="shipping-calculation">
                                                    <form>
                                                        <div class="select-country-wrapper u-s-m-b-8">
                                                            <div class="select-box-wrapper">
                                                                <label class="sr-only" for="select-country">Choose your
                                                                    country
                                                                </label>
                                                                <select class="select-box" id="select-country">
                                                                    <option selected="selected" value="">Choose your
                                                                        country...
                                                                    </option>
                                                                    <option value="">United Kingdom (UK)</option>
                                                                    <option value="">United States (US)</option>
                                                                    <option value="">United Arab Emirates (UAE)
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="select-state-wrapper u-s-m-b-8">
                                                            <div class="select-box-wrapper">
                                                                <label class="sr-only" for="select-state">Choose your
                                                                    state
                                                                </label>
                                                                <select class="select-box" id="select-state">
                                                                    <option selected="selected" value="">Choose your
                                                                        state...
                                                                    </option>
                                                                    <option value="">Alabama</option>
                                                                    <option value="">Alaska</option>
                                                                    <option value="">Arizona</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="town-city-div u-s-m-b-8">
                                                            <label class="sr-only" for="town-city"></label>
                                                            <input type="text" id="town-city" class="text-field" placeholder="Town / City">
                                                        </div>
                                                        <div class="postal-code-div u-s-m-b-8">
                                                            <label class="sr-only" for="postal-code"></label>
                                                            <input type="text" id="postal-code" class="text-field" placeholder="Postcode / Zip">
                                                        </div>
                                                        <div class="update-totals-div u-s-m-b-8">
                                                            <button class="button button-outline-platinum">Update
                                                                Totals</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </td>
                                            <td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h3 class="calc-h3 u-s-m-b-0" id="tax-heading">Tax</h3>
                                                <span> (estimated for your country)</span>
                                            </td>
                                            <td>
                                                <span class="calc-text">${{ Cart::instance('cart')->tax() }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h3 class="calc-h3 u-s-m-b-0">Total</h3>
                                            </td>
                                            <td>
                                                <span class="calc-text">${{ Cart::instance('cart')->total() }}</span>
                                            </td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Billing /- -->
                </div>
            </div>
        </div>
    </div>
</div>
