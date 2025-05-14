@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-4">Edit User</h2>

        <div class="card p-4 shadow-sm rounded-3">
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Username -->
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                    @error('username')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Jabatan -->
                <div class="mb-3">
                    <label for="position" class="form-label">Jabatan</label>
                    <select class="form-control" id="position" name="position" required onchange="togglePenugasan()">
                        <option value="">-- Pilih Jabatan --</option>
                        <option value="yantek" {{ old('position', $user->position) == 'yantek' ? 'selected' : '' }}>Pelayanan Teknik (Yantek)</option>
                        <option value="admin" {{ old('position', $user->position) == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('position')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Penugasan (Hidden by default, will appear only for Yantek) -->
                <div class="mb-3" id="penugasan-container" style="{{ old('position', $user->position) == 'yantek' ? 'display:block;' : 'display:none;' }}">
                    <label for="penugasan" class="form-label">Penugasan</label>
                    <select class="form-control" id="penugasan" name="penugasan">
                        <option value="">-- Pilih Penugasan --</option>
                        @foreach ($penugasan as $tugas)
                            <option value="{{ $tugas }}" {{ old('penugasan', $user->penugasan) == $tugas ? 'selected' : '' }}>{{ $tugas }}</option>
                        @endforeach
                    </select>
                    @error('penugasan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password (Optional) -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    @error('password_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Update User</button>
            </form>
        </div>
    </div>

    <script>
        // Function to toggle the Penugasan field based on Jabatan selection
        function togglePenugasan() {
            var position = document.getElementById('position').value;
            var penugasanContainer = document.getElementById('penugasan-container');
            if (position == 'yantek') {
                penugasanContainer.style.display = 'block'; // Show Penugasan for Yantek
            } else {
                penugasanContainer.style.display = 'none'; // Hide Penugasan for Admin
            }
        }
    </script>
@endsection
