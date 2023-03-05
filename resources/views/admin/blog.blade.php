@extends('layouts.admin')

@section('title', 'Blog')

@section('content')
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">@yield('title')</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-3 text-end">
                    <a href="/blog/create" class="btn btn-primary"><i class="mdi mdi-plus"></i> Add Data</a>
                </div>
                <div class="col-md-12">
                    {{ $dataTable->table(['class' => 'table table-bordered table-striped']) }}
                </div>
            </diV>
        </div>
    </div>

    <div class="modal fade" id="imageModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="imageModalLabel">Image</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="margin: auto">
              <img src="" id="modalImage" class="img-fluid">
            </div>
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
        window.LaravelDataTables["blog-table"].ajax.reload();
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
                        url: "{{route('blog.destroy')}}",
                        type: "POST",
                        data: { slug : slug },
                        dataType: "JSON",
                        success: function(data) {
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: data.text,
                            })
                            window.LaravelDataTables["blog-table"].ajax.reload();
                        }
                    })
                }
            })
        };

        $(document).on('click', '[data-bs-toggle="modal"]', function (e) {
            var titleLabel = $(this).data('title');
            var imageSrc = $(this).data('img');
            $("#modalImage").attr("src", imageSrc);
            $("#imageModalLabel").text(titleLabel);
        });
    </script>
@endpush
