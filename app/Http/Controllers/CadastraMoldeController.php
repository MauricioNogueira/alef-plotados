<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CadastraMoldeService;
use App\Http\Requests\CadastraMoldeRequest;

class CadastraMoldeController extends Controller
{
    private $cadastraMoldeService;

    public function __construct(CadastraMoldeService $cadastraMoldeService)
    {
        $this->cadastraMoldeService = $cadastraMoldeService;
    }

    public function cadastrar(CadastraMoldeRequest $request)
    {
        return $this->cadastraMoldeService->cadastrar($request->all());
    }
}
