<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('quote_requests', function (Blueprint $table) {
            $table->id();
            $table->string('message_id')->unique(); // Message-ID de l'email (anti-doublon)
            $table->string('from_email');
            $table->string('from_name')->nullable();
            $table->string('subject')->nullable();
            $table->longText('body')->nullable();
            $table->timestamp('received_at')->nullable();

            // nouveau -> detecte -> analyse -> pret -> envoye | rejete | erreur
            $table->string('status')->default('nouveau');
            $table->unsignedTinyInteger('detection_score')->default(0);
            $table->string('extraction_method')->nullable(); // ia | regles | manuel

            $table->text('client_message')->nullable(); // message d'accompagnement du devis
            $table->string('quote_number')->nullable(); // ex: DEV-2026-0001
            $table->string('client_pdf_path')->nullable(); // devis client (prix +35%)
            $table->string('supplier_doc_path')->nullable(); // doc interne fournisseurs

            $table->timestamp('sent_at')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamps();

            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('quote_requests');
    }
};
