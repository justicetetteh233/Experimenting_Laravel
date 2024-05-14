<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VoteCast extends Model
{
    use HasFactory;
    // protected $primaryKey =['voters_id', 'positions_id'];
    protected $table = 'vote_casts';
    protected $fillable = [
        "positions_id",
        "candidates_id",
        "voters_id"
    ];

    public function voter(): BelongsTo
    {
      return $this->belongsTo(Voter::class ); 
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function candidate(): BelongsTo
    {
        return  $this->belongsTo(Candidate::class);
    }

}
