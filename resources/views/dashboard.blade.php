@extends('layouts.app')

@section('title', 'Home')

@push('style')
    <style>
        #searchInput {
            padding: 10px 22px;
            border-color: var(--primary-bg-color-dark);
            min-width: 350px;
        }

        .searchInput-icon {
            right: 22px;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
@endpush

@section('content')
    <h3 class="typewriter mb-4">
        <span id="typewriterText">What pet are you looking for?</span>
    </h3>

    <form class="d-flex justify-content-center w-100" style="max-width: 800px;">
        <div class="position-relative w-100">
            <input id="searchInput" class="form-control me-2 rounded-5 form-control-lg" type="search" placeholder="Search" aria-label="Search">
            <i class="ph ph-magnifying-glass position-absolute searchInput-icon"></i>
        </div>
    </form>

    <div class="pets-list mt-4">
        <h4>Available Pets</h4>
        <ul class="list-group" id="petList">
            @foreach($pets as $pet)
                <li class="list-group-item pet-list-item" data-pet-name="{{ strtolower($pet['name']) }}">
                    <a href="{{ route('pet.overview', ['id' => $pet['id']]) }}" class="btn btn-link text-decoration-none text-dark p-0">
                        <h5>{{ $pet['name'] }} - 
                            <span class="pet-type" style="font-weight: lighter; font-size: 0.9em;">
                                {{ $pet['pet_type'] }}
                            </span>
                        </h5>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    
    
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('searchInput').focus();

            const titles = [
                "Looking for a Dog Breed?",
                "Searching for a Cat Breed?",
                "What Dog Breed Fits You?",
                "Find Your Perfect Feline Companion",
                "Explore Cat Breeds by Trait",
                "Discover Rare Dog Breeds",
                "Which Breed is Right for Your Family?",
                "Find Cat Breeds with Unique Traits",
                "Discover Dogs by Size and Temperament"
            ];

            const randomTitle = titles[Math.floor(Math.random() * titles.length)];
            document.getElementById('typewriterText').textContent = randomTitle;

            const searchInput = document.getElementById('searchInput');
            const petListItems = document.querySelectorAll('.pet-list-item');

            searchInput.addEventListener('input', function() {
                const searchTerm = searchInput.value.toLowerCase();

                petListItems.forEach(function(item) {
                    const petName = item.getAttribute('data-pet-name');
                    
                    if (petName.includes(searchTerm)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endpush
