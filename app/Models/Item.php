<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
        'body',
        'now_at',
        'time_at',
        'value',
        'item_types_id',
        'status',
        'image',
        'rich_text'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    public function itemTypes(): BelongsTo
    {
        return $this->belongsTo(ItemType::class, 'item_types_id','id');
    }
}
