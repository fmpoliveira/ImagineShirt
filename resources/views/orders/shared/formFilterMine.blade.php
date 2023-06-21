<form method="GET" action="{{ route('privateOrder.indexPrivate') }}">
    <div class="d-flex justify-content-between">
        <div class="flex-grow-1 pe-2">
            <div class="d-flex justify-content-between">
                <div class="flex-grow-1 me-2 mb-3 form-floating">
                    <select class="form-select" name="status" id="inputstatus">
                        <option {{ old('status', $filterByStatus) === '' ? 'selected' : '' }} value="">
                            All
                        </option>
                        @foreach ($allOrderStatus as $orderStatus)
                            <option {{ old('status', $filterByStatus) == $orderStatus ? 'selected' : '' }}
                                value="{{ $orderStatus }}">{{ $orderStatus }}
                            </option>
                        @endforeach
                    </select>
                    <label for="inputstatus" class="form-label">Order status</label>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary mb-3 me-2 px-4 flex-grow-1" name="filter">Filter</button>
            <a href="{{ route('privateOrder.indexPrivate') }}" class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Reset</a>
        </div>
    </div>
</form>
