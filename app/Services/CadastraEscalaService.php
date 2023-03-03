<?php

namespace App\Services;

use App\Models\Escala;

class CadastraEscalaService
{
    public function cadastrar(Array $dados)
    {
        try {
            $escala = Escala::create([
                'tipo' => $dados['tipo']
            ]);

            $response = app('response')->success($escala->tipo.' criado com sucesso');
        } catch (\Throwable $th) {
            \Log::error([
                'mensagem' => $th->getMessage(),
                'linha' => $th->getLine(),
                'arquivo' => $th->getFile()
            ]);
            $response = app('response')->badRequest('Falha ao cadastrar a escala', $th);
        }
        
        return $response;
    }
}