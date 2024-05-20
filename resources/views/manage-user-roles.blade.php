<!-- resources/views/manage-roles.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Give User Role</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Change User Role</h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('manage_user_roles.update') }}" method="POST">
            @csrf
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commissioners as $commissioner)
                        <tr>
                            <td>{{ $commissioner->name }}</td>
                            <td>
                                @foreach($roles as $role)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="roles[{{ $commissioner->id }}][]" value="{{ $role->name }}"
                                            {{ $commissioner->hasRole($role->name) ? 'checked' : '' }}>
                                        <label class="form-check-label">
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Update User Role</button>
        </form>
    </div>
</body>
</html>
