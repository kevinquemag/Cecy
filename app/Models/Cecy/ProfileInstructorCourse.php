<?php

namespace App\Models\Cecy;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditing;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileInstructorCourse extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;

    protected $table = 'cecy.profile_instructor_courses';

    protected $fillable = [
        'required_experiences',
        'required_knowledges',
        'required_skills',
    ];

    protected $casts = [
        'required_experiences' => 'array',
        'required_knowledges' => 'array',
        'required_skills' => 'array'
    ];
    // Relationships
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function instructors()
    {
        return $this->belongsToManyy(Instructor::class, 'cecy.authorized_instructors', 'instructor_id', 'profile_instructor_course_id');
    }
    // Mutators

    //Mis campos son de tipo JSON

    // Scopes

    // Mis campos son de  tipo JSON 


    public function scopeCustomOrderBy($query, $sorts)
    {
        if (!empty($sorts[0])) {
            foreach ($sorts as $sort) {
                $field = explode('-', $sort);
                if (empty($field[0]) && in_array($field[1], $this->fillable)) {
                    $query = $query->orderByDesc($field[1]);
                } else if (in_array($field[0], $this->fillable)) {
                    $query = $query->orderBy($field[0]);
                }
            }
            return $query;
        }
    }

    public function scopeCourse($query, $profile)
    {
        if ($profile) {
            return $query->Where('course_id', $profile->course);
        }
    }
}
