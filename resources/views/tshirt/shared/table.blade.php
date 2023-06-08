<table class="table">
    <thead class="table-dark">
        <tr>
            <th class="text-nowrap"></th>
            <th>Name</th>
            {{-- @if (Auth::check() && Auth::user()->user_type !== 'A') --}}
            <th>Category</th>
            {{-- @endif --}}
            <th class="button-icon-col"></th>

            <th class="button-icon-col"></th>

            <th class="button-icon-col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tshirts as $tshirt)
            <tr>
                <td>
                    <img src="{{ asset('storage/tshirt_images/' . $tshirt->image_url) }}" alt="tshirtImage"
                        class="img-thumbnail bg-image" style="width: 80px; height: 80px;">
                </td>
                <td>{{ $tshirt->name }}</td>

                @if ($tshirt->category !== null)
                    {{-- Only shows category name if it has a category --}}
                    <td>{{ $tshirt->category->name }}</td>
                @else
                    {{-- leave the td space so that it doesn't brake the table --}}
                    <td>No Category</td>
                @endif
                <td class="button-icon-col"><a class="btn btn-secondary"
                        href="{{ route('tshirts.show', ['tshirt' => $tshirt]) }}">
                        <i class="fas fa-eye"></i></a></td>

                <td class="button-icon-col"><a class="btn btn-dark"
                        href="{{ route('tshirts.edit', ['tshirt' => $tshirt]) }}">
                        <i class="fas fa-edit"></i></a></td>

                <td class="button-icon-col">
                    <button type="button" name="delete" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#confirmationModal"
                        data-action="{{ route('tshirts.destroy', ['tshirt' => $tshirt]) }}"
                        data-msgLine1="Do you really want to delete <strong>{{ $tshirt->name }}</strong>?">
                        <i class="fas fa-trash"></i></button>
                </td>

            </tr>
        @endforeach
    </tbody>
</table>

@include('shared.confirmationDialog', [
    'title' => 'Delete Tshirt?',
    'confirmationButton' => 'Delete',
    'formMethod' => 'DELETE',
])
