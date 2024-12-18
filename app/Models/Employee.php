<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    protected $fillable = [
        'nik',
        'name',
        'phone',
        'address',
        'date_of_birth',
        'gender',
        'position',
        'date_of_entry',
        'employee_status',
        'profile_picture',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function kpi()
    {
        return $this->hasMany(Kpi::class);
    }

    public function kpi_totals()
    {
        return $this->hasMany(KpiTotal::class);
    }
}
