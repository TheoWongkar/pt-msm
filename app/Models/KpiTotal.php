<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KpiTotal extends Model
{
    /** @use HasFactory<\Database\Factories\KpiTotalFactory> */
    use HasFactory;

    protected $fillable = [
        'value',
    ];

    public function employees()
    {
        return $this->belongsTo(Employee::class);
    }
}
