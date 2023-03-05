@extends('layouts.admin')

@section('title', 'Menu')

@section('content')
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">@yield('title')</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-3 text-end">
                    <button class="btn btn-primary" onclick="add()"><i class="mdi mdi-plus"></i> Add Data</button>
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="name">Name : </label>
                                    <input type="text" class="form-control" name="name" id="name">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="link">Link : </label>
                                    <input type="text" class="form-control" name="link" id="link">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="icon">Icon : </label>
                                    <input type="text" class="form-control" name="icon" id="icon">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="category_menu_id">Category Menu : </label>
                                    <select name="category_menu_id" id="category_menu_id" class="form-control">
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($categoryMenus as $categoryMenu)
                                            <option value="{{$categoryMenu->id}}">{{ $categoryMenu->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="id_parent">Parent : </label>
                                    <select name="id_parent" id="id_parent" class="form-control">
                                        <option value="">Tanpa Parent</option>
                                        @foreach ($menus as $menu)
                                            <option value="{{$menu->id}}">{{ $menu->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
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
    <script>
        var id_use;

        function add() {
            $("#id").val(null);
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').empty();
            $('#form_data')[0].reset();
            $('.modal-title').text('ADD DATA')
            $("#modal_form").modal('show');
        };

        function edit(id) {
            $("#id").val(id);
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').empty();
            $('#form_data')[0].reset();
            $('.modal-title').text('EDIT DATA');
            $.ajax({
                url: "{{ route('menu.edit') }}",
                type: "POST",
                data: { id: id },
                dataType: "JSON",
                success: function(data) {
                    for(const [key, value] of Object.entries(data)) {
                        $(`[name=${key}]`).val(value);
                    }
                    $("#modal_form").modal('show');
                }
            })
        };

        function destroy(id) {
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
                        url: "{{route('menu.destroy')}}",
                        type: "POST",
                        data: { id : id },
                        dataType: "JSON",
                        success: function(data) {
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: data.text,
                            })
                            window.LaravelDataTables["menu-table"].ajax.reload();
                        }
                    })
                }
            })
        };

        function change_status(id, status) {
            let text = ""
            if(status == 1) {
                text = "Inactived"
            } else {
                text = "Actived"
            }
            Swal.fire({
                title: "Are you Sure?",
                text: `Data Will be ${text}`,
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Change it!'
            }).then((result) => {
                if(result.isConfirmed) {
                    $.ajax({
                        url: "{{route('menu.change')}}",
                        type: "POST",
                        data: { id : id, status: status },
                        dataType: "JSON",
                        success: function(data) {
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: data.text,
                            })
                            window.LaravelDataTables["menu-table"].ajax.reload();
                        }
                    })
                }
            })
        }

        $(".btn_submit").on('click', function(e) {
            e.preventDefault();
            var formData = new FormData($('#form_data')[0]);
            $.ajax({
                url: "{{ route('menu.store') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: data.text,
                    })
                    $('.invalid-feedback').empty();
                    $('.form-control').removeClass('is-invalid');
                    $('#form_data')[0].reset();
                    $("#modal_form").modal("hide");
                    window.LaravelDataTables["menu-table"].ajax.reload();
                },
                error: function(res) {
                    let errors = res.responseJSON?.errors

                    $('.invalid-feedback').empty();
                    $('.form-control').removeClass('is-invalid');

                    if (errors) {
                        for (const [key, value] of Object.entries(errors)) {
                            $(`[name=${key}]`).addClass("is-invalid");
                            $(`[name=${key}]`).next().html(value);
                        }
                    }
                }
            })
        });
    </script>
@endpush
