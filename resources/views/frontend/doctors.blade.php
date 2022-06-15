@extends('layouts.frontend')

@section('content')

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="{{ route('welcome') }}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Store</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="title-section text-center col-12">
            <h2 class="text-uppercase">Doctors</h2>
          </div>
        </div>
    
        <div class="row">
          <div class="col-sm-6 col-lg-4 text-center item mb-4">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="{{ asset('asset/img/trainers/hassan.webp') }}" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Hassan Raza</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-lg-4 text-center item mb-4">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="{{ asset('asset/img/trainers/hassan.webp') }}" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Hassan Raza</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-lg-4 text-center item mb-4">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="{{ asset('asset/img/trainers/hassan.webp') }}" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Hassan Raza</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-lg-4 text-center item mb-4">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="{{ asset('asset/img/trainers/hassan.webp') }}" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Hassan Raza</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>

                    <div class="col-sm-6 col-lg-4 text-center item mb-4">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="{{ asset('asset/img/trainers/hassan.webp') }}" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Hassan Raza</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-lg-4 text-center item mb-4">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="{{ asset('asset/img/trainers/hassan.webp') }}" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Hassan Raza</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>

          

        </div>
      </div>
    </div>

@endsection