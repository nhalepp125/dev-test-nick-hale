<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;
use App\Repositories\PetRepositoryInterface;


class DogRepository implements PetRepositoryInterface
{
  private string $url;

  public function __construct(){
    $this->url = 'https://api.thedogapi.com/v1/breeds';
  }

    /**
     * Fetch all dog breeds from the API.
     *
     * @return array
     */
    public function getAll(): array
    {
      try {
        $response = Http::withHeaders([
          'x-api-key' => env('API_DOG'),
        ])->get($this->url);

        if ($response->successful()) {
            return $response->json();
        }

        return [];
      } catch (\Exception $e) {
        Log::error('Dog API request failed', [
          'message' => $e->getMessage(),
        ]);   
          
        return [];
      }



    }
}