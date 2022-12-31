<div>
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Orders</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ route('front.home') }}">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="javascriot:;">My Orders</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="page-cart u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-wrapper u-s-m-b-60">
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order Products</th>
                                    <th>Payment Method</th>
                                    <th>Final Price</th>
                                    <th>Created at</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr class="hover:shadow-lg transition">
                                        <td>
                                            <div class="cart-price">
                                                {{ $order->id }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="cart-anchor-image">
                                                @foreach ($order->orderProducts as $item)
                                                    <span class="block text-gray-800 text-xs mb-1">{{ $item->product_name }}</span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>
                                            <div class="cart-price">
                                                {{ $order->paymeny_method }}
                                            </div>
                                        </td>
                                        <td class="bg-green-600 ">
                                            <div class="cart-price font-bold text-white">
                                                ${{ $order->final_price }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="cart-price">
                                                {{ $item->created_at }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action-wrapper">
                                                <a class=" button button-outline-secondary fas fa-eye hover:text-yellow-500 border-yellow-500"></a>
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
                </div>
            </div>
        </div>
    </div>
</div>
