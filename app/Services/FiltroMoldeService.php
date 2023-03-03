<?php

namespace App\Services;

use App\Models\Molde;

class FiltroMoldeService
{
    public function filtrar(Array $dados)
    {
        try {
            $search = isset($dados['search']) ? strtolower($dados['search']) : null;
            $id = isset($dados['escala_id']) ? $dados['escala_id'] : null;

            $moldes = Molde::where(\DB::raw('LOWER(nome)'), 'like', "%$search%")->where('escala_id', $id)
                ->select('id', 'nome as text')->get();

            \Log::info($moldes);

            $response = app('response')->success('Sucesso', $moldes);
        } catch (\Throwable $th) {
            \Log::error([
                'mensagem' => $th->getMessage(),
                'linha' => $th->getLine(),
                'arquivo' => $th->getFile()
            ]);
            $response = app('response')->badRequest('Falha ao buscar escalas', $th);
        }
        
        return $response;
    }
}