@extends('layouts.app')

@section('title', 'Teachers')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Teachers</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Teachers</div>
                </div>
            </div>


            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Teachers</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @can('teachers.create')
                                        <div class="col-6 col-sm-6 col-lg-6">
                                            <a href="{{ route('admin.teacher.create') }}" class="btn btn-primary"> <i
                                                    class="fa fa-plus-square"></i> Add
                                                Data</a>
                                        </div>
                                    @endcan
                                    <div class="col-6 col-md-6 col-lg-6 d-flex justify-content-end">
                                        <form action="{{ route('admin.teacher.index') }}" method="get">
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

                                <div class="table-responsive">
                                    <table class="table table-hover table-stripped">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 8%;text-align: center">#</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Date of Birth</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Position</th>
                                                <th scope="col">Subject</th>
                                                <th scope="col" style="width: 15%;text-align: center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($teachers as $no => $teacher)
                                                <tr>
                                                    <td style="text-align:center" style="width: 8%;text-align: center">
                                                        {{ ++$no + ($teachers->currentPage() - 1) * $teachers->perPage() }}
                                                    </td>
                                                    <td>
                                                        @if (trim($teacher->image, 'http://localhost:8000/storage/teachers'))
                                                            <img src="{{ $teacher->image }}" class="m-1" width="100px"
                                                                height="150" alt="" srcset="">
                                                        @else
                                                            <img src="{{ asset('img/profile.png') }}" class="m-1"
                                                                width="100px" height="100" alt="" srcset="">
                                                        @endif
                                                    </td>
                                                    <td>{{ $teacher->name }}</td>
                                                    <td>{{ $teacher->date_of_birth }}</td>
                                                    <td>{{ $teacher->phone }}</td>
                                                    <td>{{ $teacher->email }}</td>
                                                    <td>{{ $teacher->position }}</td>
                                                    <td>{{ $teacher->subject->subject ?? 'No Data' }}</td>
                                                    <td class="text-center">
                                                        @can('teachers.edit')
                                                            <a href="{{ route('admin.teacher.edit', $teacher->id) }}"
                                                                class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                        @endcan
                                                        @can('teachers.delete')
                                                            <button onClick="Delete(this.id)" class="btn btn-sm  btn-danger"
                                                                id="{{ $teacher->id }}"><i class="fas fa-trash"></i></button>
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <div style="text-align: center">
                                    {{ $teachers->links() }}
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
                        url: "/admin/teacher/" + id,
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
