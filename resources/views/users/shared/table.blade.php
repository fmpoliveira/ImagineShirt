<table class="table">
    <thead class="table-dark">
        <tr>
            @if ($showFoto)
                <th></th>
            @endif
            <th>Name</th>
            {{-- @if ($showAddress ?? true)
                <th>Address</th>
            @endif --}}
            @if ($showContatos)
                <th>E-Mail</th>

            @endif
            @if ($showDetail)
                <th class="button-icon-col"></th>
            @endif
            @if ($showEdit)
                <th class="button-icon-col"></th>
            @endif
            @if ($showDelete)
                <th class="button-icon-col"></th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                @if ($showFoto)
                <td width="45">
                        <img src="{{ $user->fullPhotoUrl }}" alt="Avatar" class="bg-dark rounded-circle" width="45" height="45">
                </td>
            @endif
                <td>{{ $user->name }}</td>
                {{-- <td>{{ $customer->nif }}</td> --}}
                {{-- <td>{{ $customer->address}}</td> --}}
                <td>{{ $user->email }}</td>
                {{-- @if ($showDepartamento ?? true)
                    <td>{{ $customer->departamentoRef->nome ?? '' }}</td>
                @endif --}}
                {{-- @if ($showContatos)
                    <td>{{ $customer->user->email }}</td>
                @endif --}}
                @if ($showDetail)
                    <td class="button-icon-col"><a class="btn btn-secondary"
                            href="{{ route('users.show', ['user' => $user]) }}">
                            <i class="fas fa-eye"></i></a></td>
                @endif
                @if ($showEdit)
                    <td class="button-icon-col"><a class="btn btn-dark"
                            href="{{ route('users.edit', ['user' => $user]) }}">
                            <i class="fas fa-edit"></i></a></td>
                @endif
                @if ($showDelete)
                    <td class="button-icon-col">
                        <form method="POST" action="{{ route('users.destroy', ['user' => $user]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="delete" class="btn btn-danger">
                                <i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
