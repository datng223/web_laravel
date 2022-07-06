@extends('layout.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.4/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sl-1.4.0/datatables.min.css"/>
@endpush
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
{{--            <form class="float-right form-group form-inline">--}}
{{--                <label class="mr-2">Search:</label>  <input class="form-control" type="search" name="q" value="{{ $search }}">--}}
{{--            </form>--}}
            <table class="table table-striped table-centered mb-0" id="table-index">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.4/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sl-1.4.0/datatables.min.js"></script>
    <script>
        $(function() {
            let table = $('#table-index').DataTable({
                dom: 'Blfrtip',
                select: true,
                buttons: [
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible :not(.not-export)'
                        }
                    },
                    'colvis'
                ],
                processing: true,
                serverSide: true,
                ajax: '{!! route('courses.api') !!}',
                columnDefs: [
                    { className: "not-export", "targets": [ 3 ] }
                ],
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'created_at', name: 'created_at' },
                    {
                        data: 'edit',
                        name: 'edit',
                        targets: 3,
                        orderable: false,
                        searchable: false,
                        render: function ( data, type, row, meta ) {
                            return `<a class="btn btn-primary" href="${data}">
                                Edit
                            </a>`
                        }
                    },
                    {
                        data: 'destroy',
                        name: 'destroy',
                        targets: 4,
                        orderable: false,
                        searchable: false,
                        render: function ( data, type, row, meta ) {
                            return `<form action="${data}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class=" btn btn-delete btn-danger">Delete</button>
                                    </form>`
                        }
                    },
                ]
            });
            $(document).on('click', '.btn-delete', function(){
                let form = $(this).parents('form');
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    data: form.serialize(),
                    success:
                        function() {
                            console.log("success");
                            table.draw();
                        },
                    error:
                        function() {
                            console.log("error");
                    },
                })                
                
            });

        });
    </script>
@endpush
