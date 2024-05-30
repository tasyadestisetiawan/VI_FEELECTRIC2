@props(['type' => 'info', 'message' => '', 'errors' => []])

<style>
  .btn-close {
    color: #ffffff !important;
  }
</style>

@if($message)
<div class="alert mb-4 rounded-4 alert-{{ $type }} alert-dismissible fade show" role="alert" style="background-color: #3b2621; color: #fff7e8; border: solid 1px #3b2621;">
  {{ $message }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="color: #fff7e8 !important;"></button>
</div>
@endif

@if(count($errors) > 0)
<div class="alert alert-danger">
  <ul>
    @foreach ($errors as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif