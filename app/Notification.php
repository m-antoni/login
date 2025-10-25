<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * (You can use $fillable instead of guarded=[] if you prefer to be explicit.)
     */
    protected $guarded = [];

    /**
     * Get the register that owns this notification.
     */
    public function register()
    {
        return $this->belongsTo(Register::class);
        // Same as belongsTo('App\Register'), but cleaner and IDE-friendly
    }
}
