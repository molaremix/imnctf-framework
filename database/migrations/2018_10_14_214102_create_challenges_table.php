<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('name');
            $table->text('description');
            $table->string('flag')->unique();
            $table->integer('point');
            $table->enum('point_mode', ['static', 'dynamic'])->default('static');
            $table->integer('decay')->default(0)->comment('Jumlah Solve sebelum menyentuh nilai Minimum');
            $table->integer('minimum')->default(0);
            $table->integer('submission_limit')->default(0);
            $table->boolean('visible')->default(true);
            $table->timestamps();
        });

        \App\Models\Challenge::insert([
            [
                'name' => 'EZ Web',
                'category_id' => '2',
                'description' => 'We Don\'t Have Any : just Check this out http://vulnweb.com',
                'flag' => 'ImnCTF{hiyaaa_hiyaaa_hiyaaaa_____hiyaaa}',
                'point' => 1337,
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('challenges');
    }
}
