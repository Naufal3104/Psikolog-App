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
            $table->string('id', 144)->primary();
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

        // Tabel tanya_jawab
        Schema::create('tanya_jawab', function (Blueprint $table) {
            $table->string('id', 144)->primary();
            $table->bigInteger('user_id')->unsigned();
            $table->string('judul_pertanyaan');
            $table->text('pertanyaan');
            $table->enum('status', ['Belum Dijawab', 'Sudah Dijawab'])->default('Belum Dijawab');
            $table->bigInteger('vote_count')->default(0);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('balasan_tanya_jawab', function (Blueprint $table) {
            $table->id();
            $table->string('tanya_jawab_id');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('isi_balasan');
            $table->foreign('tanya_jawab_id')->references('id')->on('tanya_jawab')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
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

        Schema::create('kategori_deteksi', function (Blueprint $table) {
            $table->string('id', 144)->primary();
            $table->string('nama_kategori');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('interpretasi_skor', function (Blueprint $table) {
            $table->id();
            $table->string('kategori_deteksi_id', 144);
            $table->foreign('kategori_deteksi_id')->references('id')->on('kategori_deteksi')->onDelete('cascade');
            $table->integer('skor_minimal');
            $table->integer('skor_maksimal');
            $table->string('teks_interpretasi');
            $table->text('deskripsi_hasil')->nullable();
            $table->timestamps();
        });

        Schema::create('pertanyaan', function (Blueprint $table) {
            $table->id();
            $table->string('kategori_deteksi_id', 144);
            $table->foreign('kategori_deteksi_id')->references('id')->on('kategori_deteksi')->onDelete('cascade');
            $table->text('teks_pertanyaan');
            $table->enum('tipe_jawaban', ['ya_tidak', 'rating_1_5']);
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });

        Schema::create('pilihan_jawaban', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pertanyaan_id')->constrained('pertanyaan')->onDelete('cascade');
            $table->string('teks_jawaban');
            $table->integer('bobot_nilai');
            $table->timestamps();
        });

        Schema::create('hasil_deteksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('interpretasi_id')->constrained('interpretasi_skor')->onDelete('cascade');
            $table->string('kategori_deteksi_id', 144);
            $table->foreign('kategori_deteksi_id')->references('id')->on('kategori_deteksi')->onDelete('cascade');
            $table->decimal('total_skor', 8, 2);
            $table->timestamps();
        });

        Schema::create('jawaban_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hasil_deteksi_id')->constrained('hasil_deteksi')->onDelete('cascade');
            $table->foreignId('pertanyaan_id')->constrained('pertanyaan');
            $table->foreignId('pilihan_jawaban_id')->constrained('pilihan_jawaban');
            $table->timestamps();
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
        Schema::dropIfExists('artikel');
        Schema::dropIfExists('konsultasi');
        Schema::dropIfExists('interpretasi_skor');
        Schema::dropIfExists('jawaban_user');
        Schema::dropIfExists('hasil_deteksi');
        Schema::dropIfExists('pilihan_jawaban');
        Schema::dropIfExists('pertanyaan');
        Schema::dropIfExists('kategori_deteksi');
    }
};
