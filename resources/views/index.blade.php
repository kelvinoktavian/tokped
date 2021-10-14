@extends('layouts.app')

@section('content')

<x-alert />

{{-- Carousel --}}
<section>
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">

        <ol class="carousel-indicators">
            @foreach($carousels as $carousel)
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            @endforeach
        </ol>

        <div class="carousel-inner">

            @foreach($carousels as $key => $carousel)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <img src="{{ asset('images/carousel/' . $carousel->image_path) }}" class="d-block w-100"
                    alt="{{ $carousel->title }}">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $carousel->title }}</h5>
                    <p>{{ $carousel->body }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>

<section class="p-5 text-center">
    <h2>Souvenir</h2>
    <p>/ˌso͞ovəˈnir/</p>
    <p>
        WHAT DO WE mean when we say "souvenir"? Well, most of us mean a
        keepsake, of course. Some of us mean a fond reminder of a place or time
        that made us happy. And others mean an expensive French skillet, as in
        "Ne putez pas le souvenir dans le microwave." But these are people who
        don't understand what the word means.
    </p>

    <p>
        The word, of course, is Greek, from sou, meaning "something cheap or
        tacky," and venir, meaning "bought on vacation by a relative or
        workmate." Indeed, Homer records the very first souvenir in Book Eleven
        of "The Iliad": "Now crafty Odysseus spied this item:/ a tunic saying
        'My Dad went to Troy/ and all he bought me was this stupid T-shirt.' "
        (Unfortunately, Odysseus loses the T-shirt on the battlefield and has to
        stop in the airport giftshop on his way home and buy everyone snow domes
        with the Parthenon inside.)
    </p>

    <a class="btn btn-sm text-decoration-none btn-custom-primary my-3" href="{{ route('product') }}">Shop Now</a>
</section>

<!-- About -->
<section id="about" class="p-5">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-md">
                <img class="rounded" width="400px" src="{{ asset('/images/img/img1.jpg') }}" alt="" />
            </div>
            <div class="col-md p-5">
                <h2>What is tokped?</h2>
                <p>
                    SouvenirBOSS is a company engaged in services, more specifically
                    printing services. The main focus of BOSS SouvenirBOSS is the sale of
                    souvenir products with customize design according to the wishes of
                    consumers. The design can be a picture,text or logo. SouvenirBOSS are
                    ready to help consumers in the souvenir design process.
                </p>
            </div>
        </div>
    </div>
</section>

<section id="" class="p-5">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-md p-5">
                <h2>What we offer?</h2>
                <p>
                    SouvenirBOSS always helps consumers in the design process from start to
                    finish, converting images or photos into sketches and providing mockup
                    previews so that consumers can describe the final result of the
                    souvenirs that will be received.
                </p>
            </div>
            <div class="col-md">
                <img class="rounded" width="400px" src="{{ asset('/images/img/img2.jpg') }}" alt="" />
            </div>
        </div>
    </div>
</section>
<!-- End About -->

<section class="p-5 text-center">
    <h2>Our Newest Product</h2>
    <div style="width: 100px; color: black;"></div>
    <div class="row">
        @foreach ($products as $product)
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4 text-left">
            <div class="card rounded-3 border-0">
                <img src="{{ asset('images/product/' . $product->image_path) }}" alt="{{ $product->name }}" width="100%"
                    class="d-block" style="object-fit: cover">
                <div class="card-body">
                    <div class="mb-3" style="border-bottom: 0.2px solid rgb(230, 230, 230)">
                        <h5><a href="{{ route('show_product', $product->slug) }}"
                                class="text-dark text-decoration-none hovered">{{ $product->name }}</a>
                        </h5>
                        <p class="small text-muted">Rp. {{ number_format($product->price) }}</p>
                    </div>
                    @if ($product->qty > 0)
                    <small class="d-block pb-2 text-info">Stock: {{ number_format($product->qty) }}</small>
                    @else
                    <small class="d-block pb-2 text-danger">Product is out of stock.</small>
                    @endif
                    <small class="d-block pb-2 text-muted">0 Sold |
                        {{ $product->reviews()->count(); }} @if($product->reviews()->count() <= 1) Review @else Reviews
                            @endif</small> <a href="{{ route('show_product', $product->slug) }}"
                                class="btn btn-sm btn-dark btn-pill font-weight-bold">
                                Detail</a>
                            <form class="d-inline" action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input name="slug" type="hidden" value="{{ $product->slug }}">
                                <button
                                    class="btn btn-sm btn-dark btn-pill {{ $product->qty == 0 ? 'disabled' : '' }} font-weight-bold">
                                    <i class="bi bi-cart-plus-fill"></i> Add to cart
                                </button>
                            </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <a class="btn btn-sm text-decoration-none btn-custom-primary my-3" href="{{ route('product') }}">All Products</a>
</section>

<!-- Contact -->
<section id="contact" class="p-5">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-md">
                <div class="mapouter">
                    <div class="gmap_canvas">
                        <iframe width="600" height="500" id="gmap_canvas"
                            src="https://maps.google.com/maps?q=Bandung&t=&z=13&ie=UTF8&iwloc=&output=embed"
                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a
                            href="https://soap2day-to.com">soap2day</a><br />
                        <style>
                            .mapouter {
                                position: relative;
                                text-align: right;
                                height: 500px;
                                width: 600px;
                            }
                        </style><a href="https://www.embedgooglemap.net">embedgooglemap.net</a>
                        <style>
                            .gmap_canvas {
                                overflow: hidden;
                                background: none !important;
                                height: 500px;
                                width: 600px;
                            }
                        </style>
                    </div>
                </div>
            </div>
            <div class="col-md p-5">
                <h2 class="text-center">Contact Us</h2>
                <p class="lead">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                    Consectetur ea enim repellendus obcaecati temporibus dicta.
                </p>
                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Labore
                    minus veniam saepe voluptates quis vero. Quam voluptates optio
                    error voluptatem quis omnis quae quos accusantium. Mollitia
                    incidunt molestias quos quia.
                </p>
                <a href="https://api.whatsapp.com/send?phone=+62895345228535" target="_blank"
                    class="btn mt-3 d-block btn-whatsapp">Chat us via Whatsapp <i class="fab fa-whatsapp fa-lg"></i></a>
            </div>
        </div>
    </div>
</section>
<!-- End Contact -->

@endsection