<?php

namespace App\Exports;

use App\CollectionRound;
use App\Donor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class CollectionRoundExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * CollectionRoundExport constructor.
     *
     * @param CollectionRound $collectionRound
     */
    public function __construct(CollectionRound $collectionRound)
    {
        $this->collection_round = $collectionRound;
    }

    /**
     * Get all Donors
     *
     * @return Collection
     */
    public function collection(): Collection
    {
        $donors_id = collect();
        $bundles = $this->collection_round->bundles;

        foreach ($bundles as $bundle) {
            $donors_id = $donors_id->merge($bundle->donor->id);
        }

        return Donor::whereIn('id', $donors_id->toArray())->get();
    }

    /**
     * Map a Donor to each row
     *
     * @param mixed $donor
     *
     * @return array
     */
    public function map($donor): array
    {
        return [
            $donor->first_name . ' ' . $donor->last_name,
            $donor->address->getFormatted(),
        ];
    }

    /**
     * Define headings
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Donor',
            'Address',
        ];
    }
}
