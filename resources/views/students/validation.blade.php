<form action="{{ route('students.store') }}" method="POST">
    @csrf
    <div>
        <label for="roll_no">Roll Number</label>
        <input type="text" name="roll_no" id="roll_no" value="{{ old('roll_no') }}">

        <!-- Show custom error message if roll_no is already taken -->
        @error('roll_no')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}">
    </div>

    <button type="submit">Submit</button>
</form>
