@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="inputName"
        {{ $disabledStr }} value="{{ old('name', $tshirt->name) }}">
    <label for="inputName" class="form-label">Name</label>
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('description') is-invalid @enderror" name="description"
        id="inputDescription" {{ $disabledStr }} value="{{ old('description', $tshirt->description) }}">
    <label for="inputDescription" class="form-label">Description</label>
    @error('description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <select class="form-select @error('category') is-invalid @enderror" name="category" id="inputCategory"
        {{ $disabledStr }}>
        <option value="No Category">No Category</option>
        @foreach ($categories as $category)
            <option
                {{ $category->id == old('category', $tshirt->category ? $tshirt->category->id : '') ? 'selected' : '' }}
                value="{{ $category->id }}">
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    <label for="inputCategory" class="form-label">Category</label>
    @error('category')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
