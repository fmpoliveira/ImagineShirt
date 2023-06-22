@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="inputNome"
        {{ $disabledStr }} value="{{ old('name', $user->name) }}">
    <label for="inputNome" class="form-label">Name</label>
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="inputEmail"
        {{ $disabledStr }} value="{{ old('email', $user->email) }}">
    <label for="inputEmail" class="form-label">Email</label>
    @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

{{-- @if($showUserType) --}}
<div class="mb-3 form-floating">
    <select class="form-select @error('user_type') is-invalid @enderror" name="user_type" id="inputUser_type"
        {{ $disabledStr }}>
        <option {{ old('user_type', $user->user_type) == 'A' ? 'selected' : '' }} value="A">Administrator</option>
        <option {{ old('user_type', $user->user_type) == 'E' ? 'selected' : '' }} value="E">Employee</option>
        {{-- <option {{ old('user_type', $user->user_type) == 'C' ? 'selected' : '' }} value="C">Customer</option> --}}
    </select>
    <label for="inputUser_type" class="form-label">User Type</label>
    @error('user_type')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
{{-- @endif --}}


