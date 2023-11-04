@extends('layouts.app')

@section('title', 'Profiles')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>New profile</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <form action="{{ route('admin.profile.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h4>Add new profile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="content">Sambutan Pimpinan</label>
                                                <textarea class="form-control content @error('opening_speech') is-invalid @enderror" name="opening_speech"
                                                    placeholder="Type the opening_speech post here" rows="25">{!! old('opening_speech') !!}</textarea>
                                                @error('opening_speech')
                                                    <div class="invalid-feedback" style="display: block">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Foto Pimpinan</label>
                                                <input type="file" name="image"
                                                    class="form-control @error('image') is-invalid @enderror">
                                                @error('image')
                                                    <div class="invalid-feedback" style="display: block">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="content">VISI</label>
                                                <textarea class="form-control content @error('visi') is-invalid @enderror" name="visi"
                                                    placeholder="Type the visi post here" rows="25">{!! old('visi') !!}</textarea>
                                                @error('visi')
                                                    <div class="invalid-feedback" style="display: block">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="content">MISI</label>
                                                <textarea class="form-control content @error('misi') is-invalid @enderror" name="misi"
                                                    placeholder="Type the misi here" rows="25">{!! old('misi') !!}</textarea>
                                                @error('misi')
                                                    <div class="invalid-feedback" style="display: block">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="content">Profile</label>
                                                <textarea class="form-control content @error('profile') is-invalid @enderror" name="profile"
                                                    placeholder="Type the profile here" rows="25">{!! old('profile') !!}</textarea>
                                                @error('profile')
                                                    <div class="invalid-feedback" style="display: block">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="content">Struktur Organisasi</label>
                                                <textarea class="form-control content @error('struktur_organisasi') is-invalid @enderror" name="struktur_organisasi"
                                                    placeholder="Type the organization structure here" rows="25">{!! old('struktur_organisasi') !!}</textarea>
                                                @error('struktur_organisasi')
                                                    <div class="invalid-feedback" style="display: block">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Informasi Pendaftaran</label>
                                        <textarea class="form-control content @error('informasi_pendaftaran') is-invalid @enderror" name="informasi_pendaftaran"
                                            placeholder="Type the register information here" rows="25">{!! old('informasi_pendaftaran') !!}</textarea>
                                        @error('informasi_pendaftaran')
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.6.2/tinymce.min.js"></script>
    <script>
        var editor_config = {
            selector: "textarea.content",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
        };

        tinymce.init(editor_config);
    </script>
@endsection
