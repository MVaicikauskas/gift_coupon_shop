<?php

namespace Database\Seeders;

use App\Models\Project;
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
                    ProjectSetting::SETTING_KEY_VALUES => [10,20,30,40,50,70],
                    ProjectSetting::SETTING_KEY_COUPON_TYPES => [1,2],
                    ProjectSetting::SETTING_KEY_EXPIRATION_TERM => 180,
                    ProjectSetting::SETTING_KEY_MONTONIO_ACCESS_KEY => encrypt('df2b7b5e-441d-4629-b286-d43f47ecde1c'),
                    ProjectSetting::SETTING_KEY_MONTONIO_SECRET_KEY => encrypt('QqGHuv8UBSQvDCivLjuBLQHt+AOMMJY4jGAq1XQhb8sO'),
                    ProjectSetting::SETTING_KEY_PAYMENT_METHOD => 'montonio',
                    ProjectSetting::SETTING_KEY_RETURN_URL => 'http://localhost:3000/step/4',
                ]),
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
