<x-master-layout>
    @section('title', 'About Page')
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>About</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ route('front.home') }}">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="javascript:;">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- About-Page -->
    <div class="page-about u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="about-me-info u-s-m-b-30">
                        <h1>Welcome to
                            <span>{{ config }}</span>
                        </h1>
                        <p>Stack Developers Youtube channel is for every Student / Laravel developer from basic to expert level. Channel provides the Laravel Tutorial and training for the Laravel projects, specially E-commerce Website.
                        </p>
                        <p>Channel also provide complete source code / support who join the channel as a premium or advance member.
                        </p>
                        <p>Channel helps the students / developers in below way :-<br>
                            1) Learn latest Laravel 6 / Laravel 7 / Laravel 8 quickly in easy step to step video tutorials<br>
                            2) Live Sessions to give more tips and tricks and for more clarity.<br>
                            3) Full support given to help to resolve issues.<br>
                            4) Help to develop complex logics<br>
                            5) Connect on Social Media<br>
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="about-me-image u-s-m-b-30">
                        <div class="banner-hover effect-border-scaling-gray">
                            <a href="https://www.youtube.com/StackDevelopers">
                                <img src="https://i.postimg.cc/cHkffzLS/shopping2.jpg" alt="About Picture" class="img-fluid" style="object-fit: cover">
                            </a>
                        </div>
                    </div>
                    <div class="about-social text-center u-s-m-b-30">
                        <ul class="social-media-list">
                            <li>
                                <a href="#">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-google-plus-g"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fas fa-rss"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-pinterest"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-master-layout>
