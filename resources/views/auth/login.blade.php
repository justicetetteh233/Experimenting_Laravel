<!DOCTYPE html>
<html lang="en">


<head>
@vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body style="background: red;">
<div class="container" style="margin-top:10%;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><center><b>LOGIN</b></center></div>

                <div class="card-body">
                    <form id="loginForm" method="POST" action="">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="user_type" class="col-md-4 col-form-label text-md-end">{{ __('User Type') }}</label>

                            <div class="col-md-6">

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="user_type" id="electoralCommissioner" value="electoralCommissioner" {{ old('user_type') === 'electoralCommissioner' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="electoral_commissioner">Electoral Commissioner</label>
                                </div><br>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="user_type" id="candidate" value="candidate" {{ old('user_type') === 'candidate' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="candidate">Candidate</label>
                                </div><br>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="user_type" id="voter" value="voter" {{ old('user_type') === 'voter' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="vote">Voter</label>
                                </div>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="button" id="submitBtn" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button><br>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a><br>
                                @endif

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('register') }}">{{ __('Register Instead') }}</a><br>
                                @endif

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add event listener to the submit button
        document.getElementById('submitBtn').addEventListener('click', function () {
            // Get the selected user type
            var userType = document.querySelector('input[name="user_type"]:checked');
    
            // Check if a user type is selected
            if (userType) {
                // Set the action of the form based on the selected user type
                if (userType.value === 'voter') {
                    document.getElementById('loginForm').action = '{{ route("voterLogin") }}';
                } else if (userType.value === 'electoralCommissioner') {
                    document.getElementById('loginForm').action = '{{ route("login") }}';
                }else if (userType.value === 'candidate') {
                    document.getElementById('loginForm').action = '{{ route("candidateLogin") }}';
                }
    
    
                // Submit the form
                document.getElementById('loginForm').submit();
            } else {
                alert('Please select a user type.');
            }
        });
    });
</script>
