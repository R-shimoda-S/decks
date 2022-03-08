<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Integer('color_id');
            $table->string('pack_id',4)->comment('パックNo');
            $table->string('name',50)->comment('カード名');
            $table->tinyInteger('cost')->comment('コスト');
            $table->string('text',500)->nullable()->comment('効果テキスト');
            $table->smallInteger('power')->comment('パワー');
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_lists');
    }
}
