<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    /**
     * Disable mass assignment protection (all fields fillable).
     *
     * You can replace this with $fillable if you prefer explicit control.
     */
    protected $guarded = [];

    /**
     * Automatically cast columns to native types.
     *
     * @var array
     */
    protected $casts = [
        'date'       => 'date',       // Cast 'date' field to Carbon instance
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Each notification belongs to one register (user/employee).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function register()
    {
        return $this->belongsTo(Register::class);
    }
}
