<?php 
use App\Models\Category;

$categories = Category::all()->sortByDesc('created_at')->take(3);
?>

<footer class="text-center text-lg-start bg-dark text-light py-5">
  <section class="container d-flex justify-content-center justify-content-lg-between p-4 border-bottom">

    <div class="me-5 d-lg-block">
      <span>Follow us on social media:</span>
    </div>

    <div>
      <a href="https://facebook.com" target="_blank" class="me-4 text-decoration-none hovered text-light">
        <i class="bi bi-facebook text-lg"></i>
      </a>
      <a href="https://twitter.com" target="_blank" class="me-4 text-decoration-none hovered text-light">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="https://google.com" target="_blank" class="me-4 text-decoration-none hovered text-light">
        <i class="fab fa-google"></i>
      </a>
      <a href="https://www.instagram.com/?hl=en" target="_blank" class="me-4 text-decoration-none hovered text-light">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="https://linkedin.com" target="_blank" class="me-4 text-decoration-none hovered text-light">
        <i class="fab fa-linkedin"></i>
      </a>
    </div>

  </section>

  <section class="">
    <div class="container text-center text-md-start mt-5">
      <div class="row mt-3">

        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-4">
          <a href="{{ route('home') }}" class="text-light hovered">
            <h6 class="text-uppercase fw-bold mb-4">
              Souvenir BOSS
            </h6>
          </a>
          <p>
            Here you can use rows and columns to organize your footer content. Lorem ipsum
            dolor sit amet, consectetur adipisicing elit.
          </p>
        </div>

        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">
            <a href="{{ route('product') }}" class="text-light text-decoration-none hovered">Our Products</a>
          </h6>
          @foreach ($categories as $category)
          <p>
            <a href="/product?category={{ $category->id }}" class="text-light text-decoration-none hovered">{{
              $category->name }}</a>
          </p>
          @endforeach
        </div>

        <div class="col-md-4 col-lg-4 col-xl-3 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">
            Contact Us
          </h6>
          <p><i class="fas fa-map-marker-alt me-2"></i> Bandung, West Java, Indonesia</p>
          <a target="_blank" href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=souvenirboss@gmail.com"
            class="text-light hovered d-block mb-3"><i class="fas fa-envelope"></i>
            souvenirboss@gmail.com</a>
          <a href="https://api.whatsapp.com/send?phone=+62895345228535" target="_blank"
            class="text-light hovered d-block"><i class="fas fa-phone"></i> +62 895345228535</a>
        </div>

      </div>
    </div>
  </section>

  <div class="text-center pt-2">
    <p class="text-center">Copyright &copy; {{ date("Y") }} <strong><a href="{{ route('home') }}"
          class="text-reset text-decoration-none hovered">Souvenir BOSS</a></strong>.
      All rights reserved.</p>
  </div>
</footer>