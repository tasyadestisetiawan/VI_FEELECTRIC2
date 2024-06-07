@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
  <div class="header clearfix">
    <h2 class="float-start">
      Quiz Questions
    </h2>
    <button type="button" class="btn btn-sm btn-primary-theme float-end" data-bs-toggle="modal"
      data-bs-target="#addCategoryModal">Add Questions</button>
  </div>

  <div class="card shadow mb-4 mt-3">
    <div class="card-body">

      {{-- Alert Notifications --}}
      <x-alert type="success" :message="session('success')" />
      <x-alert type="danger" :errors="$errors->all()" />

      {{-- Table Category --}}
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Quiz</th>
              <th>Question</th>
              <th>A</th>
              <th>B</th>
              <th>C</th>
              <th>D</th>
              <th>Answer</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($questions as $data)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>
                @foreach ( $quizzes as $quiz )
                @if ( $quiz->id == $data->quiz_id )
                {{ $quiz->title }}
                @endif
                @endforeach
              </td>
              <td class="text-truncate">
                {{ $data->question }}
              </td>
              <td>
                {{ $data->option1 }}
              </td>
              <td>
                {{ $data->option2 }}
              </td>
              <td>
                {{ $data->option3 }}
              </td>
              <td>
                {{ $data->option4 }}
              </td>
              <td>
                <span class="badge bg-success">
                  @if ( $data->answer == 1 )
                  <span class="badge bg-success">A</span>
                  @elseif ( $data->answer == 2 )
                  <span class="badge bg-success">B</span>
                  @elseif ( $data->answer == 3 )
                  <span class="badge bg-success">C</span>
                  @elseif ( $data->answer == 4 )
                  <span class="badge bg-success">D</span>
                  @endif
                </span>
              </td>
              <td>
                <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                  data-bs-target="#editCategoryModal{{ $data->id }}">Edit</a>
                <form action="{{ route('admin.questions.destroy', $data->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger"
                    onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
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

{{-- Edit Questions --}}
@foreach ( $questions as $data )
<div class="modal fade" id="editCategoryModal{{ $data->id }}" tabindex="-1" aria-labelledby="editCategoryModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCategoryModalLabel">Edit Questions</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('admin.questions.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="mb-3">
            <label for="quiz_id" class="form-label">Quiz</label>
            <select class="form-select" id="quiz_id" name="quiz_id" required>
              <option selected disabled>Select Quiz</option>
              @foreach ($quizzes as $quiz)
              <option value="{{ $quiz->id }}" @if($quiz->id == $data->quiz_id) selected @endif>{{ $quiz->title }}
              </option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="question" class="form-label">Question</label>
            <textarea class="form-control" id="question" name="question" rows="3"
              required>{{ $data->question }}</textarea>
          </div>
          <div class="row">
            <div class="mb-3 col">
              <label for="option1" class="form-label">Option A</label>
              <input type="text" class="form-control" id="option1" name="option1" value="{{ $data->option1 }}" required>
            </div>
            <div class="mb-3 col">
              <label for="option2" class="form-label">Option B</label>
              <input type="text" class="form-control" id="option2" name="option2" value="{{ $data->option2 }}" required>
            </div>
          </div>
          <div class="row">
            <div class="mb-3 col">
              <label for="option3" class="form-label">Option C</label>
              <input type="text" class="form-control" id="option3" name="option3" value="{{ $data->option3 }}" required>
            </div>
            <div class="mb-3 col">
              <label for="option4" class="form-label">Option D</label>
              <input type="text" class="form-control" id="option4" name="option4" value="{{ $data->option4 }}" required>
            </div>
          </div>
          <div class="mb-3">
            <small>
              The option number is the correct answer. Example: A = 1, B = 2, C = 3, D = 4
            </small>
            <label for="answer" class="form-label">Correct Answer</label>
            <input type="text" class="form-control" id="answer" name="answer" value="{{ $data->answer }}" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

{{-- Modal Add Questions --}}
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCategoryModalLabel">Add Questions</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('admin.questions.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="quiz_id" class="form-label">Quiz</label>
            <select class="form-select" id="quiz_id" name="quiz_id" required>
              <option selected disabled>Select Quiz</option>
              @foreach ($quizzes as $quiz)
              <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="question" class="form-label">Question</label>
            <textarea class="form-control" id="question" name="question" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="option1" class="form-label">Option A</label>
            <input type="text" class="form-control" id="option1" name="option1" required>
          </div>
          <div class="mb-3">
            <label for="option2" class="form-label">Option B</label>
            <input type="text" class="form-control" id="option2" name="option2" required>
          </div>
          <div class="mb-3">
            <label for="option3" class="form-label">Option C</label>
            <input type="text" class="form-control" id="option3" name="option3" required>
          </div>
          <div class="mb-3">
            <label for="option4" class="form-label">Option D</label>
            <input type="text" class="form-control" id="option4" name="option4" required>
          </div>
          <div class="mb-3">
            <label for="answer" class="form-label">Correct Answer</label>
            <input type="text" class="form-control" id="answer" name="answer" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection