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
                {{ App\DeliveryRound::needyPersonAddress($person->address_id) }}
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
