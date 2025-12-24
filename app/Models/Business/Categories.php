<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'parent_id',
    ];

    /**
     * Get the parent category.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Categories::class, 'parent_id');
    }

    /**
     * Get the direct sub-categories.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Categories::class, 'parent_id');
    }

    /**
     * Get all recursive sub-categories (the whole tree down).
     */
    public function childrenRecursive(): HasMany
    {
        return $this->children()->with('childrenRecursive');
    }

    /**
     * Get all descendant IDs recursively.
     */
    public function getAllDescendantIds()
    {
        $ids = [];
        $this->collectDescendants($this->childrenRecursive, $ids);
        return $ids;
    }

    private function collectDescendants($children, &$ids)
    {
        foreach ($children as $child) {
            $ids[] = $child->id;
            if ($child->relationLoaded('childrenRecursive') && $child->childrenRecursive->isNotEmpty()) {
                $this->collectDescendants($child->childrenRecursive, $ids);
            }
        }
    }
}
