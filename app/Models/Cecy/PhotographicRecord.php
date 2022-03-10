<?php

namespace App\Models\Cecy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as Auditing;
use OwenIt\Auditing\Contracts\Auditable;

class PhotographicRecord extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;

    protected $table = 'cecy.photographic_records';

    protected $fillable = [
        'description',
        'number_week',
        'url_image',
        'week_at'
    ];

    // Relationships
    public function detailPlanification()
    {
        return $this->belongsTo(DetailPlanification::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    // Mutators
    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = strtoupper($value);
    }


    // Scopes

    public function scopeDescription($query, $description)
    {
        if ($description) {
            return $query->orWhere('description', $description->id);
        }
    }

    public function scopeUrlImage($query, $urlImage)
    {
        if ($urlImage) {
            return $query->orWhere('url_image', $urlImage->id);
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
