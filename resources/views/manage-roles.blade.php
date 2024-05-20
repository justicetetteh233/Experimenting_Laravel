<!-- resources/views/manage-roles.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Manage Roles and Permissions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Manage Roles and Permissions</h2>
        <form action="{{ route('manage_roles.update') }}" method="POST">
            @csrf
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>Permissions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                @foreach($permissions as $permission)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[{{ $role->id }}][]" value="{{ $permission->id }}"
                                            {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                        <label class="form-check-label">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Update Permissions</button>
        </form>
    </div>
</body>
</html>
