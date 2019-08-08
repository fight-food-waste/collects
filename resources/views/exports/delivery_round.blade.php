<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Submission date</th>
        <th scope="col">Number of products</th>
        <th scope="col">Weight</th>
        <th scope="col">Requester</th>
        <th scope="col">Address</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($deliveryRequests->reverse() as $deliveryRequest)
        <tr>
            <th scope="row">
                <h4 class="h6 g-mb-2">#{{ $deliveryRequest->id }}</h4>
            </th>
            <td>{{ $deliveryRequest->created_at }}</td>

            <td>{{ count($deliveryRequest->products)  }}</td>
            <td>{{ $deliveryRequest->weightAsMass()->toUnit('g') }} g</td>
            <td>
                {{ $deliveryRequest->needyPerson->getFullName() }}
            </td>
            <td>{{ $deliveryRequest->needyPerson->address->getFormatted() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
