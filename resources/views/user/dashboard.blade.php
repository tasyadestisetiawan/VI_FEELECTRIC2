@extends('layouts.home')

@section('content')
    <?php date_default_timezone_set('Asia/Jakarta'); // Pastikan ini sesuai dengan zona waktu Anda ?>

    <div class="container my-5 py-5">
        <div class="card mt-5 pt-3 px-3 pb-3 rounded-4 shadow-sm w-100" style="border: solid 2px #3b2621;">
            <div class="card-body">
                <h2>
                    @if (date('H') >= 0 && date('H') < 12)
                        Good Morning, {{ Auth::user()->name }} 👋
                    @elseif (date('H') >= 12 && date('H') < 18)
                        Good Afternoon, {{ Auth::user()->name }} 👋
                    @else
                        Good Evening, {{ Auth::user()->name }} 👋
                    @endif
                </h2>
                <hr style="border-top: 5px dotted #3b2621;">
                <p class="lead" style="color: #3b2621;">
                    Welcome to your dashboard. Here you can manage your profile, orders, and more.
                </p>
                <div class="row mt-5">
                    <div class="col-4">
                        <div class="card rounded-4 shadow-sm w-100" style="border: solid 1px #3b2621;">
                            <div class="card-body">
                                <h5 class="card-title text-center">Profile</h5>
                                <p class="card-text text-center">
                                    Manage your profile information.
                                </p>
                                <a href="{{ route('user.profile') }}" class="btn w-100" style="background-color: #3b2621; color: #fff7e8;">
                                    <i class="bi bi-person-fill"></i>
                                    Edit Profile
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card rounded-4 shadow-sm w-100" style="border: solid 1px #3b2621;">
                            <div class="card-body">
                                <h5 class="card-title text-center">Orders</h5>
                                <p class="card-text text-center">
                                    View your order history.
                                </p>
                                <a href="{{ route('orders.index') }}" class="btn w-100" style="background-color: #3b2621; color: #fff7e8;">
                                    <i class="bi bi-box-seam-fill"></i>
                                    View Orders
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card rounded-4 shadow-sm w-100" style="border: solid 1px #3b2621;">
                            <div class="card-body">
                                <h5 class="card-title text-center">Cart</h5>
                                <p class="card-text text-center">
                                    Manage your cart.
                                </p>
                                <a href="{{ route('cart.index') }}" class="btn w-100" style="background-color: #3b2621; color: #fff7e8;">
                                    <i class="bi bi-cart-fill"></i>
                                    Find Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
