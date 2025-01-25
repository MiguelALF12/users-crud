@extends('layouts.app')

@section('title', 'User List')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">User List</h1>
    <a href="{{ route('users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Add User</a>
    @if($users->isEmpty())
    <p class="text-gray-600">No users found. Add a new user to get started!</p>
    @else
    <table class="table-auto w-full border border-gray-200 bg-white rounded-lg">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Surname</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Phone</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="border-t border-gray-200">
                <td class="px-4 py-2">{{ $user->name }}</td>
                <td class="px-4 py-2">{{ $user->surname }}</td>
                <td class="px-4 py-2">{{ $user->email }}</td>
                <td class="px-4 py-2">{{ $user->phone }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('users.edit', $user) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection