@extends('layouts.home')

<style>
  .rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: flex-end;
  }

  .rating input {
    display: none;
  }

  .rating label {
    font-size: 2em;
    color: #ccc;
    cursor: pointer;
  }

  .rating input:checked~label {
    color: #3b2621;
  }

  .rating label:hover,
  .rating label:hover~label {
    color: #3b2621;
  }
</style>

@section('content')
<div class="container my-5 py-5">
  <div class="row mt-4">
    <div class="row">

      {{-- Alert Notifications --}}
      <x-alert type="success" :message="session('success')" />
      <x-alert type="danger" :errors="$errors->all()" />

      <div class="row">

        <div class="col-5">
          <x-profile />
        </div>

        <div class="col-7">
          <div class="alert alert-warning alert-dismissible rounded-4 fade show" role="alert"
            style="background-color: #fceae3; color: #3b2621; border: solid 3px #3b2621;">
            <strong>Hi, {{ Auth::user()->name }}!</strong> <br>
            <p>
              Welcome to your profile page. Here you can see your profile details, orders, reservations, address, and
              vouchers.
            </p>
            {{-- Feedback Modal Buttons --}}
            <button type="button" class="btn rounded-pill p-2 px-4" data-bs-toggle="modal"
              data-bs-target="#feedbackModal" style="background-color: #3b2621; color: #fff;">
              <i class="bi bi-chat-left-text"></i>&nbsp;
              Give Feedback
            </button>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>

          <div class="card rounded-4 shadow-sm w-100" style="border: solid 3px #3b2621;">
            <div class="card-header bg-white border-0 mt-2">
              <ul class="nav nav-pills gap-3">
                <li class="nav-item">
                  <a class="nav-link active rounded-pill" style="background-color: #3b2621;  color: #fff7e8;"
                    href="{{route('user.profile')}}">
                    Profile
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link rounded-pill border-2" style="background-color: #fff7e8; color: #3b2621"
                    href="{{route('orders.index')}}">
                    Orders
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link rounded-pill border-2" style="background-color: #fff7e8; color: #3b2621"
                    href="{{ route('user.reservations.my') }}">
                    Reservations
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link rounded-pill border-2" style="background-color: #fff7e8; color: #3b2621"
                    href="{{route('user.address')}}">Address</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link rounded-pill border-2" style="background-color: #fff7e8; color: #3b2621"
                    href="{{route('vouchers.index')}}">Vouchers</a>
                </li>
              </ul>
            </div>
            <div class="card-body mx-2">
              <div class="row">
                <!-- Image -->
                <div class="col-5">
                  <img src="{{ asset('storage/img/avatars/' . Auth::user()->avatar) }}" class="img-fluid rounded-4"
                    alt="..." style="width: 200px; border: solid 1px #3b2621;">
                </div>
                <!-- Biodata -->
                <div class="col-7">
                  <h5 class="card-title">
                    Biodata
                  </h5>
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>Nama</td>
                        <td>{{ Auth::user()->name }}</td>
                      </tr>
                      <tr>
                        <td>Address</td>
                        <td>{{ Auth::user()->address }}</td>
                      </tr>
                    </tbody>
                  </table>

                  <h5 class="card-title">
                    Contacts
                  </h5>
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>Email</td>
                        <td>{{ Auth::user()->email }}</td>
                      </tr>
                      <tr>
                        <td>Phone</td>
                        <td>{{ Auth::user()->phone }}</td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="mt-2">
                    <div class="row g-2">
                      <div class="col-6">
                        <form method="POST" action="{{ route('logout') }}">
                          @csrf
                          <button type="submit" class="btn" style="border-color: #3b2621; color: #3b2621;">
                            <i class="bi bi-box-arrow-right"></i>&nbsp;
                            Logout</button>
                        </form>
                      </div>
                      <div class="col-6">
                        <a href="{{ route('user.profile.edit') }}" class="btn"
                          style="background-color: #3b2621; color: #fff;">
                          <i class="bi bi-pencil-square"></i>&nbsp;
                          Edit Profile</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Feedback Modal -->
<div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
  <div class="modal-dialog rounded-4">
    <div class="modal-content rounded-4">
      <div class="modal-header" style="background-color: #3b2621; color: #fff;">
        <h5 class="modal-title" id="feedbackModalLabel">Feedback</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-light">
        <form action="{{ route('feedbacks.store') }}" method="POST">
          @csrf
          {{-- Name --}}
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" readonly>
          </div>
          {{-- Email --}}
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
          </div>
          <div class="mb-3">
            <label for="feedback" class="form-label">Feedback</label>
            <textarea class="form-control" id="message" name="message" rows="3"></textarea>
          </div>

          <!-- Rating Star -->
          <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <div class="rating">
              <input type="radio" name="rating" value="5" id="star5"><label for="star5">☆</label>
              <input type="radio" name="rating" value="4" id="star4"><label for="star4">☆</label>
              <input type="radio" name="rating" value="3" id="star3"><label for="star3">☆</label>
              <input type="radio" name="rating" value="2" id="star2"><label for="star2">☆</label>
              <input type="radio" name="rating" value="1" id="star1"><label for="star1">☆</label>
            </div>
          </div>

          <button type="submit" class="btn" style="background-color: #3b2621; color: #fff;">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
  $('.rating input').change(function() {
  var $radio = $(this);
  $('.rating .selected').removeClass('selected');
  $radio.closest('label').addClass('selected');
  });
  });
</script>

@endsection