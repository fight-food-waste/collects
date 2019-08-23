<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpUnitsOfMeasure\PhysicalQuantity\Mass;
use PhpUnitsOfMeasure\Exception\NonStringUnitName;
use PhpUnitsOfMeasure\Exception\NonNumericValue;

class Bundle extends Model
{
    protected $fillable = [
        'user_id',
    ];

    public function collectionRound()
    {
        return $this->belongsTo(CollectionRound::class);
    }

    public function donor()
    {
        return $this->belongsTo(Donor::class, 'user_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Is the bundle read-only?
     *
     * @return bool
     */
    public function isClosed(): bool
    {
        return $this->status != 0;
    }

    /**
     * Get a human-readable name for all possible statuses
     *
     * @return string
     */
    public function getStatusName(): string
    {
        switch ($this->status) {
            case -1:
                return __('admin.bundles.statuses.rejected');
            case 0:
                return __('admin.bundles.statuses.waiting_approval');
            case 1:
                return __('admin.bundles.statuses.approved');
            case 2:
                return __('admin.bundles.statuses.being_collected');
            case 3:
                return __('admin.bundles.statuses.collected');
            default:
                return __('admin.bundles.statuses.unknown');
        }
    }

    /**
     * Convert weight integer as a Mass object in grams
     *
     * @return Mass
     * @throws NonNumericValue
     * @throws NonStringUnitName
     */
    public function weightAsMass(): Mass
    {
        return new Mass($this->weight(), 'g');
    }

    /**
     * Get total Bundle weight by adding up all the products' weight
     *
     * @return int
     */
    public function weight(): int
    {
        $weight = 0;

        foreach ($this->products as $product) {
            $weight += $product->weight;
        }

        return $weight;
    }
}
