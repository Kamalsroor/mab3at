<?php
namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Locale extends Eloquent
{
    protected $fillable = ['name','locale'];
    protected $primaryKey = 'id';
    protected $table = 'locales';
    use SoftDeletes;

    public function getLocaleWithNameAttribute()
    {
        return $this->name.' ('.$this->locale.')';
    }

    public function scopeFilterByLocale($q, $locale)
    {
        if (! $locale) {
            return $q;
        }

        return $q->where('locale', '=', $locale);
    }
}
