<table class="table">
    <thead class="table-dark">
        <tr>
            <th>Name</th>

            <th class="button-icon-col"></th>

            <th class="button-icon-col"></th>

            <th class="button-icon-col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>

                <td class="button-icon-col"><a class="btn btn-secondary"
                        href="{{ route('categories.show', ['category' => $category]) }}">
                        <i class="fas fa-eye"></i></a></td>

                <td class="button-icon-col"><a class="btn btn-dark"
                        href="{{ route('categories.edit', ['category' => $category]) }}">
                        <i class="fas fa-edit"></i></a></td>

                <td class="button-icon-col">
                    <button type="button" name="delete" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#confirmationModal"
                        data-action=" {{ route('categories.destroy', ['category' => $category]) }}"
                        data-msgLine1="Do you really want to delete <strong>{{ $category->name }}</strong>?">
                        <i class="fas fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@include('shared.confirmationDialog', [
    'title' => 'Delete Category?',
    'confirmationButton' => 'Delete',
    'formMethod' => 'DELETE',
])
