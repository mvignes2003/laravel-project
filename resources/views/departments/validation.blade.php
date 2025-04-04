<form method="POST" action="{{ route('departments.store') }}">
    @csrf

    <div>
        <label for="name">Department Name</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name')
            <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="code">Department Code</label>
        <input type="text" name="code" value="{{ old('code') }}">
        @error('code')
            <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">Create Department</button>
</form>
