<div class="card rounded-4 shadow-sm" style="border: solid 3px #3b2621;">
  <div class="card-header bg-white border-0 mt-2">
    <div class="card bg-white border-0" style="max-width: 540px;">
      <div class="row g-0">
        <div class="col-md-3">
          <img src="{{ asset('storage/img/avatars/' . Auth::user()->avatar) }}" class="img-fluid rounded-start"
            alt="...">
        </div>
        <div class="col-md-9">
          <div class="card-body">
            <h5 class="card-title">
              {{ Auth::user()->name }}
            </h5>
            <small>
              Registered since {{ Auth::user()->created_at->diffForHumans() }}
            </small>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card-body mx-2">

    <!-- CTA -->
    <div class="row">
      <div class="card rounded-4" style="background-color: #fceae3;">
        <div class="card-body">
          <h5 class="card-title mt-3">
            Nikmatin Bebas Ongkir, tanpa batas!
          </h5>
          <p>
            Belanja sepuasnya dan nikmati bebas ongkir tanpa batas minimal belanja.
          </p>
        </div>
      </div>
    </div>

    <!-- Gopay -->
    <div class="row mt-2">
      <div class="card rounded-4 border-0 shadow-sm" style="background-color: #f0f9ff;">
        <div class="card-body">
          <div class="gopay d-flex align-items-center py-2">
            <img src="{{ asset('frontend/img/icons/coins.png') }}" alt="Gopay" class="img-fluid pe-3"
              style="width: 50px;"></i> <span class="ms-2">Coins</span>
            <p class="btn fw-bold ms-auto mb-0">
              {{ Auth::user()->coin }} <i class="bi bi-coin"></i>
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Member Card -->
    <div class="row mt-2">
      <div class="card rounded-4 border-0 shadow-sm" style="background-color: #f0f9ff;">
        <div class="card-body">
          <div class="member-card d-flex align-items-center py-2">
            <img src="{{ asset('frontend/img/icons/member.png') }}" alt="Gopay" class="img-fluid pe-3"
              style="width: 50px;"></i> <span class="ms-2">Member Card</span>
            <p class="btn text-success ms-auto mb-0">
              Activation
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Saldo -->
    <div class="row mt-2">
      <div class="card rounded-4 border-0 shadow-sm" style="background-color: #f0f9ff;">
        <div class="card-body">
          <div class="saldo d-flex align-items-center py-2">
            <img src="{{ asset('frontend/img/icons/wallet.png') }}" alt="Gopay" class="img-fluid pe-3"
              style="width: 50px;"></i> <span class="ms-2">Saldo</span>

            <!-- Sum Saldo -->
            <span class="ms-auto fw-bold">Rp. 50.000</span>

          </div>
        </div>
      </div>
    </div>

  </div>
</div>