<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabel konsultasi
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('gambar')->nullable();
            $table->bigInteger('views')->default(0);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Tabel artikel
        Schema::create('artikel', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('isi');
            $table->bigInteger('penulis_id')->unsigned();
            $table->string('gambar')->nullable();
            $table->string('keterangan_gambar')->nullable();
            $table->bigInteger('views')->default(0);
            $table->timestamps();
            $table->foreign('penulis_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Tabel deteksi_dini
        Schema::create('deteksi_dini', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('form_id')->unsigned();
            $table->integer('skor');
            $table->string('hasil');
            $table->timestamp('tanggal_deteksi');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Tabel tanya_jawab
        Schema::create('tanya_jawab', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->text('pertanyaan');
            $table->text('jawaban')->nullable();
            $table->bigInteger('psikiater_id')->unsigned()->nullable();
            $table->enum('status', ['belum dijawab', 'sudah dijawab'])->default('belum dijawab');
            $table->string('kategori')->nullable();
            $table->bigInteger('views')->default(0);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('psikiater_id')->references('id')->on('users')->onDelete('set null');
        });

        // Tabel video
        Schema::create('video', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('url');
            $table->bigInteger('penulis_id')->unsigned();
            $table->string('kategori');
            $table->bigInteger('views')->default(0);
            $table->timestamps();
            $table->foreign('penulis_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Tabel infografis
        Schema::create('infografis', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('gambar_url');
            $table->string('kategori');
            $table->bigInteger('views')->default(0);
            $table->bigInteger('penulis_id')->unsigned();
            $table->timestamps();
            $table->foreign('penulis_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infografis');
        Schema::dropIfExists('video');
        Schema::dropIfExists('tanya_jawab');
        Schema::dropIfExists('deteksi_dini');
        Schema::dropIfExists('artikel');
        Schema::dropIfExists('konsultasi');
    }
};
