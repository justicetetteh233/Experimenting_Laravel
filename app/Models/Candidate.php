<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidate extends Model implements Authenticatable
{
    use HasFactory;
    use AuthenticatableTrait;

    protected $table ='candidates';

    protected $fillable =[
        'name',
        'password',
        'email',
        'user_type',
        'picture_path',
        'positions_id'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function position():BelongsTo
    {
        return $this->belongsTo(Position::class,'positions_id');
    }

    public function voteCasts(): HasMany
    {
        return $this->hasMany(VoteCast::class);
    }
    
}
