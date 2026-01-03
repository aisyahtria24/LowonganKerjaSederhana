<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Job;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Job::create([
            'title' => 'Backend Developer',
            'company_name' => 'TechCorp',
            'location' => 'Jakarta',
            'work_system' => 'remote',
            'job_type' => 'full-time',
            'salary_range' => 'Rp 8.000.000 - Rp 15.000.000',
            'category' => 'Technology',
            'status' => 'active',
        ]);

        Job::create([
            'title' => 'Frontend Developer',
            'company_name' => 'WebSolutions',
            'location' => 'Bandung',
            'work_system' => 'on-site',
            'job_type' => 'full-time',
            'salary_range' => 'Rp 7.000.000 - Rp 12.000.000',
            'category' => 'Technology',
            'status' => 'active',
        ]);

        Job::create([
            'title' => 'UI/UX Designer',
            'company_name' => 'DesignStudio',
            'location' => 'Surabaya',
            'work_system' => 'remote',
            'job_type' => 'part-time',
            'salary_range' => 'Rp 5.000.000 - Rp 10.000.000',
            'category' => 'Design',
            'status' => 'active',
        ]);

        Job::create([
            'title' => 'Project Manager',
            'company_name' => 'ProjectMasters',
            'location' => 'Yogyakarta',
            'work_system' => 'on-site',
            'job_type' => 'full-time',
            'salary_range' => 'Rp 10.000.000 - Rp 18.000.000',
            'category' => 'Management',
            'status' => 'active',
        ]);

        Job::create([
            'title' => 'Data Analyst',
            'company_name' => 'DataInsights',
            'location' => 'Medan',
            'work_system' => 'remote',
            'job_type' => 'internship',
            'salary_range' => 'Rp 3.000.000 - Rp 5.000.000',
            'category' => 'Data',
            'status' => 'active',
        ]);
    }
}
