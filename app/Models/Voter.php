<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Voter extends Model implements Authenticatable
{
    use HasFactory;
    use AuthenticatableTrait;
    protected $table ='voters';

    protected $fillable =[
        'name',
        'password',
        'email',
        'user_type',
        'picture_path'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function castedVotes():HasMany
    {
        return $this->hasMany(VoteCast::class,'voters_id','id');
    }
}
