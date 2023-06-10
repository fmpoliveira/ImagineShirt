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

            @if ($showDetail)
                <th class="button-icon-col"></th>
            @endif

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


                @if ($showBlock)
                    <td class="button-icon-col">
                        <form method="POST" action="{{ route('users.block', ['user' => $user->id]) }}">
                            @csrf
                            @method('POST')
                            <button type="submit" name="block" class="btn btn-warning">
                                <i class="fa-solid fa-ban"></i></button>
                        </form>
                    </td>
                @endif

                @if ($user->user_type == 'C')
                {{ $showDetail = false }}
            @endif
            @if ($showDetail)
                <td class="button-icon-col"><a class="btn btn-secondary"
                        href="{{ route('users.show', ['user' => $user]) }}">
                        <i class="fas fa-eye"></i></a></td>
            @endif


            </tr>
        @endforeach

    </tbody>

</table>
