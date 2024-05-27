@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
  <div class="header clearfix">
    <a href="{{ route('admin.courses.create') }}" class="btn btn-primary-theme btn-sm float-end mb-3">Add Courses</a>

  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">

          {{-- Alert Notifications --}}
          <x-alert type="success" :message="session('success')" />
          <x-alert type="danger" :errors="$errors->all()" />

          <div class="table-responsive">
            <table class="table table-striped table-hover" id="dataTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Video</th>
                  <th>Name</th>
                  <th>Date</th>
                  <th>Price</th>
                  <th>Kuota</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($courses as $course)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>
                    {{-- Youtube Thumbnail --}}
                    @php
                    // Extract video ID from YouTube link
                    $videoUrl = $course->video;
                    preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $videoUrl, $matches);
                    $videoId = $matches[1];
                    $thumbnailUrl = "https://img.youtube.com/vi/$videoId/hqdefault.jpg";
                    @endphp
                    <img src="{{ $thumbnailUrl }}" width="400" height="400" alt="YouTube Thumbnail">
                  </td>

                  <td>{{ $course->name }}</td>
                  <td>{{ $course->date }}</td>
                  <td>{{ $course->price }}</td>
                  <td>{{ $course->kuota }}</td>
                  <td>
                    <!-- Detail -->
                    <button type="button" class="btn btn-sm btn-detail-theme" data-bs-toggle="modal" data-bs-target="#detailModal{{ $course->id }}">
                      <i class="bi bi-info-circle"></i>
                    </button>

                    <!-- Edit -->
                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-edit-theme">
                      <i class="bi bi-pencil-square"></i>
                    </a>

                    <!-- Delete -->
                    <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-delete-theme btn-sm">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Modal Detail --}}
@foreach ($courses as $course)
<div class="modal fade" id="detailModal{{ $course->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $course->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel{{ $course->id }}">
          {{ $course->name }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="ratio ratio-16x9">

              @php
              // Convert short URL to embed URL
              $videoUrl = str_replace('youtu.be/', 'www.youtube.com/embed/', $course->video);
              @endphp
              <iframe width="560" height="315" src="{{ $videoUrl }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

            </div>
          </div>
          <div class="col-md-6">
            <ul class="list-group list-group-flush">
              <li class="list-group item">
                <strong>Date:</strong>
                <br>
                {{ $course->date }}
              </li>
              <li class="list-group item">
                <strong>Price:</strong>
                <br>
                {{ $course->price }}
              </li>
              <li class="list-group item">
                <strong>Kuota:</strong>
                <br>
                {{ $course->kuota }} Peserta
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach

@endsection