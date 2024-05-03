<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                Company::COL_ID => 1000,
                Company::COL_NAME => 'The best company',
                Company::COL_EMAIL => 'best.company@email.com',
                Company::COL_COMPANY_CODE => '123456789',
                Company::COL_VAT => 'LT321654987',
            ]
        ];

        DB::beginTransaction();

        try {
            Company::insert($companies);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            abort(500, $e->getMessage());
        }
    }
}
