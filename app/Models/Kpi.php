<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kpi extends Model
{
    /** @use HasFactory<\Database\Factories\KpiFactory> */
    use HasFactory;

    protected $fillable = [
        'description',
        'weight',
        'rating',
        'value',
    ];

    public function employees()
    {
        return $this->belongsTo(Employee::class);
    }
}
