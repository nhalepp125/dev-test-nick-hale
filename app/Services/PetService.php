<?php

namespace App\Services;

use App\Enums\PetTypeEnum;
use App\Repositories\CatRepository;
use App\Repositories\DogRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class PetService
{
    public function __construct(
        protected CatRepository $catRepository,
        protected DogRepository $dogRepository,
    ) {

    }

    /**
     * Get all pet data.
     *
     * @return Collection
     */
    public function getAllPets(): Collection
    {
        return Cache::remember('pet_data', now()->addHours(1),  function () {
            $cats = $this->catRepository->getAll();
            $dogs = $this->dogRepository->getAll();

            $allPets = array_merge(
                $this->processCats($cats),
                $this->processDogs($dogs)
            );
            
            return collect(array_map(function ($pet, $index) {
                $pet['id'] = $index;
                return $pet;
            }, $allPets, array_keys($allPets)));
        });
    }

    /**
     * Process the cat data.
     *
     * @param array $cats
     * @return array
     */
    private function processCats(array $cats): array
    {
        return array_map(function ($cat) {
            return [
                'breed_id'    => $cat['id'] ?? null,
                'pet_type_id' => PetTypeEnum::CAT->value,
                'pet_type'    => 'Cat',
                'name'        => $cat['name'] ?? null,
                'origin'      => $cat['origin'] ?? null,
                'temperament' => $cat['temperament'] ?? null,
                'life_span'   => $cat['life_span'] ?? null,
                'image'       => $cat['image']['url'] ?? null,
            ];
        }, $cats);
    }

    /**
     * Process the dog data.
     *
     * @param array $dogs
     * @return array
     */
    private function processDogs(array $dogs): array
    {
        return array_map(function ($dog) {
            return [
                'breed_id'    => $dog['id'] ?? null,
                'pet_type_id' => PetTypeEnum::DOG->value,
                'pet_type'    => 'Dog',
                'name'        => $dog['name'] ?? null,
                'origin'      => $dog['origin'] ?? null,
                'temperament' => $dog['temperament'] ?? null,
                'life_span'   => $dog['life_span'] ?? null,
                'image'       => $dog['image']['url'] ?? null,
            ];
        }, $dogs);
    }

    /**
     * Get pet data by pet ID.
     *
     * @param int $id
     * @return array
     */
    public function getPetByPetId(int $id): array
    {
        $pets = $this->getAllPets();
        return $pets->firstWhere('id', $id);
    }
}