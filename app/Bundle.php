<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use PhpUnitsOfMeasure\PhysicalQuantity\Mass;

/**
 * App\Bundle
 *
 * @property-read CollectionRound $collectionRound
 * @property-read Collection|Product[] $products
 * @method static Builder|Bundle newModelQuery()
 * @method static Builder|Bundle newQuery()
 * @method static Builder|Bundle query()
 * @mixin Eloquent
 */
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

    public function isOpen()
    {
        return $this->status == 0;
    }

    public function isClosed()
    {
        return $this->status != 0;
    }

    public function getStatusName()
    {
        switch ($this->status) {
            case -1:
                return "Rejected";
            case 0:
                return "Waiting approval";
            case 1:
                return "Approved";
            case 2:
                return "Being collected";
            case 3:
                return "Collected";
            default:
                return "Unknown";
        }
    }

    public function weight()
    {
        $weight = 0;

        foreach ($this->products as $product) {
            $weight += $product->weight;
        }

        return $weight;
    }

    public function weightAsMass()
    {
        return new Mass($this->weight(), 'g');
    }
}
