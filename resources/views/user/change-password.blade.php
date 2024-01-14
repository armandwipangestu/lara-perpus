@extends('layouts.main')

@section('container')
                {{-- <div class="col-12 col-md-6 order-md-2 order-first">
                    {{ Breadcrumbs::render('test', $test) }}
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

    <div class="main-content">
        <section class="section">
            <div class="card card-primary">

                <div class="card-body">
                    <form action="/user/change-password" method="POST">
                        @method('PUT')
                        @csrf

                        <!-- Current Password Field -->
                        <div class="form-group">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" name="current_password" id="current_password" class="form-control @error('current_password')
                                is-invalid
                            @enderror" required>
                            @error('current_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- New Password Field -->
                        <div class="form-group">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" name="new_password" id="new_password" class="form-control @error('new_password')
                                is-invalid
                            @enderror" required>
                            <label for="new_password" class="form-label text-muted mt-2">Minimum 8 character</label>
                            @error('new_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Confirm New Password Field -->
                        <div class="form-group">
                            <label for="confirm_new_password" class="form-label">Confirm New Password</label>
                            <input type="password" name="confirm_new_password" id="confirm_new_password" class="form-control @error('confirm_new_password')
                                is-invalid
                            @enderror" required>
                            @error('confirm_new_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-md btn-block neu-brutalism">
                                Change Password
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </section>
    </div>
@endsection