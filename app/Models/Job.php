<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'title',
        'company_name',
        'location',
        'work_system',
        'job_type',
        'salary_range',
        'category',
        'status',
    ];
}
