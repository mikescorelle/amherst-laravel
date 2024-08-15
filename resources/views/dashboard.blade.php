<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between w-full items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            @if (Auth::user()->is_admin)
            <a href="{{ route('users.create') }}" class="text-white bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded">
                Create User
            </a>
            @endif
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-center mb-5">
                    <img src="https://pentagram-production.imgix.net/3eeb5cd2-1209-4a5b-909d-75fd75d0bd6d/djs_amherst_03.jpg?rect=%2C%2C%2C&w=740&crop=1&q=70&fm=jpg&auto=format&fit=crop&h=493&dpr=2"
                    style="height: 100px;">
                </div>
                <div class="p-6 text-gray-900">
                    <div class="flex flex-wrap justify-center -mx-2">
                        @foreach ($users as $user)
                            <div class="max-w-sm rounded overflow-hidden shadow-lg m-2">
                                <img class="w-1/2 mx-auto" src="https://avatar.iran.liara.run/public/{{ $user->id }}" alt="Image">
                                <div class="px-6 py-4">
                                    <p class="font-bold">{{ $user->special_name }}</p>
                                    <p>
                                        @if ($user->is_admin)
                                            Admin
                                        @else
                                            Regular User
                                        @endif
                                    </p>
                                    <p>Bio:
                                        @if (empty($user->bio))
                                            Not Available
                                        @else
                                            {{ $user->bio }}
                                        @endif
                                    </p>
                                </div>
                                @if (Auth::user()->is_admin || Auth::id() === $user->id)
                                <div class="px-6 py-4 flex justify-between">
                                    <a href="{{ route('users.edit', $user->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Edit
                                    </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

