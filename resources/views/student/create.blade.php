@extends('layout.master')

@section('content')
    <form action="{{ route('students.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        Gender
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="male" value="0">
            <label class="form-check-label" for="male">
                Nam
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="female" value="1" checked>
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
        Course
        <select name="course_id">
            @foreach($courses as $course)
                <option value ="{{ $course->id }}">
                    {{ $course->name }}
                </option>
            @endforeach
        </select>
        <br><br>
{{--        {{ Form::select('course_id', $courses) }} Laravel Collective--}}
        <button>Create</button>
    </form>
@endsection
