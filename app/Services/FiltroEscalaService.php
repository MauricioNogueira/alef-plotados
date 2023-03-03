<?php

namespace App\Services;

use App\Models\Escala;

class FiltroEscalaService
{
    public function filterEscala(Array $dados)
    {
        try {
            $search = isset($dados['search']) ? strtolower($dados['search']) : null;
            $id = isset($dados['escala_id']) ? $dados['escala_id'] : null;

            $escalas = Escala::where(\DB::raw('LOWER(tipo)'), 'like', "%$search%")
                ->select('id', 'tipo as text')->get();

            if ($id) {
                $escalas = $escalas->where('id', $id)->first();
            }
            \Log::info($escalas);

            $response = app('response')->success('Sucesso', $escalas);
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