@extends('layouts.dashboard')

@section('content')
<div class="container my-5 py-5">
  <div class="header clearfix">
    <a href="{{ route('admin.bootcamps.index') }}" class="btn btn-primary-theme btn-sm float-end mb-3">
      Back to Bootcamps
    </a>
  </div>
  <div class="row">
    <div class="col-4">
      <img src="{{ asset('storage/img/bootcamps/poster/' . $bootcamp->image) }}" class="img-fluid"
        alt="{{ $bootcamp->name }}"
        style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px; border: 2px solid #3B2621; padding: 5px; margin-bottom: 20px;">
    </div>
    <div class="col-8">
      <table class="table">
        <tr style="border-bottom: 1px solid #3B2621;">
          <td class="fw-bold">Name</td>
          <td>{{ $bootcamp->name }}</td>
        </tr>
        <tr style="border-bottom: 1px solid #3B2621;">
          <td class="fw-bold">Description</td>
          <td>{{ $bootcamp->description }}</td>
        </tr>
        <tr style="border-bottom: 1px solid #3B2621;">
          <td class="fw-bold">Date</td>
          <td>
            {{-- With Carbon --}}
            {{ \Carbon\Carbon::parse($bootcamp->start_date)->format('d M Y') }} - {{
            \Carbon\Carbon::parse($bootcamp->end_date)->format('d M Y') }}
          </td>
        </tr>
        <tr style="border-bottom: 1px solid #3B2621;">
          <td class="fw-bold">Time</td>
          <td>
            {{-- With Carbon --}}
            {{ \Carbon\Carbon::parse($bootcamp->start_time)->format('H:i') }} - {{
            \Carbon\Carbon::parse($bootcamp->end_time)->format('H:i') }}
          </td>
        </tr>
        <tr style="border-bottom: 1px solid #3B2621;">
          <td class="fw-bold">Location</td>
          <td>{{ $bootcamp->location }}</td>
        </tr>
        <tr style="border-bottom: 1px solid #3B2621;">
          <td class="fw-bold">Price</td>
          <td>Rp. {{ number_format($bootcamp->price, 0, ',', '.') }}</td>
        </tr>
        <tr style="border-bottom: 1px solid #3B2621;">
          <td class="fw-bold">Quota</td>
          <td>{{ $bootcamp->kuota }}</td>
        </tr>
        <tr style="border-bottom: 1px solid #3B2621;">
          <td class="fw-bold">Status</td>
          <td>
            @if ($status)
            <span class="badge bg-success">Open</span>
            @else
            <span class="badge bg-danger">Closed</span>
            @endif
          </td>
        </tr>
      </table>
    </div>
  </div>

  <div class="row">
    {{-- Table Peserta --}}
    <div class="col-12">
      <h5 class="fw-bold mt-5">Participants</h5>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Payment</th>
            <th scope="col">Proof</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($participants as $user)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->phone }}</td>
            <td>
              @if ($user->payment_status == 'paid')
              <span class="badge bg-success">
                PAID
              </span>
              @elseif ($user->payment_status == 'pending')
              <span class="badge bg-warning">
                WAITING CONFIRMATION
              </span>
              @elseif ($user->payment_status == 'unpaid')
              <span class="badge bg-warning text-dark">
                UNPAID
              </span>
              @elseif ($bootcamp->price == 0)
              <span class="badge bg-success">
                FREE
              </span>
              @endif
            </td>
            <td>
              @if ($user->payment_proof)
              <a href="{{ asset('storage/img/bootcamps/payment/' . $user->payment_proof) }}" target="_blank"
                class="badge bg-primary">View</a>
              @elseif ($bootcamp->price == 0)
              <span class="badge bg-success">
                Don't Need Proof, because it's free
              </span>
              @else
              <span class="badge bg-warning text-dark">No Proof</span>
              @endif
            </td>
            @if ($user->payment_status == 'pending')
            <td>
              <form action="{{ route('admin.bootcamps.confirm-payment', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="bootcamp_id" value="{{ $bootcamp->id }}">
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="payment_status" value="paid">
                <button type="submit" class="btn btn-success btn-sm">Confirm</button>
              </form>
            </td>
            @elseif ($user->payment_status == 'paid')
            <td>
              <span class="badge bg-success">Confirmed</span>
            </td>
            @else
            <td>
              <span class="badge bg-danger">
                Wait for User Payment...
              </span>
            </td>
            @endif
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection