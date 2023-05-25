<table class="table">
    <thead class="table-dark">
        <tr>
            <th class="text-nowrap"></th>
            <th>Name</th>
            <th>Category</th>
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
        @foreach ($tshirts as $tshirt)
            <tr>
                <td>
                    <img src="{{ url('storage/tshirt_images/' . $tshirt->image_url) }}" alt="thirtImage"
                        class="img-thumbnail bg-image" style="width: 80px; height: 80px;">
                </td>

                <td>{{ $tshirt->name }}</td>
                <td>{{ $tshirt->category->name }}</td>
                @if ($showDetail)
                    <td class="button-icon-col"><a class="btn btn-secondary" href="#">
                            <i class="fas fa-eye"></i></a></td>
                @endif
                @if ($showEdit)
                    <td class="button-icon-col"><a class="btn btn-dark" href="#">
                            <i class="fas fa-edit"></i></a></td>
                @endif
                @if ($showDelete)
                    <td class="button-icon-col">
                        <form method="POST" action="#">
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
