<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';
    protected $fillable = ['title','short_code','rtl'];

    public function static_translations()
    {
    	return $this->belongsToMany('App\StaticTranslation','static_bodies','language_id','static_translation_id')->withPivot('body');
    }
}
