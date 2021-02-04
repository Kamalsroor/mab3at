<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailTemplate extends Model
{
    protected $fillable = [
                            'name',
                            'slug',
                            'category',
                            'subject',
                            'body'
                        ];
    protected $primaryKey = 'id';
    protected $table = 'email_templates';
    use SoftDeletes;

    public function setBodyAttribute($value)
    {
        $this->attributes['body'] = scriptStripper($value);
    }

    public function scopeFilterBySlug($q, $slug)
    {
        if (! $slug) {
            return $q;
        }

        return $q->where('slug', '=', $slug);
    }
}
