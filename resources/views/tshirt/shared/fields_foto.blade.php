<img src="{{ asset('img/no-image.png') }}" alt="Tshirt" class="img-thumbnail">
<div class="mb-3 pt-3">
    <input type="file" class="form-control @error('tshirt_image') is-invalid @enderror" name="tshirt_image"
        id="inputTshirtImage">
    @error('tshirt_image')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
