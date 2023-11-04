@extends('layouts.app')

@section('title', 'Photos')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Photos</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Photoss</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Upload Photo</h4>
                            </div>
                            <form action="{{ route('admin.photo.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="image"
                                            class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                            <div class="invalid-feedback" style="display: block">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label>Caption</label>
                                        <input type="text" name="caption"
                                            class="form-control @error('caption') is-invalid @enderror">
                                        @error('caption')
                                            <div class="invalid-feedback" style="display: block">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                    <button class="btn btn-primary mr-1" type="submit">
                                        <i class="fa fa-save"></i>
                                        Save</button>
                                    <button class="btn btn-light btn-reset" type="reset"> <i class="fa fa-refresh"></i>
                                        Reset</button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Photos</h4>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 15%;text-align: center">#</th>
                                            <th scope="col" style="text-align: center">Photo</th>
                                            <th scope="col" style="text-align: center">Caption</th>
                                            <th scope="col" style="width: 15%;text-align: center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($photos as $no => $photo)
                                            <tr>
                                                <td style="text-align:center">
                                                    {{ ++$no + ($photos->currentPage() - 1) * $photos->perPage() }}
                                                </td>
                                                <td class="mt-2 text-center"><img src="{{ $photo->image }}"
                                                        style="width:300px" alt="" srcset=""></td>
                                                <td>{{ $photo->caption }}</td>

                                                <td class="text-center">
                                                    @can('photos.delete')
                                                        <button onClick="Delete(this.id)" class="btn btn-sm  btn-danger"
                                                            id="{{ $photo->id }}"><i class="fas fa-trash"></i></button>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div style="text-align: center">
                                    {{ $photos->links() }}
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </div>
    <script>
        //ajax delete
        function Delete(id) {
            var id = id;
            var token = $("meta[name='csrf-token']").attr("content");

            swal({
                title: "ARE YOU SURE ?",
                text: "WANT TO DELETE THIS DATA!",
                icon: "warning",
                buttons: [
                    'CANCEL',
                    'YES'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {

                    //ajax delete
                    jQuery.ajax({
                        url: "/admin/photo/" + id,
                        data: {
                            "id": id,
                            "_token": token
                        },
                        type: 'DELETE',
                        success: function(response) {
                            if (response.status == "success") {
                                swal({
                                    title: 'SUCCESS!',
                                    text: 'DELETE DATA SUCCESSFULLY!',
                                    icon: 'success',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            } else {
                                swal({
                                    title: 'FAILED!',
                                    text: 'DELETE DATA FAILED!',
                                    icon: 'error',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        }
                    });

                } else {
                    return true;
                }
            })
        }
    </script>
@endsection
