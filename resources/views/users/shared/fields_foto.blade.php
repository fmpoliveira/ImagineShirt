<img src="{{ $user->fullPhotoUrl }}" alt="Avatar" class="rounded-circle img-thumbnail">
@if ($allowUpload)
    <div class="mb-3 pt-3">
        <input type="file" class="form-control @error('file_foto') is-invalid @enderror" name="file_foto"
            id="inputFileFoto">
        @error('file_foto')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
@endif
{{-- @if ($formToDelete ?? false)
    <button type="submit" class="btn btn-danger" name="deletefoto" form="{{ $formToDelete }}">
        Delete Photo
    </button>
@endif --}}
@if (($allowDelete ?? false) && $user->photo_url)
    @if ($user->user_type == 'C')
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationModal"
            data-action="{{ route('customers.foto.destroy', ['customer' => $user->customer]) }}"
            data-msgLine2="Quer realmente apagar a fotografia do docente <strong>{{ $user->name }}</strong>?">
            Apagar Foto
        </button>
    @else
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationModal"
            data-action="{{ route('users.foto.destroy', ['user' => $user]) }}"
            data-msgLine2="Quer realmente apagar a fotografia do aluno <strong>{{ $user->name }}</strong>?">
            Apagar Foto
        </button>
    @endif
@endif
