<div class="grid gap-6 mb-6 md:grid-cols-2 mx-4 mt-6">
    <div>
        <label for="name" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Nume</label>
        <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('route_tur') border-red-500 @enderror" placeholder="Ex:Valeria" value="{{ old('email', $user->email ?? '') }}" required />
        @error('name')
            <p class="text-red-500 text-xs mt-1 rounded-md">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="email" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Email</label>
        <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('route_retur') border-red-500 @enderror" placeholder="Ex:antonmaxim97@gmail.md" value="{{ old('email', $user->email ?? '') }}" required />
        @error('email')
            <p class="text-red-500 text-xs mt-1 rounded-md">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="password" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Parolă</label>
        <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('price') border-red-500 @enderror" value="{{ old('price') }}"  />
        @error('password')
            <p class="text-red-500 text-xs mt-1 rounded-md">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="password_confirmation" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Repetă Parola</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('price_ron') border-red-500 @enderror" value="{{ old('price_ron') }}"  />
        @error('password_confirmation')
            <p class="text-red-500 text-xs mt-1 rounded-md">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="admin_level" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Admin Level</label>
        <select id="admin_level" name="admin_level" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            <option value="" disabled selected>Alege tipul de Admin</option>
            <option value="1" {{ old('admin_level', $user->admin_level ?? '') == 1 ? 'selected' : '' }}>Level 1</option>
            <option value="2" {{ old('admin_level', $user->admin_level ?? '') == 2 ? 'selected' : '' }}>Level 2</option>
            <!-- Add more options as needed -->
        </select>
        @error('admin_level')
            <p class="text-red-500 text-xs mt-1 rounded-md">{{ $message }}</p>
        @enderror
    </div>
    
</div>