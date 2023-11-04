@extends('layouts.app')

@section('title', 'Profiles')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profiles</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Profiles</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Profiles</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @can('posts.create')
                                        <div class="col-6 col-sm-6 col-lg-6">
                                            <a href="{{ route('admin.profile.create') }}" class="btn btn-primary"> <i
                                                    class="fa fa-plus-square"></i> Add
                                                Data</a>
                                        </div>
                                    @endcan
                                    <div class="col-6 col-md-6 col-lg-6 d-flex justify-content-end">
                                        <form action="{{ route('admin.profile.index') }}" method="get">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <input type="text" name="q" placeholder="Type name..."
                                                        class="form-control">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-primary"><i
                                                                class="fa fa-search"></i> Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 15%;text-align: center">#</th>
                                            <th scope="col">Visi</th>
                                            <th scope="col">Misi</th>
                                            <th scope="col" style="width: 15%;text-align: center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($profiles as $no => $profile)
                                            <tr>
                                                <td style="text-align:center">
                                                    {{ ++$no + ($profiles->currentPage() - 1) * $profiles->perPage() }}
                                                </td>
                                                <td>{!! $profile->visi !!}</td>
                                                <td>{!! $profile->misi !!}</td>
                                                <td class="text-center">
                                                    @can('profiles.edit')
                                                        <a href="{{ route('admin.profile.edit', $profile->id) }}"
                                                            class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                    @endcan
                                                    @can('profiles.delete')
                                                        <button onClick="Delete(this.id)" class="btn btn-sm  btn-danger"
                                                            id="{{ $profile->id }}"><i class="fas fa-trash"></i></button>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div style="text-align: center">
                                    {{ $profiles->links() }}
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
                        url: "/admin/profile/" + id,
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
