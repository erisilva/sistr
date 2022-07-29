<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id'); // operador que cadastrou a tr

            $table->unsignedBigInteger('situacao_id'); // status

            $table->unsignedInteger('numero'); // TR nº
            $table->unsignedInteger('ano'); // Ano

            $table->unsignedBigInteger('origem_id'); // Origem
            
            $table->text('descricao'); // Descrição básica do Objeto

            $table->unsignedBigInteger('tipo_id'); // Tipo

            $table->date('entregueSupAdm')->nullable(); // Entregue SUP.ADM.
            $table->date('entregueComprasContrato')->nullable(); // Entregue COMPRAS / CONTRATOS

            $table->unsignedBigInteger('responsavel_id'); // Responsável cotação

            $table->date('inicioCotacao')->nullable(); // Início cotação
            $table->date('terminoCotacao')->nullable(); // Término cotação

            $table->string('requisicaoCompras', 80)->nullable(); // Requisição Compras

            $table->string('valor', 80)->nullable(); // Valor R$

            $table->date('envioSuplanPro')->nullable(); // Envio SUPLAN_PRO
            $table->date('retornoSuplanPro')->nullable(); // Retorno SUPLAN_PRO

            $table->date('assinaturasGabinete')->nullable(); // Assinaturas GABINETE

            $table->string('protocoloSisprot', 80)->nullable(); // Protocolo SISPROT

            $table->date('envioCCOAF')->nullable(); // Envio CCOAF
            $table->date('retornoCCOAF')->nullable(); // Retorno CCOAF

            $table->unsignedBigInteger('deliberacao_id'); // Deliberação CCOAF

            $table->string('numeroPAC', 80)->nullable(); // PAC Nº

            $table->unsignedBigInteger('modalidade_id'); // MODALIDADE Pregão/Dispensa/Inex/Adesão/Rateio
            
            $table->string('numeroModalidade', 80)->nullable(); // Nº modalidade

            $table->date('autuacao')->nullable(); // Autuação / Ordenador Despesa

            $table->date('inicioMinutas')->nullable(); // Início MINUTAS (contrato/ARP)
            $table->date('teminoMinutas')->nullable(); // Término MINUTAS (contrato/ARP)

            $table->date('inicioMinutasEdital')->nullable(); // Início minuta EDITAL
            $table->date('terminoMinutasEdital')->nullable(); // Término minuta EDITAL

            $table->date('envioPgm')->nullable(); // Envio PGM
            $table->date('retornoPgm')->nullable(); // Retorno PGM
            $table->date('pendenciasPgm')->nullable(); // Pendêcnias PGM

            $table->string('numeroEdital', 80)->nullable(); // Nº EDITAL
            $table->date('dataPregao')->nullable(); // Data PREGÃO

            $table->text('observacaoLicitacao')->nullable(); // Observação da Licitação (IMPULGUINAÇÃO,RECURSO E ANÁLISE TÉCNICA, ETC.)

            $table->date('dataHomologacao')->nullable(); // Data Homologação
            $table->date('dataRatificacao')->nullable(); // Data Ratificação
            
            $table->date('formalizacaoContratoArp')->nullable(); // Formalização Contrato/ARP
            $table->date('dataContratoArp')->nullable(); // Data Contrato/ARP
            
            $table->date('solicitacaoEmpenho')->nullable(); // Solicitação Empenho

            $table->text('observacao')->nullable(); // Observações

            $table->timestamps();

            //fk
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('situacao_id')->references('id')->on('situacaos')->onDelete('cascade');
            $table->foreign('origem_id')->references('id')->on('origems')->onDelete('cascade');
            $table->foreign('tipo_id')->references('id')->on('tipos')->onDelete('cascade');
            $table->foreign('responsavel_id')->references('id')->on('responsavels')->onDelete('cascade');
            $table->foreign('deliberacao_id')->references('id')->on('deliberacaos')->onDelete('cascade');
            $table->foreign('modalidade_id')->references('id')->on('modalidades')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trs', function (Blueprint $table) {
            $table->dropForeign('trs_user_id_foreign');
            $table->dropForeign('trs_situacao_id_foreign');
            $table->dropForeign('trs_origem_id_foreign');
            $table->dropForeign('trs_tipo_id_foreign');
            $table->dropForeign('trs_responsavel_id_foreign');
            $table->dropForeign('trs_deliberacao_id_foreign');
            $table->dropForeign('trs_modalidade_id_foreign');
        });

        Schema::dropIfExists('trs');
    }
}
