@extends('layouts.app')

@section('title', 'Subjects')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Subject</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <form action="{{ route('admin.subject.update', $subject->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card">
                                <div class="card-header">
                                    <h4>Edit subject</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Subject</label>
                                        <input type="text" name="subject"
                                            class="form-control @error('subject') is-invalid @enderror"
                                            placeholder="type subject" value="{{ old('subject', $subject->subject) }}">
                                        @error('subject')
                                            <div class="invalid-feedback" style="display: block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" name="description"
                                            class="form-control @error('description') is-invalid @enderror"
                                            placeholder="type description"
                                            value="{{ old('description', $subject->description) }}">
                                        @error('description')
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
