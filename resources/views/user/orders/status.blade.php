@extends('layouts.home')

<style>
  body {
    background-image: url("data:image/svg+xml,<svg id='patternId' width='100%' height='100%' xmlns='http://www.w3.org/2000/svg'><defs><pattern id='a' patternUnits='userSpaceOnUse' width='70' height='70' patternTransform='scale(7) rotate(0)'><rect x='0' y='0' width='100%' height='100%' fill='hsla(40, 100%, 95%, 1)'/><path d='M-4.8 4.44L4 16.59 16.14 7.8M32 30.54l-13.23 7.07 7.06 13.23M-9 38.04l-3.81 14.5 14.5 3.81M65.22 4.44L74 16.59 86.15 7.8M61 38.04l-3.81 14.5 14.5 3.81'  stroke-linecap='square' stroke-width='1' stroke='hsla(20, 29%, 18%, 0.18)' fill='none'/><path d='M59.71 62.88v3h3M4.84 25.54L2.87 27.8l2.26 1.97m7.65 16.4l-2.21-2.03-2.03 2.21m29.26 7.13l.56 2.95 2.95-.55'  stroke-linecap='square' stroke-width='1' stroke='hsla(20, 29%, 18%, 0.18)' fill='none'/><path d='M58.98 27.57l-2.35-10.74-10.75 2.36M31.98-4.87l2.74 10.65 10.65-2.73M31.98 65.13l2.74 10.66 10.65-2.74'  stroke-linecap='square' stroke-width='1' stroke='hsla(20, 29%, 18%, 0.18)' fill='none'/><path d='M8.42 62.57l6.4 2.82 2.82-6.41m33.13-15.24l-4.86-5.03-5.03 4.86m-14-19.64l4.84-5.06-5.06-4.84'  stroke-linecap='square' stroke-width='1' stroke='hsla(20, 29%, 18%, 0.18)' fill='none'/></pattern></defs><rect width='800%' height='800%' transform='translate(0,0)' fill='url(%23a)'/></svg>");
    background-size: auto;
    background-repeat: repeat-y;
  }

  .main-content {
    padding: 20px;
    min-height: 100vh;
    color: #3B2621;
  }

  .contentcard {
    color: #3B2621;
  }

  .step {
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;

  }

  .step .circle {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    font-weight: bold;
    color: white;
    background-color: #3B2621;
    margin-right: 1rem;
  }

  .step .circle.active {
    background-color: #3B2621;
  }

  .step .circle.inactive {
    background-color: #d3d3d3;
  }

  .step .content {
    flex-grow: 1;
  }

  .status-card {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    position: relative;
    /* Adjusted margin to give space for the larger circle */
  }

  .status-card .circle {
    width: 10rem;
    /* Increased size */
    height: 10rem;
    /* Increased size */
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    /* Adjusted font size */
    font-weight: bold;
    color: white;
    background-color: #3B2621;
    position: absolute;
    top: -4rem;
    /* Half of the circle's height to center it */
    left: 50%;
    transform: translateX(-50%);
  }

  .status-card .card-title {
    margin-top: 5rem;
    /* Add margin to push text down */
  }
</style>

@section('content')
<div class="container my-5 py-5">
  <div class="container main-content">
    <h1 class="mb-3">
      Order Status
    </h1>
    <p class="mb-5">
      Explore the status of your order and track it's progress.
    </p>

    <div class="row">
      <div class="col-md-6">
        <div class="step">
          <div class="circle">1</div>
          <div class="content card p-3" style="color: #3B2621;">
            <h5 class="card-title">
              Placed!
            </h5>
            <p class="card-text">
              Your order has been placed successfully.
            </p>
          </div>
        </div>

        <div class="step">
          <div class="circle">2</div>
          <div class="content card p-3" style="color: #3B2621;">
            <h5 class="card-title">
              Processed!
            </h5>
            <p class="card-text">
              Your order is currently being processed and will be shipped.
            </p>
          </div>
        </div>

        <div class="step">
          <div class="circle">
            <i class="bi bi-check"></i>
          </div>
          <div class="content card p-3" style="color: #3B2621;">
            <h5 class="card-title">
              Completed!
            </h5>
            <p class="card-text">
              FINALLY! Your order has been completed.
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4 d-flex align-items-center mx-auto">
        <div class="status-card">
          <div class="circle mt-2 mb-4">
            @if ($order->orderStatus == 'completed')
            {{-- SVG ICon Check --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-check"
              viewBox="0 0 16 16">
              <path
                d="M13.354 4.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L6 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
            </svg>
            @else
            <small>
              {{ $order->updated_at->diffForHumans() }}
            </small>
            @endif
          </div>
          <h5 class="card-title">
            <br>
            @if ($order->orderStatus == 'pending')
            Order has been placed!
            @elseif ($order->orderStatus == 'processing')
            Order is being processed!
            @elseif ($order->orderStatus == 'completed')
            Order has been completed!
            @endif
          </h5>
          <hr>
          <p class="card-text">
            Your order is currently in the <span class="badge bg-success">{{ $order->orderStatus }}</span> status.
            And will be
            delivered to you soon. Thank
            you for shopping with us!
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Add .circle.active if the step is active statusOrder == 'processing' || statusOrder == 'completed' || statusOrder == 'shipped'
  const statusOrder = '{{ $order->orderStatus }}';
  const steps = document.querySelectorAll('.step .circle');
  steps.forEach((step, index) => {
    if (index == 0 && statusOrder == 'pending') {
      step.classList.add('active');
    } else if (index == 1 && statusOrder == 'processing') {
      step.classList.add('active');
    } else if (index == 2 && statusOrder == 'completed') {
      step.classList.add('active');
    } else {
      step.classList.add('inactive');
    }
  });

</script>

@endsection