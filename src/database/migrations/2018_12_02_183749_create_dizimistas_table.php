<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDizimistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dizimistas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',300);
            $table->enum('sexo',['Masculino', 'Feminino', 'Não Informado'])->default('Não Informado');
            $table->enum('estado_civil', ['Solteiro(a)', 'Casado(a)', 'Divorciado(a)', 'Viúvo(a)', 'Não Informado'])->default('Não Informado');
            $table->date('data_nascimento')->nullable();
            $table->string('nome_conjuge')->nullable();
            $table->date('data_nascimento_conjuge')->nullable();
            $table->string('numero_whatsapp',25)->nullable();
            $table->string('numero_fixo',24)->nullable();
            $table->string('email',300)->nullable();
            $table->string('naturalidade',1000)->nullable();

            $table->string('endereco',3000)->nullable();
            $table->string('bairro',300)->nullable();
            $table->string('cidade',300)->nullable();
            $table->string('cep',20)->nullable();
            $table->boolean('participa_pastoral')->nullable();
            $table->string('pedido_oracao',3000)->nullable();
            $table->boolean('atualizado')->default(false);
            $table->dateTime('ultima_atualizacao')->nullable();
            $table->unsignedInteger('ultimo_atualizador_id')->nullable();
            $table->string('comunidade',300)->nullable();
            $table->string('pastoral_desejada',300)->nullable();

            $table->foreign('ultimo_atualizador_id')->references('id')->on('users');

            $table->unique('email');
            $table->unique('numero_whatsapp');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dizimistas');
    }
}
