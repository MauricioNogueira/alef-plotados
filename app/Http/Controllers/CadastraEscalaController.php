<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CadastraEscalaService;
use App\Http\Requests\CadastraEscalaRequest;

class CadastraEscalaController extends Controller
{
    private $cadastraEscalaService;

    public function __construct(CadastraEscalaService $cadastraEscalaService)
    {
        $this->cadastraEscalaService = $cadastraEscalaService;
    }

    public function cadastrar(CadastraEscalaRequest $request)
    {
        return $this->cadastraEscalaService->cadastrar($request->all());
    }
}
