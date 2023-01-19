<x-master-layout>
    @section('title', 'Directory Page')

    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Directory</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ route('front.home') }}">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="store-directory.html">Directory</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Store-Directory-Page -->
    <div class="page-directory u-s-p-t-80">
        <div class="container">
            @php
                $categories = App\Models\Category::with(['subCategories'])
                    ->parent()
                    ->get();
            @endphp
            @foreach ($categories as $category)
                <div class="directory-wrapper">
                    <h2>
                        <a href="{{ route('front.shop.category.products', ['url' => $category->url]) }}">{{ ucwords($category->name) }}</a>
                    </h2>
                    <div class="row">
                        @foreach ($category->subCategories as $sub)
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <ul class="dir-list-wrap">
                                    <li>
                                        <a class="dir-list-main" href="{{ route('front.shop.category.products', ['url' => $sub->url]) }}">{{ ucwords($sub->name) }}</a>
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-master-layout>
