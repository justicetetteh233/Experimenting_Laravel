<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cast Vote</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .candidate-card {
            margin-bottom: 50px;
        }

        .candidate-image {
            height: 200px;
            object-fit: cover;
        }

        
    </style>

</head>
<body>



    <div class="container mt-5">
        
        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">Vote Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p style="color: green">Vote cast successfully!</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bootstrap modal HTML for error alert -->
        <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="errorModalLabel">Vote Denied for More than one candidate at a position</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Please check cast votes and vote for pending positions only.</p>
                    </div>
                </div>
            </div>
        </div>
        

        <h1>Cast Your Vote</h1>

        <div class="form-group">
            <label for="position">Select Position</label>
            <select class="form-control" id="position" name="positions_id" required>
                <option value="">Select Position</option>
                @foreach($positions as $position)
                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                @endforeach
            </select>
        </div>

        <div id="candidateCardsContainer" style="display: none; display:flex;">
            <!-- Candidate cards will be dynamically generated here -->
        </div>


    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#position').change(function() {
                var selectedPositionId = $(this).val();
                if (selectedPositionId) {
                    var baseUrl = "{{ asset('storage/') }}";
                    $.ajax({
                        url: '/getCandidatesByPosition/' + selectedPositionId,
                        type: 'GET',
                        success: function(response) {
                            var candidates = response.candidates;
                            var candidateCardsHtml = '';
                            candidates.forEach(function(candidate) {
                                var candidateImage = candidate.picture_path ? baseUrl +'/'+ candidate.picture_path : 'no-picture.jpg';
                                candidateCardsHtml += `
                                    <div class="col-md-4">
                                        <div class="card candidate-card">
                                            <img src="${candidateImage}" class="card-img-top candidate-image" alt="${candidate.name}">
                                            <div class="card-body">
                                                <h5 class="card-title">${candidate.name}</h5>
                                                <p class="card-text">Position: ${candidate.position.name}</p>
                                                <form action="{{ route('votecasts.store') }}" method="POST" id="voteForm_${candidate.id}">
                                                    @csrf
                                                    <input type="hidden" name="positions_id" value="${selectedPositionId}">
                                                    <input type="hidden" name="candidates_id" value="${candidate.id}">
                                                    <button type="submit" class="btn btn-primary">Vote</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            });
                            $('#candidateCardsContainer').html(candidateCardsHtml).fadeIn();
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    $('#candidateCardsContainer').fadeOut().html('');
                }
            });
    
            // Submit the form and handle success/failure
            $(document).on('submit', 'form', function(e) {
            e.preventDefault(); // Prevent the default form submission

            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                type: 'POST',
                url: url,
                data: form.serialize(),
                success: function(response) {
                    // Show success alert modal
                    $('#successModal').modal('show');
                    // Optionally, you can redirect or update the UI here
                },
                error: function(xhr, status, error) {
                    // Show error alert modal
                    $('#errorModal').modal('show');
                    // Optionally, you can display error details or retry
                }
                });
            });


        });
    </script>
    
    
    
</body>
</html>
