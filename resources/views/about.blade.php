@extends('layouts.app')

@section('content')

<section id="aboutus-carousel">
  {{-- Carousel images will be taken from database --}}
  <div id="carousel-slides" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carousel-slides" data-bs-slide-to="0" class="active" aria-current="true"
        aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carousel-slides" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carousel-slides" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>

    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../images/img/welcome-image4.png" class="d-block" alt="...">
      </div>
      <div class="carousel-item">
        <img src="../images/img/welcome-image5.png" class="d-block" alt="...">
      </div>
      <div class="carousel-item">
        <img src="../images/img/welcome-image6.png" class="d-block" alt="...">
      </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-slides" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>

    <div class="card-body">
      {{-- @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
      @endif --}}

      <section id="aboutus-services">
        <div class="text-section-title text-center">Our Services</div>

        <div class="services d-flex">
          <div class="col1 text-center">
            <img class="align-middle" src="{{ asset('../images/img/laserengraving.jpg') }}" alt="">
          </div>
          <div class="col2">
            <div class="text-sub-section-title text-center mb-3">Laser Engraving</div>
            <p class="text-center">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facere, non! Lorem ipsum
              dolor sit amet, consectetur adipisicing elit. Temporibus quia praesentium officia debitis perspiciatis
              expedita hic aperiam dicta incidunt quisquam?</p>
          </div>

        </div>

        <div class="services d-flex">
          <div class="col1 text-center">
            <img class="align-middle" src="{{ asset('../images/img/sablon.jpg') }}" alt="">
          </div>
          <div class="col2 bg-gac-1">
            <div class="text-sub-section-title text-center mb-3">Screen Printing</div>
            <p class="text-center">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facere, non! Lorem ipsum
              dolor sit amet, consectetur adipisicing elit. Temporibus quia praesentium officia debitis perspiciatis
              expedita hic aperiam dicta incidunt quisquam?</p>
          </div>
        </div>

        <div class="services d-flex">
          <div class="col1 text-center">
            <img class="align-middle" src="{{ asset('../images/img/lasercutting.jpg') }}" alt="">
          </div>
          <div class="col2">
            <div class="text-sub-section-title text-center mb-3">Laser Cutting</div>
            <p class="text-center">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facere, non! Lorem ipsum
              dolor sit amet, consectetur adipisicing elit. Temporibus quia praesentium officia debitis perspiciatis
              expedita hic aperiam dicta incidunt quisquam?</p>
          </div>
        </div>

        <div class="services d-flex">
          <div class="col1 text-center">
            <img class="align-middle" src="{{ asset('../images/img/welcome-image6.png') }}" alt="">
          </div>
          <div class="col2">
            <div class="text-sub-section-title text-center mb-3">Custom Box </div>
            <p class="text-center">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facere, non! Lorem ipsum
              dolor sit amet, consectetur adipisicing elit. Temporibus quia praesentium officia debitis perspiciatis
              expedita hic aperiam dicta incidunt quisquam?</p>
          </div>
        </div>


      </section>





      @endsection