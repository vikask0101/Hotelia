<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'position'];

    /**
     * Create a new Amenity.
     */
    public static function createAmenity($data): self
    {
        return self::create($data);
    }

    /**
     * Update the Amenity.
     */
    public function updateAmenity($data): bool
    {
        return $this->update($data);
    }

    /**
     * Update the status of the Amenity.
     */
    public function updateStatus(string $status): bool
    {
        return $this->update(['status' => $status]);
    }
}
