<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GeraMoldeRequest;
use App\Services\GeraMoldeService;

class GeraMoldeController extends Controller
{
    private $geraMoldeService;

    public function __construct(GeraMoldeService $geraMoldeService)
    {
        $this->geraMoldeService = $geraMoldeService;
    }

    public function gerar(GeraMoldeRequest $request)
    {
        return $this->geraMoldeService->gerar($request->all());
    }
}
