<?php

namespace App\Services;

use App\Models\Molde;

class CadastraMoldeService
{
    public function cadastrar(Array $dados)
    {
        try {
            Molde::create([
                'circunferencia_base' => $dados['circunferencia_base'],
                'distancia_base' => $dados['distancia_base'],
                'escala_id' => $dados['escala'],
                'nome' => $dados['nome']
            ]);

            $response = app('response')->success('Molde salvo com sucesso');
        } catch (\Throwable $th) {
            $response = app('response')->badRequest('Falha ao cadastrar o modelo', $th);
        }
        
        return $response;
    }
}