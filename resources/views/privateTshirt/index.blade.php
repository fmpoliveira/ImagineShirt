@extends('template.layout')

@section('titulo', 'Private Space')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Private Space</li>
        <li class="breadcrumb-item">My Tshirts</li>
    </ol>
@endsection

@section('main')

    @auth
        <p>
            <a class="btn btn-success" href="{{ route('tshirts.create') }}"><i class="fas fa-plus"></i> &nbsp;Add Tshirt</a>
        </p>
        @if (count($tshirts) != 0)
            <hr>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th class="text-nowrap"></th>
                        <th>Name</th>

                        <th class="button-icon-col"></th>

                        <th class="button-icon-col"></th>

                        <th class="button-icon-col"></th>

                        <th class="button-icon-col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tshirts as $tshirt)
                        <tr>
                            <td>
                                <img src="{{ route('private.image', ['imagePath' => $tshirt->image_url]) }}" alt="tshirtImage"
                                    class="img-thumbnail bg-image" style="width: 80px; height: 80px;">
                            </td>
                            <td>{{ $tshirt->name }}</td>

                            <td class="button-icon-col"><a class="btn btn-secondary"
                                    href="{{ route('privateTshirt.showPrivate', ['tshirt' => $tshirt]) }}">
                                    <i class="fas fa-eye"></i></a></td>

                            <td class="button-icon-col"><a class="btn btn-dark"
                                    href="{{ route('privateTshirt.editPrivate', ['tshirt' => $tshirt]) }}">
                                    <i class="fas fa-edit"></i></a></td>

                            <td class="button-icon-col">
                                <button type="button" name="delete" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#confirmationModal"
                                    data-action="{{ route('privateTshirt.destroyPrivate', ['tshirt' => $tshirt]) }}"
                                    data-msgLine1="Do you really want to delete <strong>{{ $tshirt->name }}</strong>?">
                                    <i class="fas fa-trash"></i></button>
                            </td>

                            <td class="button-icon-col">
                                <form method="POST" action="{{ route('cart.add', ['tshirt' => $tshirt]) }}">
                                    @csrf
                                    <button type="submit" name="addToCart" class="btn btn-success">
                                        <i class="fas fa-plus"></i></button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <br>
            <p>No private tshirts available. Add one.</p>
        @endif
        <div class="mt-4">
            {{ $tshirts->withQueryString()->links() }}
        </div>

        @include('shared.confirmationDialog', [
            'title' => 'Delete Tshirt?',
            'confirmationButton' => 'Delete',
            'formMethod' => 'DELETE',
        ])




    @endauth


@endsection
