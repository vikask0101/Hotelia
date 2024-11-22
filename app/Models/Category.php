<?php

namespace App\Models;

use App\Http\Requests\Backend\Category\StoreCategoryRequest;
use App\Http\Requests\Backend\Category\UpdateCategoryRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'position'];

    /**
     * Create a new category.
     */
    public static function createCategory($data): self
    {
        return self::create($data);
    }

    /**
     * Update the category.
     */
    public function updateCategory($data): bool
    {
        return $this->update($data);
    }

    /**
     * Update the status of the category.
     */
    public function updateStatus(string $status): bool
    {
        return $this->update(['status' => $status]);
    }
}
