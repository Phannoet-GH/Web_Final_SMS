<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $primaryKey = 'student_id';

    protected $fillable = [
        'student_name',
        'email',
        'gender',
        'enrollment_date',
        'description',
        'department_id',
    ];

    protected $casts = [
        'enrollment_date' => 'date',
    ];

    /**
     * Get the department that this student belongs to.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id', 'department_id');
    }

    /**
     * Calculate exact floating years enrolled to match exam design.
     */
    public function getYearsEnrolledDecimalAttribute(): float
    {
        if (! $this->enrollment_date) {
            return 0.0;
        }

        return round(abs($this->enrollment_date->floatDiffInYears(now())), 13);
    }
}
