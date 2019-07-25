<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use PhpUnitsOfMeasure\PhysicalQuantity\Mass;

/**
 * App\CollectionRound
 *
 * @property-read Collection|Bundle[] $bundles
 * @property-read Employee $employee
 * @method static Builder|CollectionRound newModelQuery()
 * @method static Builder|CollectionRound newQuery()
 * @method static Builder|CollectionRound query()
 * @mixin Eloquent
 */
class CollectionRound extends Model
{
    protected $fillable = ['round_date', 'user_id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function bundles()
    {
        return $this->hasMany(Bundle::class);
    }

    public function getStatusName()
    {
        switch ($this->status) {
            case 0:
                return "Not ready";
            case 1:
                return "Ready";
            case 2:
                return "In progress";
            case 3:
                return "Done";
            default:
                return "Unknown";
        }
    }

    public function weight()
    {
        $weight = 0;

        foreach ($this->bundles as $bundle) {
            $weight += $bundle->weight();
        }

        return $weight;
    }

    public function weightAsMass()
    {
        return new Mass($this->weight(), 'g');
    }
}
