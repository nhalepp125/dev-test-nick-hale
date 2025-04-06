<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Repositories\PetRepositoryInterface;

class CatRepository implements PetRepositoryInterface
{
  private string $url;

  public function __construct()
  {
    $this->url = 'https://api.thecatapi.com/v1/breeds';
  }

  /**
   * Fetch all cat breeds from the API.
   * 
   * @return array
   */
    public function getAll(): array
    {
      try {
        $response = Http::withHeaders([
          'x-api-key' => env('API_CAT'),
        ])->get($this->url);

    
        if ($response->successful()) {
            return $response->json();
        }

        return [];
      } catch (\Exception $e) {
          Log::error('Cat API request failed', [
            'message' => $e->getMessage(),
          ]);        
          return [];
      }
    }
}