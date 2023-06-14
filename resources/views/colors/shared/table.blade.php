<table class="table">
    <thead class="table-dark">
        <tr>
            <th>Code</th>

            <th>Name</th>

            <th class="button-icon-col"></th>

            <th class="button-icon-col"></th>

            <th class="button-icon-col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($colors as $color)
            <tr>
                <td>{{ $color->code }}</td>
                <td>{{ $color->name }}</td>

                <td class="button-icon-col"><a class="btn btn-secondary"
                        href="{{ route('colors.show', ['color' => $color]) }}">
                        <i class="fas fa-eye"></i></a></td>

                <td class="button-icon-col"><a class="btn btn-dark"
                        href="{{ route('colors.edit', ['color' => $color]) }}">
                        <i class="fas fa-edit"></i></a></td>

                <td class="button-icon-col">
                    <button type="button" name="delete" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#confirmationModal"
                        data-action="{{ route('colors.destroy', ['color' => $color]) }}"
                        data-msgLine1="Do you really want to delete <strong>{{ $color->name }}</strong>?">
                        <i class="fas fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@include('shared.confirmationDialog', [
    'title' => 'Delete Color?',
    'confirmationButton' => 'Delete',
    'formMethod' => 'DELETE',
])
