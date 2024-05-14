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
    @include('vote.patials.topNavBar')

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
                        @foreach($users as $user)
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
