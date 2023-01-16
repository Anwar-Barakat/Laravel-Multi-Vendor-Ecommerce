<div>
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Order Details</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ route('front.home') }}">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="javascriot:;">Order Details</a>
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
                    @if ($order->order_status == 'New')
                        <div class="mb-3">
                            <button role="button" data-toggle="modal" title="cancelOrder" data-target="#cancelOrder{{ $order->id }}" class="button button-primary">
                                <i class="fas fa-times"></i>
                                Cancel Order
                            </button>
                            <!-- Modal -->
                            <div wire:ignore.self class="modal fade" id="cancelOrder{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="cancelOrder{{ $order->id }}Label" aria-hidden="true" data-effect="effect-super-scaled" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                <div class="modal-dialog order" role="document">
                                    <form>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Cancel This Order</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="u-s-m-b-30">
                                                    <label for="cancelled_reason">Reason For Cancellation</label>
                                                    <select class="text-field @error('cancelled_reason') is-invalid @enderror" id="cancelled_reason" wire:model="cancelled_reason" required>
                                                        <option value="">Select..</option>
                                                        @foreach (App\Models\OrderLog::CANCELLEDREASONS as $key => $reason)
                                                            <option value="{{ $key }}">{{ $reason }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('cancelled_reason')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="button  btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="button  button-primary" wire:click.prevent='orderCancel' data-dismiss="modal">
                                                    <i class="fas fa-times"></i> Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($order->order_status == 'Delivered')
                        <div class="mb-3">
                            <button role="button" data-toggle="modal" title="returnOrder" data-target="#returnOrder{{ $order->id }}" class="button button-primary">
                                <i class="fas fa-recycle"></i>
                                Return / Exchange Order
                            </button>
                            <!-- Modal -->
                            <div wire:ignore.self class="modal fade" id="returnOrder{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="returnOrder{{ $order->id }}Label" aria-hidden="true" data-effect="effect-super-scaled" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                <div class="modal-dialog order" role="document" style="max-width: 600px">
                                    <form>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{ ucwords($return_exchange_text) }} This Order</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">

                                                    <div class="u-s-m-b-30 col-lg-6">
                                                        <label for="return_exchange">Select Return Or Exchange</label>
                                                        <select class="text-field @error('return_exchange') is-invalid @enderror" id="return_exchange" wire:model="return_exchange" required>
                                                            <option value="">Select...</option>
                                                            <option value="return">Return</option>
                                                            <option value="exchange">Exchange</option>
                                                        </select>
                                                        @error('return_exchange')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="u-s-m-b-30 col-lg-6">
                                                        <label for="product_info">Select Product</label>
                                                        <select class="text-field @error('product_info') is-invalid @enderror" id="product_info" wire:model="product_info" required>
                                                            <option value="">Select..</option>
                                                            @foreach ($order->orderProducts as $item)
                                                                @if ($item->product_status != 'Return Initiated')
                                                                    <option value="{{ $item->product_code }}-{{ $item->product_size }}">
                                                                        {{ $item->product_name }} - {{ $item->product_code }} - {{ $item->product_size }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('product_info')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                @if ($return_exchange_text == 'exchange' && $prodAttr != '')
                                                    <div class="u-s-m-b-30">
                                                        <label for="required_size">Required Size</label>
                                                        <select class="text-field @error('required_size') is-invalid @enderror" id="required_size" wire:model="required_size" required>
                                                            <option value="">Select..</option>
                                                            @forelse ($prodAttr as $attr)
                                                                <option value="{{ $attr }}">{{ $attr }}</option>
                                                            @empty
                                                                <option value="">No Sizes</option>
                                                            @endforelse
                                                        </select>
                                                        @error('required_size')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                @endif
                                                <div class="u-s-m-b-30">
                                                    <label for="reason">{{ ucwords($return_exchange_text) }} Reason</label>
                                                    <select class="text-field @error('reason') is-invalid @enderror" id="reason" wire:model="reason" required>
                                                        <option value="">Select..</option>
                                                        @foreach (App\Models\ReturnRequest::RETURNREASONS as $key => $reason)
                                                            <option value="{{ $key }}">{{ $reason }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('reason')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="u-s-m-b-30">
                                                    <label for="comment">Comment</label>
                                                    <textarea id="comment" cols="30" rows="4" class="text-field resize-none pt-2 @error('comment') is-invalid @enderror" wire:model="comment" required></textarea>
                                                    @error('comment')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="button  btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="button  button-primary" wire:click.prevent='returnOrExchangeRequest' data-dismiss="modal">
                                                    <i class="fas fa-recycle"></i> {{ ucwords($return_exchange_text) }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="table-wrapper u-s-m-b-60">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product Image</th>
                                    <th>Product Size</th>
                                    <th>Product Price</th>
                                    <th>Product Quantity</th>
                                    <th>Product Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderProducts as $item)
                                    @php
                                        $product = App\Models\Product::findOrFail($item->product_id);
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="cart-anchor-image">
                                                <a class="d-flex align-items-center gap-2" href="{{ route('front.product.detail', ['product' => $product]) }}">
                                                    <img src="{{ $product->getFirstMediaUrl('main_img_of_product', 'small') }}" alt="{{ $item->product_name }}" loading="lazy" class="img img-thumbnail" />
                                                    <h6 class="grid">
                                                        <span>{{ ucwords($item->product_name) }}</span>
                                                        <span>{{ $item->product_code }} -
                                                            {{ $item->product_color }}
                                                        </span>
                                                    </h6>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="cart-price">
                                                {{ $item->product_size }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="cart-price">
                                                ${{ $item->product_price }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="cart-quantity">
                                                <div class="quantity">
                                                    <input type="text" class="quantity-text-field" value="{{ $item->product_qty }}" readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="cart-price">
                                                {{ $item->product_status ?? '-' }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row justify-between">
                <div class="col-lg-6">
                    <div class="calculation u-s-m-b-60 ml-0">
                        <div class="table-wrapper-2">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th colspan="2">
                                            <span>Delivery Addresses</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Name </h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->name }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Email </h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->email }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Address </h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->address }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Mobile</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->mobile }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">City</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->city }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">State</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->state }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Country</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->country->name }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Shipping Charges</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">${{ $order->shipping_charges }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="calculation u-s-m-b-60">
                        <div class="table-wrapper-2">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th colspan="2">
                                            <span>Order Details</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Status</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->order_status }}</span>
                                        </td>
                                    </tr>
                                    @if ($order->order_status == 'Shipped')
                                        <tr>
                                            <td>
                                                <h3 class="calc-h3 u-s-m-b-0">Tracking Number </h3>
                                            </td>
                                            <td>
                                                <span class="calc-text">{{ $order->tracking_number }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h3 class="calc-h3 u-s-m-b-0">Courier Name </h3>
                                            </td>
                                            <td>
                                                <span class="calc-text">{{ $order->courier_name }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Paymeny Method</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->paymeny_method }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Payment Gateway</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->paymeny_method }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Final Price</h3>
                                        </td>
                                        <td class="bg-green-700">
                                            <span class="calc-text font-bold text-white">${{ $order->final_price }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Coupon Code</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->coupon_code ?? '' }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Coupon Amount</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->coupon_amount ?? '' }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
