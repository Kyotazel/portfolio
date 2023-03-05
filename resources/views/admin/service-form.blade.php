@extends('layouts.admin')

@if (isset($data))
@section('title', "Services Update")
@else
@section('title', "Services Create")
    
@endif

@section('content')
<div class="card">
    <div class="card-body">
        <form id="form_data">
            <input type="hidden" name="id" id="id" value="{{isset($data->id) ? $data->id : ''}}">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <label for="title" class="form-label">Title : </label>
                        <input type="text" name="title" class="form-control" value="{{isset($data->title) ? $data->title : ''}}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="icon" class="form-label">Icon : </label> <i style="font-size: 20px" class="{{isset($data->icon) ? $data->icon : ''}}"></i>
                        <input type="text" name="icon" class="form-control" value="{{isset($data->icon) ? $data->icon : ''}}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="content">Content : </label>
                        <input type="hidden" name="content" value="{!!isset($data->content) ? $data->content : ''!!}">
                        <div id="content" style="min-height: 400px">
                            {!!isset($data->content) ? $data->content : ''!!}
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-success btn_submit" style="display: block; width: 100%">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        var editor = new Quill('#content', {
            theme: "snow",
            modules: {
                toolbar: [
                    [{ header: [1, 2, 3, 4, 5, 6, false] }],
                    [{ font: [] }],
                    ["bold", "italic"],
                    ["link", "image"],
                    [{ list: "ordered" }, { list: "bullet" }],
                ]
            },
        })

        editor.on('text-change', function(delta, oldDelta, source) {
            document.querySelector("input[name='content']").value = editor.root.innerHTML;
        });

        $(".btn_submit").on('click', function(e) {
            e.preventDefault();
            var formData = new FormData($('#form_data')[0]);
            $.ajax({
                url: "{{ route('service.store') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {
                    window.location.href = data.redirect;
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