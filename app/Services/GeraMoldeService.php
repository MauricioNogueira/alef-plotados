<?php

namespace App\Services;

use DOMElement;
use DOMDocument;
use App\Models\Molde;

class GeraMoldeService
{
    private $CONST_PROPORCAO = 37.795;

    public function gerar(Array $dados)
    {
        try {
            $modelo = Molde::find($dados['tipo']);

            $distancia_base = explode(',', $modelo->distancia_base);
            $circunferencia_base = explode(',', $modelo->circunferencia_base);
            $comprimentoBase = $this->getComprimento($distancia_base);
            $comprimentoAcumulado = 0;

            $pontos = [];
            
            foreach ($distancia_base as $key => $value) {
                $distanciaAuxiliar = $value * ($dados['altura'] / $comprimentoBase);
                $larguraAuxiliar = (
                    ($circunferencia_base[$key] * $dados['altura'] / $comprimentoBase) / (2 * $dados['quantidade_gomo'])
                ) + ($dados['bainha'] / 2);
                $comprimentoAcumulado += $distanciaAuxiliar;
                
                $pontos[] = [
                    'ponto' => $key+1,
                    'altura' => round($distanciaAuxiliar * 10) / 10,
                    'altura_acumulada' => round($comprimentoAcumulado * 10) / 10,
                    'largura' => round($larguraAuxiliar * 10) / 10
                ];
            }

            $newData = [
                'gomo' => $modelo->toArray(),
                'pontos' => $pontos,
                'nome_arquivo' => $modelo->nome
            ];


            $arquivo = $this->montarMolde($newData);

            $response = app('response')->success('Molde gerado com sucesso', [
                'arquivo' => $arquivo,
                'nome_arquivo' => $modelo->nome
            ]);
        } catch (\Throwable $th) {
            \Log::error([
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine()
            ]);

            $response = app('response')->badRequest('Não foi possível gerar o molde', $th);
        }

        return $response;
    }

    private function montarMolde(Array $dados)
    {
        $mold_file = new DOMDocument();
        $mold_file->formatOutput = true;
        $mold_file->load(app()->basePath('public/modelo.svg'));
        
        $svg = $mold_file->getElementsByTagName('svg');
        $altura = $dados['pontos'][count($dados['pontos']) -1]['altura_acumulada'];
        $tagAltura = $mold_file->createAttribute('heigth');
        $tagAltura->value = $altura;

        $svg->item(0)->appendChild($tagAltura);

        $molde_direito = $mold_file->createElement('g');
        $molde_esquerdo = $mold_file->createElement('g');

        foreach ($dados['pontos'] as $key => $ponto) {
            $nao_remove_linha_central = false;

            if ($key == 0 || ($key+1 == count($dados['pontos']))) {
                $nao_remove_linha_central = true;
            }
            $linha1 = $this->gerarLinha($ponto, $mold_file, $altura, $nao_remove_linha_central);
            $linha2 = $this->gerarLinha($ponto, $mold_file, $altura, $nao_remove_linha_central, -1);

            $molde_direito->appendChild($linha1);
            $molde_esquerdo->appendChild($linha2);
        }

        $tagPai = $mold_file->createElement('g');
        $this->ligarPontos($dados, $molde_direito, $mold_file, 1, $altura);
        $this->ligarPontos($dados, $molde_direito, $mold_file, -1, $altura);
        
        $tagPai->appendChild($molde_direito);
        $tagPai->appendChild($molde_esquerdo);

        $svg->item(0)->appendChild($tagPai);

        return $mold_file->saveXml();
    }

    private function gerarLinha(Array $ponto, DOMDocument $document, float $altura_total, $naoRemove, $constante = 1) : DOMElement
    {
        $linha = $document->createElement('line');

        $x1 = $document->createAttribute('x1');
        $x2 = $document->createAttribute('x2');
        $y1 = $document->createAttribute('y1');
        $y2 = $document->createAttribute('y2');

        $stroke = $document->createAttribute('stroke');
        $stroke->value = "red";
        $valor_x2 = $this->CONST_PROPORCAO*($constante*$ponto['largura']);

        $x1->value = $this->CONST_PROPORCAO*($constante*$ponto['largura']);

        if ($naoRemove) {
            $x2->value = 0;
        } else {
            $x2->value = ($valor_x2-1);
        }

        $y1->value = $this->CONST_PROPORCAO*($altura_total - $ponto['altura_acumulada']);
        $y2->value = $this->CONST_PROPORCAO*($altura_total - $ponto['altura_acumulada']);
        
        $linha->appendChild($x1);
        $linha->appendChild($x2);
        $linha->appendChild($y1);
        $linha->appendChild($y2);
        $linha->appendChild($stroke);

        return $linha;
    }

    private function ligarPontos(Array $dados, DOMElement $elemento, DOMDocument $document, $constante = 1, float $altura_total)
    {
        $total = count($dados['pontos']);

        foreach ($dados['pontos'] as $key => $ponto) {
            $linha = $document->createElement('line');

            $x1 = $document->createAttribute('x1');
            $x2 = $document->createAttribute('x2');
            $y1 = $document->createAttribute('y1');
            $y2 = $document->createAttribute('y2');
            
            $stroke = $document->createAttribute('stroke');
            $stroke->value = "red";
            $valor_x2 = $this->CONST_PROPORCAO*($constante*$ponto['largura']);

            $x1->value = $this->CONST_PROPORCAO*($constante * $ponto['largura']);
            if (!(($key + 1) == $total)) {
                $x2->value = $this->CONST_PROPORCAO*($constante * $dados['pontos'][$key+1]['largura']);
                $y2->value = $this->CONST_PROPORCAO*($altura_total - $dados['pontos'][$key+1]['altura_acumulada']);
            }
            $y1->value = $this->CONST_PROPORCAO*($altura_total - $ponto['altura_acumulada']);


            $linha->appendChild($x1);
            $linha->appendChild($x2);
            $linha->appendChild($y1);
            $linha->appendChild($y2);
            $linha->appendChild($stroke);

            $elemento->appendChild($linha);
        }

        
    }

    private function getComprimento(Array $distancia_base)
    {
        $acumulado = 0;

        foreach ($distancia_base as $value) {
            $acumulado += $value;
        }

        return $acumulado;
    }

    private function getLarguraMaxima(Array $circunferencia_base)
    {
        $larguraMaxima = 0;

        foreach ($circunferencia_base as $value) {
            if ($value > $larguraMaxima) {
                $larguraMaxima = $value;
            }
        }

        return $larguraMaxima;
    }
}