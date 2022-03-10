<?php

namespace App\Models\Cecy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as Auditing;
use App\Models\Authentication\User;
use App\Models\Core\Institution;
use App\Models\Core\State;
use OwenIt\Auditing\Contracts\Auditable;

class Authority extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;

    protected $table = 'cecy.authorities';

    protected $fillable = [
        'position_started_at',
        'position_ended_at',
        'electronic_signature'
    ];

    // Relationships
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function position()
    {
        return $this->belongsTo(State::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function planifications()
    {
        return $this->hasMany(Planification::class, 'responsible_cecy_id');
    }

    // Mutators


    // Scopes
    public function scopePositionStartedAt($query, $positionStartedAt)
    {
        if ($positionStartedAt) {
            return $query->where('position_started_at', $positionStartedAt);
        }
    }

    public function scopePositionEndedAt($query, $positionEndedAt)
    {
        if ($positionEndedAt) {
            return $query->orWhere('position_ended_at', $positionEndedAt);
        }
    }
    public function scopeFirm($query, $electronicSignature)
    {
        if ($electronicSignature) {
            return $query->orWhere('electronic_signature', $electronicSignature);
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
