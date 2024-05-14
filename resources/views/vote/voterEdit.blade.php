@vite(['resources/sass/app.scss', 'resources/js/app.js'])


<div class="modal-body">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <style>
                        .voter-picture {
                            max-width: 50px; /* Set the maximum width of the picture */
                            max-height: 50px; /* Set the maximum height of the picture */
                            border-radius: 50%; /* Optional: Make the picture round */
                        }
                    </style>
                    <img src="{{ asset('storage/' . $voter->picture_path) }}" class="voter-picture" alt="picture" style="max-width: 150px; max-height: 150px;">

                    <span> Edit <strong>{{$voter->name}}</strong> </span>

                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('voters.update', $voter) }}"  enctype="multipart/form-data" >
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{$voter->name}}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{$voter->email}}">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="user_type" class="col-md-4 col-form-label text-md-end">{{ __('User Type') }}</label>
                        
                            <div class="col-md-6">
                                <select id="user_type" class="form-select @error('user_type') is-invalid @enderror" name="user_type" required aria-placeholder="{{$voter->user_type}}">
                                    {{-- <option value="electoralCommissioner" {{ old('user_type') == 'electoralCommissioner' ? 'selected' : '' }}>Electoral Commissioner</option>
                                    <option value="candidate" {{ old('user_type') == 'candidate' ? 'selected' : '' }}>Candidate</option> --}}
                                    <option value="voter" {{ old('user_type') == 'voter' ? 'selected' : '' }}>Voter</option>
                                </select>
                        
                                @error('user_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="picture" class="col-md-4 col-form-label text-md-end">{{ __('Picture') }}</label>
                        
                            <div class="col-md-6">
                                <input id="picture" type="file" class="form-control @error('picture') is-invalid @enderror" name="picture" accept="image/*" required>
                        
                                @error('picture')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        <div class="row mb-0">
                            <style>
                                .btn-group a,
                                .btn-group button {
                                    display: inline-block;
                                    margin-right: 50px; /* Adjust the margin as needed for spacing between buttons */
                                    margin-left: 50px
                                }
                            </style>
                            
                            <div class="btn-group" role="group">

                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit') }}
                                </button>

                                <a href="{{ URL::route('voters.index', $voter) }}" class="btn btn-danger btn-sm">Cancel</a>

                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

