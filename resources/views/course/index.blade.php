@extends('layout.master')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <a class="btn btn-success" href="{{ route('courses.create') }}">
                Thêm
            </a>
            <form class="float-right form-group form-inline">
                <label class="mr-2">Search:</label>  <input class="form-control" type="search" name="q" value="{{ $search }}">
            </form>
            <table class="table table-striped table-centered mb-0">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                @foreach($data as $each)
                    <tr>
                        <td>
                            {{ $each->id }}
                        </td>
                        <td>
                            {{ $each->name }}
                        </td>
                        <td>
                            {{ $each->year_created_at }}
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('courses.edit', $each) }}">
                                Edit
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('courses.destroy', $each) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            <ul class="pagination pagination-rounded mb-0">
                {{ $data->links() }}
            </ul>
        </div>
    </div>
@endsection
