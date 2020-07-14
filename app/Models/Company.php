<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['user_id', 'name', 'regi_no', 'address', 'email', 'phone', 'others'];

    // protected static function booted()
    // {
    //     static::addGlobalScope('companyByUser', function (Builder $builder) {
    //         $builder->where('user_id', auth()->user()->id);
    //     });
    // }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeCompanyByUser($query)
    {

        return $query->with('user')->where(function ($query) {
            if (auth()->user()->isAdmin()) {
                return $query;
            }
            $query->where('user_id', auth()->user()->id);
        });
    }
}
