<div>
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Wishlist</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="index.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="wishlist.html">Wishlist</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Wishlist-Page -->
    <div class="page-wishlist u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Products-List-Wrapper -->
                    <div class="table-wrapper u-s-m-b-60">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Unit Price</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse (Cart::instance('wishlist')->content() as $item)
                                    <tr class="hover:shadow-lg transition">
                                        <td>
                                            <div class="cart-anchor-image">
                                                <a
                                                    href="{{ route('front.product.detail', ['productId' => $item->model->id]) }}">
                                                    <img src="{{ $item->model->getFirstMediaUrl('main_img_of_product', 'small') }}"
                                                        alt="{{ $item->model->name }}" loading="lazy"
                                                        class="img img-thumbnail" />
                                                    <h6>{{ ucwords($item->model->name) }}
                                                    </h6>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="cart-price">
                                                ${{ $item->price }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action-wrapper">
                                                <button class="button button-outline-secondary fas fa-trash"
                                                    wire:click.prevent="remove('{{ $item->rowId }}')"></button>
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
                    <!-- Products-List-Wrapper /- -->
                </div>
            </div>
        </div>
    </div>
</div>
