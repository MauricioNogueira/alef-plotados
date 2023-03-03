<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FiltroMoldeService;

class FiltroMoldeController extends Controller
{
    private $filtroMoldeService;

    public function __construct(FiltroMoldeService $filtroMoldeService)
    {
        $this->filtroMoldeService = $filtroMoldeService;
    }

    public function filtrar(Request $request)
    {
        return $this->filtroMoldeService->filtrar($request->all());
    }
}
