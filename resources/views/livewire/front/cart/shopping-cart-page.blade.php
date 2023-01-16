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
                                        <tr>
                                            <td>
                                                <div class="cart-anchor-image">
                                                    @php
                                                        $product = App\Models\Product::findOrFail($item->model->id);
                                                    @endphp
                                                    <a class="d-flex align-items-center gap-2" href="{{ route('front.product.detail', ['product' => $product]) }}">
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

                        <!-- Billing -->
                        <div class="calculation u-s-m-b-60">
                            <div class="table-wrapper-2">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h3 class="calc-h3 u-s-m-b-0">Subtotal</h3>
                                            </td>
                                            <td>
                                                <span class="calc-text">${{ $final_price }}</span>
                                            </td>
                                        </tr>
                                        @if (session()->has('coupon'))
                                            <tr>
                                                <td>
                                                    <h3 class="calc-h3 u-s-m-b-0">Discount ({{ session()->get('coupon')['coupon_code'] }})</h3>
                                                </td>
                                                <td>
                                                    <span class="calc-text">-${{ $discount }}</span>
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
                                                    <h3 class="calc-h3 u-s-m-b-0" id="tax-heading">GST (%{{ $productsGST }})</h3>
                                                </td>
                                                <td>
                                                    <span class="calc-text">+${{ $gstAfterDiscount }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h3 class="calc-h3 u-s-m-b-0">Total</h3>
                                                </td>
                                                <td class="total-amount">
                                                    <span class="calc-text">${{ $totalAfterDiscount }}</span>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>
                                                    <h3 class="calc-h3 u-s-m-b-0" id="tax-heading">GST (%{{ $productsGST }})</h3>
                                                </td>
                                                <td>
                                                    <span class="calc-text">${{ $finalGST }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h3 class="calc-h3 u-s-m-b-0">Total</h3>
                                                </td>
                                                <td class="total-amount">
                                                    <span class="calc-text">${{ $final_price + $finalGST }}</span>
                                                </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Billing /- -->

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
                                <a href="javascript:;" class="checkout" wire:click="proccedToCheckout">Proceed to Checkout</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
