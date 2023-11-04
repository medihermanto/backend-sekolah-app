@extends('layouts.app')

@section('title', 'Teachers')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>New Teacher</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <form action="{{ route('admin.teacher.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h4>Add new teacher</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Image Profile</label>
                                        <input type="file" name="image"
                                            class="form-control @error('image') is-invalid @enderror"
                                            value="{{ old('image') }}" required>
                                        @error('image')
                                            <div class="invalid-feedback" style="display: block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Teacher Name</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror" placeholder="Full name"
                                            value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback" style="display: block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Date of Birth</label>
                                                <input type="date" name="date_of_birth"
                                                    class="form-control @error('date_of_birth') is-invalid @enderror"
                                                    value="{{ old('date_of_birth') }}" required>
                                                @error('date_of_birth')
                                                    <div class="invalid-feedback" style="display: block">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" name="phone"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    placeholder="Phone" value="{{ old('phone') }}" required>
                                                @error('phone')
                                                    <div class="invalid-feedback" style="display: block">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="Email" value="{{ old('email') }}" required>
                                                @error('email')
                                                    <div class="invalid-feedback" style="display: block">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Position</label>
                                                <input type="text" name="position"
                                                    class="form-control @error('position') is-invalid @enderror"
                                                    placeholder="Position" value="{{ old('position') }}" required>
                                                @error('position')
                                                    <div class="invalid-feedback" style="display: block">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Subject</label>
                                        <select name="subject_id" id=""
                                            class="form_control @error('subject_id') is-invalid
                                        @enderror">
                                            <option value="">--Choose Subject--</option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                                            @endforeach
                                        </select>
                                        @error('subject_id')
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
