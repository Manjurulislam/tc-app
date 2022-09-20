<?php

namespace Database\Seeders;

use App\Models\Exam;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['title' => 'JSC', 'slug' => 'jsc', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'SSC', 'slug' => 'ssc', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'HSC', 'slug' => 'hsc', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        ];
        Schema::enableForeignKeyConstraints();
        DB::table('exams')->truncate();
        Exam::insert($data);
        Schema::disableForeignKeyConstraints();

    }


}
