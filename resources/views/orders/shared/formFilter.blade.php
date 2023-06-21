<form method="GET" action="{{ route('orders.admin') }}">
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
        <div class="flex-grow-1 pe-2">
            <div class="d-flex justify-content-between">
                <div class="flex-grow-1 me-2 mb-3 form-floating">
                    <select class="form-select" name="customerId" id="inputid">
                        <option {{ old('customerId', $filterByCustomer) === '' ? 'selected' : '' }} value="">
                            All
                        </option>
                        @foreach ($allCustomersWithOrders as $customer)
                            <option {{ old('customerId', $filterByCustomer) == $customer->id ? 'selected' : '' }}
                                value="{{ $customer->id }}">{{ $customer->id . ' - ' . $customer->name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="inputid" class="form-label">Customer</label>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary mb-3 me-2 px-4 flex-grow-1" name="filter">Filter</button>
            <a href="{{ route('orders.admin') }}" class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Reset</a>
        </div>
    </div>
</form>
