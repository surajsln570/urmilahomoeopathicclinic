@props(['users' => []])

<div class="overflow-x-auto bg-white rounded-lg border border-gray-200 shadow-sm">
    <table class="w-full text-sm">
        <thead class="bg-gray-100">
            <tr class="text-left text-gray-600">
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Mobile</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Role</th>
                <th class="px-4 py-2 text-center">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr class="border-t hover:bg-gray-50">

                    <td class="px-4 py-2 font-medium">
                        {{ $user->name }}
                    </td>

                    <td class="px-4 py-2">
                        {{ $user->mobile }}
                    </td>

                    <td class="px-4 py-2">
                        {{ $user->email }}
                    </td>

                    <td class="px-4 py-2">
                        <span class="px-2 py-0.5 text-xs rounded bg-blue-100 text-blue-700">
                            {{ $user->role_id }}
                        </span>
                    </td>

                    <td class="px-4 py-2">
                        <div class="flex justify-center gap-2">

                            <a href="#"
                                class="px-2 py-1 text-xs rounded bg-blue-600 text-white hover:bg-blue-700">
                                Edit
                            </a>

                            <form action="{{ route('users.delete', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Delete this user?')"
                                    class="px-2 py-1 text-xs rounded bg-red-600 text-white hover:bg-red-700">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
