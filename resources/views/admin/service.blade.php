@extends('layouts.admin')

@section('title', 'Services')

@section('content')
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">@yield('title')</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-3 text-end">
                    <a href="/service/create" class="btn btn-primary"><i class="mdi mdi-plus"></i> Add Data</a>
                </div>
                <div class="col-md-12">
                    {{ $dataTable->table(['class' => 'table table-bordered table-striped']) }}
                </div>
            </diV>
        </div>
    </div>

    <div class="modal fade" id="modal_form">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form_data">
                    <input type="hidden" name="id" id="id">
                    <div class="modal-header">
                        <h6 class="modal-title">Tambah Data</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name">Name : </label>
                            <input type="text" class="form-control" name="name" id="name">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn_submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}

    @if (Session::has('status'))
    <script>
        Swal.fire({
            icon: "success",
            title: "Success",
            text: "{{Session::get('text')}}",
        })
        window.LaravelDataTables["service-table"].ajax.reload();
    </script>
    @endif

    <script>
        var id_use;

        function destroy(slug) {
            Swal.fire({
                title: "Are you Sure?",
                text: "Data will be deleted!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if(result.isConfirmed) {
                    $.ajax({
                        url: "{{route('service.destroy')}}",
                        type: "POST",
                        data: { slug : slug },
                        dataType: "JSON",
                        success: function(data) {
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: data.text,
                            })
                            window.LaravelDataTables["service-table"].ajax.reload();
                        }
                    })
                }
            })
        };
    </script>
@endpush
