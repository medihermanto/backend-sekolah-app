@extends('layouts.app')

@section('title', 'Classes')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Class</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <form action="{{ route('admin.class.update', $classes->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card">
                                <div class="card-header">
                                    <h4>Edit class</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Class Name</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="type your class name" value="{{ old('name', $classes->name) }}"
                                            required>
                                        @error('name')
                                            <div class="invalid-feedback" style="display: block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Teacher</label>
                                        <select name="teacher_id" id="" class="form_control">
                                            <option value="">--Choose Teacher--</option>
                                            @foreach ($teachers as $teacher)
                                                <option value="{{ $teacher->id }}"
                                                    {{ $teacher->id == $classes->teacher_id ? 'selected' : '' }}>
                                                    {{ $teacher->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('name')
                                            <div class="invalid-feedback" style="display: block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <a href="{{ url()->previous() }}" class="btn btn-warning mr-1"> <i
                                            class="fa fa-reply-all"></i>
                                        Back</a>
                                    <button class="btn btn-primary mr-1" type="submit">
                                        <i class="fa fa-save"></i>
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
