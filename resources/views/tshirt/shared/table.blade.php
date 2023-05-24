<table class="table">
    <thead class="table-dark">
        <tr>

            <th class="text-nowrap">Image</th>

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
                    {{-- <img src="{{ url('storage/tshirt_images/' . $tshirt->image_url) }}" alt="thirtImage"
                        class="bg-dark rounded-circle" width="45" height="45"> --}}
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


{{-- <table class="table">
    <thead class="table-dark">
        <tr>
            <th class="text-nowrap">Image</th>
            <th class="text-nowrap">Name</th>
            <th class="text-nowrap">Category</th>
            @if ($showDetail && $showEdit && $showDelete)
                <th class="text-nowrap">Actions</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($tshirts as $tshirt)
            <tr>
                <td>
                    <img src="{{ url('storage/tshirt_images/' . $tshirt->image_url) }}" alt="Image"
                        class="img-thumbnail bg-image" style="width: 80px; height: 80px; object-fit: cover;">
                </td>
                <td>{{ $tshirt->name }}</td>
                <td>{{ $tshirt->category->name }}</td>
                @if ($showDetail && $showEdit && $showDelete)
                    <td>
                        <a href="#" class="btn btn-primary">View</a>
                        <a href="#" class="btn btn-secondary">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table> --}}
