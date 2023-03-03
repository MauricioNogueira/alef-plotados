<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FiltroEscalaService;

class FiltroEscalaController extends Controller
{
    private $filtroEscalaService;

    public function __construct(FiltroEscalaService $filtroEscalaService)
    {
        $this->filtroEscalaService = $filtroEscalaService;
    }

    public function filtrar(Request $request)
    {
        return $this->filtroEscalaService->filterEscala($request->all());
    }
}
