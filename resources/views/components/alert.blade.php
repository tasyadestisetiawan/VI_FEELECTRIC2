@props(['type' => 'info', 'message' => '', 'errors' => []])

@if($message)
<div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
  {{ $message }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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