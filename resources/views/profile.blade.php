@extends('layout.master')
@push('plugin-styles')
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Profile</h6>
                        <p class="card-description">Update Profile</p>
                        <form method="POST" action="{{route('profil.update')}}">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="nama"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                                        <div class="col-md-6">
                                            <input id="nama" type="text" class="form-control" name="nama"
                                                value="{{ $user->nama }}" required autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="tgl_lahir"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Lahir') }}</label>

                                        <div class="col-md-6">
                                            <input id="tgl_lahir" type="date" class="form-control" name="tgl_lahir"
                                                value="{{ $user->tgl_lahir }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="alamat"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Alamat') }}</label>

                                        <div class="col-md-6">
                                            <input id="alamat" type="text" class="form-control" name="alamat"
                                                value="{{ $user->alamat }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jk"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Jenis Kelamin') }}</label>

                                        <div class="col-md-6">
                                            <select name="jk" class="form-control" required>
                                                <option value="Laki-laki"
                                                    {{ $user->jk == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="Perempuan" {{ $user->jk == 'Perempuan' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group row">
                                        <label for="no_hp"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Nomor HP') }}</label>

                                        <div class="col-md-6">
                                            <input id="no_hp" type="text" class="form-control" name="no_hp"
                                                value="{{ $user->no_hp }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email"
                                            class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control" name="email"
                                                value="{{ $user->email }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control" name="password"
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password-confirm"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                            <div class="col-md-6">
                                            <input id="password_confirmation" type="password" class="form-control"
                                            name="password_confirmation">
                                            </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Simpan') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
@endpush
