<?php

namespace App\Http\Controllers;

use App\Services\PetService;
use Illuminate\View\View;
use Illuminate\Http\Request;

class PetController
{
    public function __construct(
        protected PetService $petService,
    ) {

    }

    /**
     * Show the pet search page.
     *
     * @return View
     */
    public function showPetSearch(): View
    {
        $pets = $this->petService->getAllPets();
        return view('dashboard', compact('pets'));
    }

    /**
     * Show the pet overview page.
     *
     * @param Request $request
     * @return View
     */
    public function showPetOverview(Request $request): View
    {
        $petId = $request->route('id');
        $pet = $this->petService->getPetByPetId($petId);

        return view('pet_overview', compact('pet'));
    }
}
