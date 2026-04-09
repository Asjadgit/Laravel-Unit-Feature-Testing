@extends('layout')

@section('title', 'Edit User')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        {{-- Header Section --}}
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Edit User</h1>
                <p class="text-sm text-gray-500 mt-1">Update user information</p>
            </div>
            <div>
                <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200 ease-in-out shadow-sm inline-flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Users
                </a>
            </div>
        </div>

        {{-- Edit User Form --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Form Body --}}
                <div class="p-6">
                    {{-- Profile Image Section --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Profile Avatar</label>
                        <div class="flex items-center space-x-6">
                            <div class="flex-shrink-0">
                                <div id="avatarPreview" class="h-24 w-24 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center text-white text-2xl font-semibold overflow-hidden">
                                    @if($user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}" class="h-full w-full object-cover" alt="{{ $user->name }}">
                                    @else
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-grow">
                                <input type="file" name="avatar" id="avatar" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="mt-1 text-xs text-gray-500">JPEG, PNG, JPG or GIF (Max 2MB). Leave empty to keep current avatar.</p>
                                @if($user->avatar)
                                    <div class="mt-2">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" name="remove_avatar" value="1" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                            <span class="ml-2 text-sm text-red-600">Remove current avatar</span>
                                        </label>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @error('avatar')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Full Name --}}
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   name="name"
                                   id="name"
                                   value="{{ old('name', $user->name) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                                   placeholder="Enter full name"
                                   required>
                            @error('name')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email Address --}}
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email"
                                   name="email"
                                   id="email"
                                   value="{{ old('email', $user->email) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                                   placeholder="user@example.com"
                                   required>
                            @error('email')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password (Optional) --}}
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                New Password
                            </label>
                            <input type="password"
                                   name="password"
                                   id="password"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror"
                                   placeholder="Leave blank to keep current password">
                            <p class="mt-1 text-xs text-gray-500">Leave empty to keep current password</p>
                            @error('password')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                Confirm New Password
                            </label>
                            <input type="password"
                                   name="password_confirmation"
                                   id="password_confirmation"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Confirm new password">
                        </div>

                        {{-- Role --}}
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                                Role <span class="text-red-500">*</span>
                            </label>
                            <select name="role"
                                    id="role"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('role') border-red-500 @enderror"
                                    required>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                <option value="editor" {{ old('role', $user->role) == 'editor' ? 'selected' : '' }}>Editor</option>
                            </select>
                            @error('role')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status"
                                    id="status"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror"
                                    required>
                                <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="banned" {{ old('status', $user->status) == 'banned' ? 'selected' : '' }}>Banned</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Form Actions --}}
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                    <a href="{{ route('users.index') }}"
                       class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition font-medium">
                        Update User
                    </button>
                </div>
            </form>
        </div>

        {{-- Danger Zone (Delete User) --}}
        <div class="mt-8 bg-white rounded-lg shadow-sm border border-red-200 overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-medium text-red-600">Danger Zone</h3>
                        <p class="mt-1 text-sm text-gray-500">Once you delete this user, all associated data will be permanently removed.</p>
                    </div>
                    <button type="button"
                            onclick="confirmDelete()"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition font-medium">
                        Delete User
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Delete Form (Hidden) --}}
<form id="delete-form" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
    // Avatar preview functionality
    const avatarInput = document.getElementById('avatar');
    const avatarPreview = document.getElementById('avatarPreview');

    avatarInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                avatarPreview.innerHTML = `<img src="${e.target.result}" class="h-full w-full object-cover">`;
                avatarPreview.classList.remove('bg-gradient-to-r', 'from-blue-400', 'to-blue-600', 'flex', 'items-center', 'justify-center');
            }
            reader.readAsDataURL(file);
        } else {
            // Keep existing avatar or reset to default
            @if($user->avatar)
                avatarPreview.innerHTML = `<img src="{{ asset('storage/' . $user->avatar) }}" class="h-full w-full object-cover" alt="{{ $user->name }}">`;
            @else
                avatarPreview.innerHTML = `<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>`;
                avatarPreview.classList.add('bg-gradient-to-r', 'from-blue-400', 'to-blue-600', 'flex', 'items-center', 'justify-center');
            @endif
        }
    });

    // Password match validation (only if password fields are filled)
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirmation');

    function checkPasswordMatch() {
        if (passwordInput.value.length > 0 || confirmInput.value.length > 0) {
            if (passwordInput.value !== confirmInput.value) {
                confirmInput.setCustomValidity('Passwords do not match');
            } else if (passwordInput.value.length > 0 && passwordInput.value.length < 8) {
                passwordInput.setCustomValidity('Password must be at least 8 characters');
            } else {
                passwordInput.setCustomValidity('');
                confirmInput.setCustomValidity('');
            }
        } else {
            confirmInput.setCustomValidity('');
        }
    }

    passwordInput.addEventListener('change', checkPasswordMatch);
    passwordInput.addEventListener('keyup', checkPasswordMatch);
    confirmInput.addEventListener('keyup', checkPasswordMatch);

    // Confirm delete
    function confirmDelete() {
        if (confirm('Are you sure you want to delete this user? This action cannot be undone and will permanently remove all associated data.')) {
            document.getElementById('delete-form').submit();
        }
    }

    // Warn before leaving if changes are made
    let formChanged = false;
    const form = document.querySelector('form');
    const formInputs = form.querySelectorAll('input, select, textarea');

    formInputs.forEach(input => {
        input.addEventListener('change', () => {
            formChanged = true;
        });
        if (input.type !== 'file') {
            input.addEventListener('input', () => {
                formChanged = true;
            });
        }
    });

    window.addEventListener('beforeunload', (e) => {
        if (formChanged) {
            e.preventDefault();
            e.returnValue = 'You have unsaved changes. Are you sure you want to leave?';
        }
    });

    form.addEventListener('submit', () => {
        formChanged = false;
    });
</script>
@endsection
