<div>
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Checkout</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ route('front.home') }}">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="javascriot:;">Checkout</a>
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
                        <!-- Delivery Addresses -->
                        <div class="table-wrapper u-s-m-b-60">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="flex justify-between align-items-center">
                                            <span>Delivery Addresses</span>
                                            <a href="{{ route('front.delivery.addresses.add') }}" class="custom-btn">Add</a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset(Auth::user()->deliveryAddresses))
                                        @forelse (Auth::user()->deliveryAddresses as $address)
                                            <tr>
                                                <td>
                                                    <h6 class="text-xs flex align-items-center gap-2 mb-3">
                                                        <input type="radio" id="address" wire:model="deliveryAddressId" value="{{ $address->id }}">
                                                        <label for="address" class="mb-0">{{ $address->name }}, {{ $address->address }} - {{ $address->city }}, {{ $address->state }}, {{ $address->country->name }}</label>
                                                    </h6>

                                                </td>
                                                <td>
                                                    <a href="{{ route('front.delivery.addresses.edit', ['id' => $address->id]) }}" class=" button button-outline-secondary fas fa-edit hover:text-green-600 border-green-600"></a>
                                                    <button class=" button button-outline-secondary fas fa-trash hover:text-red-600 border-red-600" wire:click.prevent="deleteDeliveryAddress({{ $address->id }})"></button>
                                                </td>
                                            </tr>
                                            @error('deliveryAddressId')
                                                <tr class="border-top-0">
                                                    <td class="text-left">
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    </td>
                                                </tr>
                                            @enderror
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="1">
                                                    <div class="cart-price">
                                                        <a href="">Click Here to Add a New Delivery Address !!</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- Products-List-Wrapper -->
                        <div class="table-wrapper u-s-m-b-60">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Size</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
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
                                                        <input type="text" class="quantity-text-field" value="{{ $item->qty }}" readonly>
                                                    </div>
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
                                                <td class="total-amount">
                                                    <span class="calc-text">${{ $totalAfterDiscount }}</span>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>
                                                    <h3 class="calc-h3 u-s-m-b-0" id="tax-heading">Tax</h3>
                                                    <span></span>
                                                </td>
                                                <td>
                                                    <span class="calc-text">${{ Cart::instance('cart')->tax() }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h3 class="calc-h3 u-s-m-b-0">Total</h3>
                                                </td>
                                                <td class="total-amount">
                                                    <span class="calc-text">${{ Cart::instance('cart')->total() }}</span>
                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="flex">
                                                <h3 class="calc-h3 u-s-m-b-0">Payment Methods</h3>
                                            </td>
                                            <td>
                                                <span class="calc-text">
                                                    <label for="cod" class="flex align-items-center gap-2">
                                                        <input type="radio" wire:model="payment_gateway" name="payment_gateway" id="cod" value="COD">
                                                        <img src="{{ asset('front/images/payment_methods/cod.png') }}" alt="" width="100">
                                                    </label>
                                                </span>
                                                <span class="calc-text">
                                                    <label for="paypal" class="flex align-items-center gap-2">
                                                        <input type="radio" wire:model="payment_gateway" name="payment_gateway" id="paypal" value="PAYPAL">
                                                        <img src="{{ asset('front/images/payment_methods/paypal.png') }}" alt="" width="100">
                                                    </label>
                                                </span>
                                            </td>
                                        </tr>
                                        @error('payment_gateway')
                                            <tr class="border-top-0">
                                                <td class="text-left">
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        @enderror
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Billing /- -->

                        <div class="coupon-continue-checkout u-s-m-b-60">
                            <div class="button-area">
                                <a href="{{ route('front.shopping.store') }}" class="continue">Back to Cart</a>
                                <a href="javascript:;" class="checkout" wire:click.prevent="placeToOrder">Place to Order</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
