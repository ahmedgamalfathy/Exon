<?php

use App\Models\User;
use App\Models\Grade;
use App\Models\Stage;
use App\Models\Material;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    //title , des, teacher_id, user_id, stage_id, grade_id, material_id
    //photo, pdf ,start_time , end_time , test_type, price
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('title');//العنوان
            $table->text('des')->nullable();//الوصف
            // $table->unsignedBigInteger('teacher_id');
            $table->foreignIdFor(User::class,'teacher_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Stage::class)->constrained()->cascadeOnUpdate();
            $table->foreignIdFor(Grade::class)->constrained()->cascadeOnUpdate();
            $table->foreignIdFor(Material::class)->constrained()->cascadeOnUpdate();
            $table->string('photo');//غلاف الصورة
            $table->string('pdf')->nullable();//ملف pdf
            $table->timestamp('start_time');//بداية الامتحان
            $table->timestamp('end_time');//نهاية الامتحان
            $table->enum('test_Type',['اون لاين','ملف pdf']);
            $table->decimal('price',5,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
