@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="unit_price_catalog"
        id="inputUnitPriceCatalog" {{ $disabledStr }}
        value="{{ old('unit_price_catalog', $price->unit_price_catalog) }}">
    <label for="inputUnitPriceCatalog" class="form-label">unit_price_catalog</label>
    @error('unit_price_catalog')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="unit_price_own"
        id="inputUnitPriceOwn" {{ $disabledStr }} value="{{ old('unit_price_own', $price->unit_price_own) }}">
    <label for="inputunit_price_own" class="form-label">unit_price_own</label>
    @error('unit_price_own')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="unit_price_catalog_discount"
        id="inputUnitPriceCatalogDiscount" {{ $disabledStr }}
        value="{{ old('unit_price_catalog_discount', $price->unit_price_catalog_discount) }}">
    <label for="inputUnitPriceCatalogDiscount" class="form-label">unit_price_catalog_discount</label>
    @error('unit_price_catalog_discount')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="unit_price_own_discount"
        id="inputUnitPriceOwnDiscount" {{ $disabledStr }}
        value="{{ old('unit_price_own_discount', $price->unit_price_own_discount) }}">
    <label for="inputUnitPriceOwnDiscount" class="form-label">unit_price_own_discount</label>
    @error('unit_price_own_discount')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="qty_discount"
        id="inputQtyDiscount" {{ $disabledStr }} value="{{ old('qty_discount', $price->qty_discount) }}">
    <label for="inputQtyDiscount" class="form-label">qty_discount</label>
    @error('qty_discount')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
