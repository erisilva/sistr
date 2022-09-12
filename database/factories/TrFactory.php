<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TrFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 4), 
            'situacao_id' => $this->faker->numberBetween(1, 15), 
            'numero' => 1, 
            'ano' => 1, 
            'origem_id' => $this->faker->numberBetween(1, 30), 
            'descricao' => $this->faker->text($maxNbChars = 50), 
            'tipo_id' => $this->faker->numberBetween(1, 4), 
            'entregueSupAdm' => $this->faker->date($format = 'Y-m-d', $max = 'now'), 
            'entregueComprasContrato' => $this->faker->date($format = 'Y-m-d', $max = 'now'), 
            'responsavel_id' => $this->faker->numberBetween(1, 11), 
            'inicioCotacao' => $this->faker->date($format = 'Y-m-d', $max = 'now'), 
            'terminoCotacao' => $this->faker->date($format = 'Y-m-d', $max = 'now'), 
            'requisicaoCompras' => $this->faker->text($maxNbChars = 6), 
            'valor' => '100', 
            'envioSuplanPro' => $this->faker->date($format = 'Y-m-d', $max = 'now'), 
            'retornoSuplanPro' => $this->faker->date($format = 'Y-m-d', $max = 'now'), 
            'assinaturasGabinete' => $this->faker->date($format = 'Y-m-d', $max = 'now'), 
            'protocoloSisprot' => $this->faker->text($maxNbChars = 8), 
            'envioCCOAF' => $this->faker->date($format = 'Y-m-d', $max = 'now'), 
            'retornoCCOAF' => $this->faker->date($format = 'Y-m-d', $max = 'now'), 
            'deliberacao_id' => $this->faker->numberBetween(1, 2), 
            'numeroPAC' => $this->faker->text($maxNbChars = 6), 
            'modalidade_id' => $this->faker->numberBetween(1, 6), 
            'numeroModalidade' => $this->faker->text($maxNbChars = 6), 
            'autuacao' => $this->faker->date($format = 'Y-m-d', $max = 'now'), 
            'inicioMinutas' => $this->faker->date($format = 'Y-m-d', $max = 'now'), 
            'teminoMinutas' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'pregoeiro_id' => $this->faker->numberBetween(1, 3), 
            'tipo_id' => $this->faker->numberBetween(1, 2), 
            'inicioMinutasEdital' => $this->faker->date($format = 'Y-m-d', $max = 'now'), 
            'terminoMinutasEdital' => $this->faker->date($format = 'Y-m-d', $max = 'now'), 
            'envioPgm' => $this->faker->date($format = 'Y-m-d', $max = 'now'), 
            'retornoPgm' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'inicioSaneamentoPendencias' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'terminoSaneamentoPendencias' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'numeroEdital' => $this->faker->text($maxNbChars = 8), 
            'dataPregao' => $this->faker->date($format = 'Y-m-d', $max = 'now'), 
            'impugnacao' => $this->faker->date($format = 'Y-m-d', $max = 'now'), 
            'inicioAnaliseTecnica' => $this->faker->date($format = 'Y-m-d', $max = 'now'), 
            'terminoAnaliseTecnica' => $this->faker->date($format = 'Y-m-d', $max = 'now'), 
            'dataHomologacao' => $this->faker->date($format = 'Y-m-d', $max = 'now'), 
            'dataRatificacao' => $this->faker->date($format = 'Y-m-d', $max = 'now'), 
            'formalizacaoContratoArp' => $this->faker->date($format = 'Y-m-d', $max = 'now'), 
            'dataContratoArp' => $this->faker->date($format = 'Y-m-d', $max = 'now'), 
            'publicacao' => $this->faker->text($maxNbChars = 120),
            'observacao' => $this->faker->text($maxNbChars = 100)
        ];
    }
}
