<?php

namespace Database\Seeders;

use App\Models\ResumePdf;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResumeBuilderSubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ResumePdf::create([
            [
                'pdf_id' => '0',
                'name' => 'resume',
            ],
            [
                'pdf_id' => '1',
                'name' => 'resume_1',
            ],
            [
                'pdf_id' => '2',
                'name' => 'resume_2',
            ],

        ]);
    }
}
