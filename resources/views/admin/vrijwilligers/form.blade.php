@csrf
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="naam" id="name"
           class="form-control @error('name') is-invalid @enderror"
           placeholder="Naam"
           minlength="3"
           value="{{ old('naam', $gebruikers->naam) }}">
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<button type="submit" class="btn btn-success">Save vrijwilliger</button>
