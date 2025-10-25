<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Logs extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Automatically cast these attributes to Carbon instances.
     *
     * @var array
     */
    protected $casts = [
        'log_in'     => 'datetime',
        'log_out'    => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Accessor for status (returns readable value)
     *
     * @param  mixed  $attribute
     * @return string
     */
    public function getStatusAttribute($attribute)
    {
        return $this->statusOption()[$attribute] ?? 'Unknown';
    }

    /**
     * List of possible status values
     *
     * @return array
     */
    public function statusOption()
    {
        return [
            '1' => 'Active',
            '0' => 'Inactive',
        ];
    }

    /**
     * Scope to order logs by creation date
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $sort
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query, $sort = 'desc')
    {
        return $query->orderBy('created_at', $sort);
    }

    /**
     * Each log belongs to one register (employee)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function register()
    {
        return $this->belongsTo('App\Register');
    }
}
