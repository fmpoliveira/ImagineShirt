<form method="GET" action="{{ route('categories.index') }}">
    <div class="d-flex justify-content-between">
        <div class="flex-grow-1 pe-2">
            <div class="d-flex justify-content-between">
                <div class="mb-3 me-2 flex-grow-1 form-floating">
                    <input type="text" class="form-control" name="text" id="inputText"
                        value="{{ old('text', $filterByText) }}">
                    <label for="inputText" class="form-label">Search</label>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary mb-3 me-2 px-4 flex-grow-1" name="filter">Filter</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Reset</a>
        </div>
    </div>
</form>
