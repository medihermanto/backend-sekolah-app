@extends('layouts.app')

@section('title', 'Table')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Role</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <form action="{{ route('admin.role.update', $role->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card">
                                <div class="card-header">
                                    <h4>Edit data role</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Role Name</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="type role name" value="{{ old('name', $role->name) }}">
                                        @error('name')
                                            <div class="invalid-feedback" style="display: block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="d-block">Permissions</label>
                                        @foreach ($permissions as $permission)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox"
                                                    value="{{ $permission->name }}" name="permissions[]"
                                                    id="check-{{ $permission->id }}"
                                                    @if ($role->permissions->contains($permission)) checked @endif>
                                                <label class="form-check-label" for="check-{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <a href="{{ url()->previous() }}" class="btn btn-warning mr-1"> <i
                                            class="fa fa-reply-all"></i>
                                        Back</a>
                                    <button class="btn btn-primary mr-1" type="submit"> <i class="fa fa-save"></i>
                                        Save</button>
                                    <button class="btn btn-light btn-reset" type="reset"> <i class="fa fa-refresh"></i>
                                        Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
