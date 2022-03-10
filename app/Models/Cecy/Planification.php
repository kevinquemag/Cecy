<?php

namespace App\Models\Cecy;

use App\Models\Core\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditing;
use Illuminate\Database\Eloquent\SoftDeletes;

class Planification extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;

    protected $table = 'cecy.planifications';

    protected $fillable = [
        'aproved_at',
        'code',
        'ended_at',
        'needs',
        'observations',
        'started_at'
    ];

    protected $casts = [
        'needs' => 'array',
        'observations' => 'array',
    ];
    // Relationships
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function detailSchoolPeriod()
    {
        return $this->belongsTo(DetailSchoolPeriod::class);
    }
    public function responsibleCourse()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function responsibleOcs()
    {
        return $this->belongsTo(Authority::class);
    }

    public function responsibleCecy()
    {
        return $this->belongsTo(Authority::class);
    }

    public function state()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function vicerector()
    {
        return $this->belongsTo(Authority::class);
    }

    public function detailPlanifications()
    {
        return $this->hasMany(DetailPlanification::class);
    }

    //Mutators
    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = strtoupper($value);
    }

    //Scopes
    public function scopeCode($query, $code)
    {
        if ($code) {
            return $query->orWhere('code', $code);
        }
    }

    public function scopeState($query, $state)
    {
        if ($state) {
            return $query->orWhere('state_id', $state);
        }
    }

    public function scopeCourse($query, $course)
    {
        if ($course) {
            return $query->orWhere('course_id', $course->id);
        }
    }

    public function scopeStartedAt($query, $started_at)
    {
        if ($started_at) {
            return $query->Where('started_at', 'ilike', "%$started_at%");
        }
    }

    public function scopeKpi($query, $planifications, $state)
    {
        return $query->orWhere('state_id', $planifications->$state);
    }

    public function scopeResponsibleCourse($query, $responsibleCourse)
    {
        if ($responsibleCourse) {
            return $query->orWhere('responsible_course_id', $responsibleCourse->id);
        }
    }
    public function scopeResponsibleCecy($query, $responsibleCecy)
    {
        if ($responsibleCecy) {
            return $query->orWhere('responsible_cecy_id', $responsibleCecy->id);
        }
    }
    public function scopeDetailSchoolPeriod($query, $detailSchoolPeriod)
    {
        if ($detailSchoolPeriod) {
            return $query->orWhere('detail_school_period_id', $detailSchoolPeriod->id);
        }
    }


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
}
