@extends('layouts.app')

@section('title', 'Table')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Permissions</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Permissions</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Permissions</h4>
                            </div>
                            <div class="card-body">
                                <div class="col-12 col-md-12 col-lg-12 d-flex justify-content-end">
                                    <form action="{{ route('admin.permission.index') }}" method="get">
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
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Permission Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $permission)
                                            <tr>
                                                <td>{{ $permission->name }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div style="text-align: center">
                                    {{ $permissions->links() }}
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
