@extends('layouts.app')

@section('title', 'Students')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Students</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Students</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Import Students</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @can('students.create')
                                        <div class="col-6 col-sm-6 col-lg-6">
                                            <a href="{{ asset('template.xlsx') }}" class="btn btn-info"> <i
                                                    class="fa fa-cloud-download"></i> Download Format</a>
                                        </div>
                                        <div class="col-6 col-sm-6 col-lg-6">
                                            <form action="{{ route('students.import') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <input type="file" name="file" class="form-control">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-warning"><i class="fa fa-cloud-upload"></i>
                                                                Import Excel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @endcan
                                </div>


                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Students</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @can('students.create')
                                        <div class="col-6 col-sm-6 col-lg-6">
                                            <a href="{{ route('admin.student.create') }}" class="btn btn-primary"> <i
                                                    class="fa fa-plus-square"></i> Add
                                                Data</a>
                                            <a href="{{ route('students.export') }}" class="btn btn-info"> <i
                                                    class="fa fa-cloud-download"></i> Excel</a>
                                            <a href="{{ route('students.exportpdf') }}" class="btn btn-secondary"> <i
                                                    class="fa fa-cloud-download"></i> PDF</a>
                                        </div>
                                    @endcan
                                    <div class="col-6 col-md-6 col-lg-6 d-flex justify-content-end">
                                        <form action="{{ route('admin.student.index') }}" method="get">
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
                                                <th scope="col" style="width: 10%;text-align: center">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col" style="width: 15%;text-align: center">Date of Birth</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Class</th>
                                                <th scope="col" style="width: 15%;text-align: center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($students as $no => $student)
                                                <tr>
                                                    <td style="text-align:center">
                                                        {{ ++$no + ($students->currentPage() - 1) * $students->perPage() }}
                                                    </td>
                                                    <td>{{ $student->name }}</td>
                                                    <td style="width: 15%;text-align: center">{{ $student->date_of_birth }}
                                                    </td>
                                                    <td>{{ $student->address }}</td>
                                                    <td>{{ $student->phone }}</td>
                                                    <td>{{ $student->email }}</td>
                                                    <td>{{ $student->classes->name }}</td>
                                                    <td class="text-center">
                                                        @can('students.edit')
                                                            <a href="{{ route('admin.student.edit', $student->id) }}"
                                                                class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                        @endcan
                                                        @can('students.delete')
                                                            <button onClick="Delete(this.id)" class="btn btn-sm  btn-danger"
                                                                id="{{ $student->id }}"><i class="fas fa-trash"></i></button>
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <div style="text-align: center">
                                    {{ $students->links() }}
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
                        url: "/admin/student/" + id,
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
