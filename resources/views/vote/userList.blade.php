<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


</head>

<body>
    {{-- @include('vote.patials.topNavBar') --}}

        <!-- Button to trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createCommissionerModal">
            Register A Commissioner
        </button>

        <!-- Create commissioners Modal -->
        <div class="modal fade" id="createCommissionerModal" tabindex="-1" aria-labelledby="createCommissionerModal"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createCommissionerModalLabel">Create Commissioner</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header">{{ __('Register') }}</div>

                                        <div class="card-body">
                                            <form method="POST" action="{{ route('register') }}"  enctype="multipart/form-data" >
                                                @csrf

                                                <div class="row mb-3">
                                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                                        <select id="user_type" class="form-select @error('user_type') is-invalid @enderror" name="user_type" required>
                                                            <option value="Executive Commissioner" {{ old('user_type') == 'Executive Commissioner' ? 'selected' : '' }}>Electoral Commissioner</option>
                                                            <option value='Deputy Commission' {{ old('user_type') == 'Deputy Commission' ? 'selected' : '' }}>Deputy Commission</option>
                                                            <option value="Registerer" {{ old('user_type') == 'Registerer' ? 'selected' : '' }}>Registerer</option>
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
                                                    <div class="col-md-6 offset-md-4">
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('Register') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>



    <div class="container">
        <div class="row">
            <div class="col">
                <table class="table" id="votersTable">
                    <thead>
                        <tr>
                            <th scope="col">Picture</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">User Type</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commissioners as $user)
                        <tr>
                            <td>
                                <style>
                                    .candidate-picture {
                                        max-width: 50px; /* Set the maximum width of the picture */
                                        max-height: 50px; /* Set the maximum height of the picture */
                                        border-radius: 50%; /* Optional: Make the picture round */
                                    }
                                </style>
                                <img src="{{ asset('storage/' . $user->picture_path) }}" alt="candidate Picture" class="candidate-picture">
                            </td>


                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->user_type }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <style>
                                        .btn-group a,
                                        .btn-group form {
                                            display: inline-block;
                                            margin-right: 5px; /* Adjust the margin as needed for spacing between buttons */
                                        }
                                    </style>
                                    <a href="{{ URL::route('members.edit', $user) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form method="POST" action="{{ route('members.destroy', $user) }}"
                                          onsubmit="return confirm('Are you sure you want to delete this Candidate?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function () {
            $('#votersTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true
            });
        });
    </script>
</body>

</html>
