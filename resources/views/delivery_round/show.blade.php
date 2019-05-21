<h1>Round no. {{ $round->id }}</h1>

<h3>Liste des livraisons</h3>

<table class="table">
    <thead>
        <tr>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Address</th>
        </tr>
    </thead>
    <tbody>

    @foreach ($needy_people as $person)
        <tr>
            <td>{{ $person->first_name }}</td>
            <td>{{ $person->last_name }}</td>
            <td>
                {{ App\DeliveryRound::needyPersonAddress($person->address_id)->line_1 }}
                {{ App\DeliveryRound::needyPersonAddress($person->address_id)->line_2 }}
                {{ App\DeliveryRound::needyPersonAddress($person->address_id)->line_3 }}
                {{ App\DeliveryRound::needyPersonAddress($person->address_id)->city }}
                {{ App\DeliveryRound::needyPersonAddress($person->address_id)->county_province }}
                {{ App\DeliveryRound::needyPersonAddress($person->address_id)->region }}
                {{ App\DeliveryRound::needyPersonAddress($person->address_id)->zip_postal_code }}
                {{ App\DeliveryRound::needyPersonAddress($person->address_id)->country }}
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
