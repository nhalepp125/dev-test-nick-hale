<?php

namespace App\Repositories;

interface PetRepositoryInterface
{
    /**
     * Get all breeds of the pet type.
     *
     * @return array
     */
    public function getAll(): array;
}
