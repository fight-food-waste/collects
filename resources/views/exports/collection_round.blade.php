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
    @foreach ($bundles->reverse() as $bundle)
        <tr>
            <th scope="row">
                <h4 class="h6 g-mb-2">#{{ $bundle->id }}</h4>
            </th>
            <td>{{ $bundle->created_at }}</td>

            <td>{{ count($bundle->products)  }}</td>
            <td>{{ $bundle->weightAsMass()->toUnit('g') }} g</td>
            <td>
                {{ $bundle->donor->getFullName() }}
            </td>
            <td>{{ $bundle->donor->address->getFormatted() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
