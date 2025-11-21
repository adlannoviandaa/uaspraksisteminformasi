<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
public function up() {
Schema::create('pesans', function (Blueprint $table) {
$table->id();
$table->string('nama_pengirim');
$table->string('email')->nullable();
$table->text('isi');
$table->boolean('dibaca')->default(false);
$table->timestamps();
});
}


public function down() {
Schema::dropIfExists('pesans');
}
};
