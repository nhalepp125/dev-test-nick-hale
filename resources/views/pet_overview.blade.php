<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Overview</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-3">
        <a href="{{ url('/') }}" class="btn btn-primary mb-3">Back to List</a>

        <div class="card">
            <img src="{{ $pet['image'] }}" class="card-img-top" alt="{{ $pet['name'] }}" style="width: 70%; height: auto; margin: 0 auto;">

            <div class="card-body">
                <h5 class="card-title">{{ $pet['name'] }}</h5>
                <p class="card-text"><strong>Type:</strong> {{ $pet['pet_type'] }}</p>
                <p class="card-text"><strong>Origin:</strong> {{ $pet['origin'] }}</p>
                <p class="card-text"><strong>Temperament:</strong> {{ $pet['temperament'] }}</p>
                <p class="card-text"><strong>Life Span:</strong> {{ $pet['life_span'] }} years</p>
            </div>
        </div>
    </div>
</body>
</html>