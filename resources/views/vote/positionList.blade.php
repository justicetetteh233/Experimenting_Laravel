<html>
    
<head>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>   
    
    <script>
        $(document).ready(function() {
            $('#positions-table').DataTable();
        });
    </script>    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    @include('vote.patials.topNavBar')

<div class="modal fade" id="addPositionModal" tabindex="-1" aria-labelledby="addPositionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPositionModalLabel">Add Position</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('positions.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Position</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Button to trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPositionModal">
    Add Position
</button>
<hr>

<!-- Positions Table -->
<table id="positions-table" class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th> <!-- Add a header for actions -->
        </tr>
    </thead>
    <tbody>
        @foreach ($positions as $position)
            <tr>
                <td>{{ $position->name }}</td>
                <td>{{ $position->description }}</td>
                <td>
                    <!-- Edit Button -->
                    <a href="{{ route('positions.edit', $position) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <!-- Delete Form -->
                    <form method="POST" action="{{ route('positions.destroy', $position) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this position?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


</body>

</html>