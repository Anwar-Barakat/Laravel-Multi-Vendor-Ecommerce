@section('title', 'Checkout Page')
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
                                    <tr class="flex justify-between items-center pt-2 pb-2">
                                        <th>
                                            <span>Delivery Addresses</span>
                                        </th>
                                        <th>
                                            <a href="{{ route('front.delivery.addresses.add') }}" class="button button-outline-secondary pt-1 pb-1">
                                                <i class="fas fa-plus"></i>
                                                Add
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset(Auth::user()->deliveryAddresses))
                                        @forelse (Auth::user()->deliveryAddresses as $address)
                                            <tr>
                                                <td>
                                                    <h6 class="text-xs flex align-items-center gap-2 mb-3">
                                                        <input type="radio" id="address{{ $address->id }}" name="deliveryAddress" wire:model="deliveryAddressId" value="{{ $address->id }}">
                                                        <label for="address{{ $address->id }}" class="mb-0">{{ $address->name }}, {{ $address->address }} - {{ $address->city }}, {{ $address->state }}, {{ $address->country->name }}</label>
                                                    </h6>

                                                </td>
                                                <td>
                                                    <a href="{{ route('front.delivery.addresses.edit', ['id' => $address->id]) }}" class=" button button-outline-secondary fas fa-edit hover:text-green-600 border-green-600"></a>
                                                    <button class=" button button-outline-secondary fas fa-trash hover:text-red-600 border-red-600" wire:click.prevent="deleteDeliveryAddress({{ $address->id }})"></button>
                                                </td>
                                            </tr>

                                        @empty
                                            <tr class="text-center">
                                                <td colspan="1">
                                                    <div class="cart-price">
                                                        <a href="">Click Here to Add a New Delivery Address !!</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                        @error('deliveryAddressId')
                                            <tr class="border-top-0">
                                                <td class="text-left">
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        @enderror
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
                                        <tr>
                                            <td>
                                                <div class="cart-anchor-image">
                                                    @php
                                                        $product = App\Models\Product::findOrFail($item->model->id);
                                                    @endphp
                                                    <a href="{{ route('front.product.detail', ['product' => $product]) }}" class="d-flex align-items-center gap-2">
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
                                                <h3 class="calc-h3 u-s-m-b-0">Shipping Charges ({{ $totalWeight ?? 0 }}g Weight)</h3>
                                            </td>
                                            <td>
                                                <span class="calc-text">+ ${{ $shippingChargesValue }}</span>
                                            </td>
                                        </tr>
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
                                                    <span class="calc-text">- ${{ $discount }}</span>
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
                                                    <span class="calc-text">+ ${{ $gstAfterDiscount }}</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <h3 class="calc-h3 u-s-m-b-0">Total</h3>
                                                </td>
                                                <td class="total-amount">
                                                    <span class="calc-text">${{ $totalAfterDiscount + $shippingChargesValue }}</span>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>
                                                    <h3 class="calc-h3 u-s-m-b-0" id="tax-heading">GST (%{{ $productsGST }})</h3>
                                                </td>
                                                <td>
                                                    <span class="calc-text">+ ${{ $finalGST }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h3 class="calc-h3 u-s-m-b-0">Total</h3>
                                                </td>
                                                <td class="total-amount">
                                                    <span class="calc-text">
                                                        ${{ (float) str_replace(',', '', Cart::instance('cart')->subtotal()) + $shippingChargesValue + $finalGST }}
                                                    </span>
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
                                <a href="{{ route('front.shopping.cart') }}" class="continue">Back to Cart</a>
                                <a href="" class="checkout" wire:click.prevent="placeToOrder">Place to Order</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
