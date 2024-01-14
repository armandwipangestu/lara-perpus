@extends('layouts.main')

@section('container')
                {{-- <div class="col-12 col-md-6 order-md-2 order-first">
                    {{ Breadcrumbs::render('user', $user) }}
                </div>
            </div>
        </div>
    </div> --}}

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show ml-4 mr-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="flex">
        <div class="float-end">
            <label class="form-label">Last edited: {{ (new DateTime($user->updated_at))->format('l, j F Y H:m:s') }}</label>
        </div>
    </div>

    <section id="my-profile">
        <form action="/user" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <input type="hidden" name="oldImage" value="{{ $user->avatar_image }}">
                                <div class="avatar avatar-2xl" onclick="chooseFile()">
                                    <img src="{{ asset('storage/assets/img/' . $user->avatar_image) }}" alt="Avatar Image" class="cursor-pointer hover-scale img-preview">
                                    <input type="file" id="avatar_image" style="display: none;" name="avatar_image" onchange="previewImage()" class="image-preview">
                                </div>

                                @if($errors->get('avatar_image'))
                                    <div class="alert alert-danger mt-3">
                                        <ul>
                                            @foreach ($errors->get('avatar_image') as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                
                                <h3 class="mt-3">
                                    {{ $user->username }}
                                </h3>
                                <p class="text-small">
                                    {{ $user->role->name }} - Since: {{ (new DateTime($user->created_at))->format('l, j F Y') }}
                                </p>
                                <ul class="text-small text-muted mt-3">
                                    <li>Max upload file: <b>2MB</b></li>
                                    <li>Allowed extension: <b>JPG and PNG</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="first_name" class="form-label">
                                    First Name
                                </label>
                                <input type="text" name="first_name" id="first_name" class="form-control @error('first_name')
                                    is-invalid
                                @enderror" value="{{ old('first_name', $user->first_name) }}" required />
                                @error('first_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="last_name" class="form-label">
                                    Last Name
                                </label>
                                <input type="text" name="last_name" id="last_name" class="form-control @error('last_name')
                                    is-invalid
                                @enderror" value="{{ old('last_name', $user->last_name) }}" required />
                                @error('last_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="username" class="form-label">
                                    Username
                                </label>
                                <input type="text" name="username" id="username" class="form-control @error('username')
                                    is-invalid
                                @enderror" value="{{ old('username', $user->username) }}" required />
                                <label for="username" class="form-label text-muted mt-2">Minimum 3 character, only lowercase letters and numbers, no symbols. Example: <strong>foobar</strong></label>
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="gender" class="form-label">
                                    Gender
                                </label>
                                <select name="gender" id="gender" class="form-select form-control @error('gender')
                                    is-invalid
                                    @enderror" id="basicSelect">
                                    <option value="" selected disabled>Select Gender</option>
                                    @foreach (['Male', 'Female'] as $genderOption)
                                        @if (old('gender', $user->gender) == $genderOption)
                                            <option value="{{ $genderOption }}" selected>{{ $genderOption }}</option>
                                        @else
                                            <option value="{{ $genderOption }}">{{ $genderOption }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="address" class="form-label">
                                    Address
                                </label>
                                <textarea id="address" name="address" class="form-control @error('address')
                                    is-invalid
                                @enderror" style="height: 100px !important;">{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone_number" class="form-label">
                                    Phone Number
                                </label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control @error('phone_number')
                                    is-invalid
                                @enderror" value="{{ old('phone_number', $user->phone_number) }}" required />
                                @error('phone_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="email" class="form-label">
                                    Email
                                </label>
                                <input type="text" name="email" id="email" class="form-control @error('email')
                                    is-invalid
                                @enderror" value="{{ old('email', $user->email) }}" required />
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group float-end mt-2">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection

<script>
    const chooseFile = () => {
        document.getElementById('avatar_image').click();
    }
</script>