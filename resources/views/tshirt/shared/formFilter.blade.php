<form method="GET" action="{{ route('tshirts.index') }}">
    <div class="d-flex justify-content-between">
        <div class="flex-grow-1 pe-2">
            <div class="d-flex justify-content-between">
                <div class="flex-grow-1 mb-3 form-floating">
                    <select class="form-select" name="category" id="inputCategory">
                        <option {{ old('category', $filterByCategory) === '' ? 'selected' : '' }} value="">
                            All Categories </option>
                        @foreach ($categories as $category)
                            <option {{ old('category', $filterByCategory) == $category->name ? 'selected' : '' }}
                                value="{{ $category->name }}">
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                    <label for="inputCategory" class="form-label">Category</label>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <div class="mb-3 me-2 flex-grow-1 form-floating">
                    <input type="text" class="form-control" name="text" id="inputText"
                        value="{{ old('text', $filterByText) }}">
                    <label for="inputText" class="form-label">Search</label>
                </div>
            </div>
        </div>
        <div class="flex-shrink-1 d-flex flex-column justify-content-between">
            <button type="submit" class="btn btn-primary mb-3 px-4 flex-grow-1" name="filter">Filter</button>
            <a href="{{ route('tshirts.index') }}" class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Reset</a>
        </div>
    </div>
</form>
