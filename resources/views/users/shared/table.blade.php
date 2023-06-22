<table class="table">

    <thead class="table-dark">
        <tr>
            @if ($showFoto)
                <th></th>
            @endif

            <th>Name</th>

            @if ($showEmail)
                <th>E-Mail</th>
            @endif

            @if ($showUserType)
                <th>User Type</th>
            @endif

            {{-- @if ($showDetail) --}}
            <th class="button-icon-col"></th>
            {{-- @endif --}}

            @if ($showEdit)
                <th class="button-icon-col"></th>
            @endif

            @if ($showDelete)
                <th class="button-icon-col"></th>
            @endif

            @if ($showBlock)
                <th class="button-icon-col"></th>
            @endif

        </tr>

    </thead>

    <tbody>
        @foreach ($users as $user)
            <tr>

                @if ($showFoto)
                    <td width="45">
                        <img src="{{ $user->fullPhotoUrl }}" alt="Avatar" class="bg-dark rounded-circle" width="45"
                            height="45">
                    </td>
                @endif

                <td>{{ $user->name }}</td>

                @if ($showEmail)
                    <td>{{ $user->email }}</td>
                @endif

                @if ($showUserType)
                    <td>{{ match ($user->user_type) {
                        'A' => 'Administrator',
                        'C' => 'Customer',
                        'E' => 'Employee',
                        default => 'Unknown',
                    } ?? 'Unknown' }}
                    </td>
                @endif



                @if ($showEdit)
                    <td class="button-icon-col"><a class="btn btn-dark"
                            href="{{ route('users.edit', ['user' => $user]) }}">
                            <i class="fas fa-edit"></i></a></td>
                @endif

                @if ($user->user_type == 'C')
                    <td></td>
                    {{ $showDetail = false }}
                @endif
                
                @if ($showDetail)
                    <td class="button-icon-col"><a class="btn btn-secondary"
                            href="{{ route('users.show', ['user' => $user]) }}">
                            <i class="fas fa-eye"></i></a>
                    </td>
                @endif




                @if ($showBlock)
                    <td class="button-icon-col">
                        <form method="POST" action="{{ route('users.block', ['user' => $user]) }}">
                            @csrf
                            @method('POST')
                            @if ($user->blocked == 0)
                                <button type="submit" name="block" class="btn btn-warning">
                                    <i class="fa-sharp fa-solid fa-lock"></i>
                                </button>
                            @else
                                <button type="submit" name="block" class="btn btn-success">
                                    <i class="fa-solid fa-lock-open"></i>
                                </button>
                            @endif
                        </form>
                    </td>
                @endif



                @if ($showDelete)
                    <td class="button-icon-col">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#confirmationModal"
                            data-action="{{ route('users.destroy', ['user' => $user->id]) }}"
                            data-msgLine1="Do you really want to delete the user <strong>{{ $user->name }}</strong>?">
                            <i class="fas fa-trash"></i>

                        </button>
                    </td>
                @endif


            </tr>
        @endforeach

    </tbody>

</table>


@include('shared.confirmationDialog', [
    'title' => 'Delete user?',
    'confirmationButton' => 'Delete',
    'formMethod' => 'DELETE',
])
