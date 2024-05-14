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
   

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Notifications</div>

                    <div class="card-body">
                        <ul>
                            @foreach($notifications as $notification)
                                <li>{{ $notification->data['info'] }}</li>
                            @endforeach
                        </ul>

                        {{ $notifications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
