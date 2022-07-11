@extends('layout.master')

@section('content')
    <form action="{{ route('courses.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        Gender
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="male">
            <label class="form-check-label" for="male">
                Nam
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="female" checked>
            <label class="form-check-label" for="female">
                Nữ
            </label>
        </div>
        <div class="form-group">
            <label for="birthdate">Birthdate</label>
            <input type="date" name="birthdate" class="form-control">
        </div>
        Status
        @foreach ($arrStudentStatus as $option => $value)
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" value="{{ $value }}"
                       @if ($loop->first)
                            checked
                        @endif>
                <label class="form-check-label">
                    {{ $option }}
                </label>
            </div>
        @endforeach
        <br/>
        <button>Create</button>
    </form>
@endsection
