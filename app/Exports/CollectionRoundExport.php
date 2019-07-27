<?php

namespace App\Exports;

use App\CollectionRound;
use App\Donor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

/**
 * @property int volunteer_id
 */
class CollectionRoundExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(CollectionRound $collectionRound)
    {
        $this->collection_round = $collectionRound;
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        $donors_id = collect();
        $bundles = $this->collection_round->bundles;

        foreach ($bundles as $bundle) {
            $donors_id = $donors_id->merge($bundle->donor->id);
        }

        return Donor::whereIn('id', $donors_id->toArray())->get();
    }

    public function map($donor): array
    {
        return [
            $donor->first_name . ' ' . $donor->last_name,
            $donor->address->getFormatted(),
        ];
    }

    public function headings(): array
    {
        return [
            'Donor',
            'Address',
        ];
    }
}
