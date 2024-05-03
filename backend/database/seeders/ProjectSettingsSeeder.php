<?php

namespace Database\Seeders;

use App\Models\ProjectSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projectSettings = [
            [
                ProjectSetting::COL_ID => 1000,
                ProjectSetting::COL_SETTINGS => json_encode([
                    'values' => [10,20,30,40,50,70],
                    'coupon_types' => ['classic', 'modern'],
                ])
            ]
        ];

        DB::beginTransaction();

        try {
            ProjectSetting::insert($projectSettings);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            abort(500, $e->getMessage());
        }
    }
}
