<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItemType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
    ];

    public function item() : HasMany
    {
        return $this->hasMany(Item::class, 'item_types_id','id');
    }

    public function scopeSearch($query, $search = null) 
    {        
        if ($search) 
        {
            $query = $query->where('description', 'LIKE', "%{$search}%");
        }
        return $query->orderBy('description');            
    }

    public function scopeSearchPluckToArray($query, $search)
    {
        return $query
            ->search($search)
            ->pluck('description', 'id')
            ->toArray();
    }

    public function scopeGetDescription($query, $value): ?string
    {
        return $query->find($value)?->description;
    }
}
