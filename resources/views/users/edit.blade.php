@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit User</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" class="mt-1 block w-full border-gray-300 rounded-md">
        </div>
        <div class="mb-4">
            <label for="lastname" class="block text-sm font-medium text-gray-700">Lastname</label>
            <input type="text" id="lastname" name="lastname" value="{{ $user->last_name }}" class="mt-1 block w-full border-gray-300 rounded-md">
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" class="mt-1 block w-full border-gray-300 rounded-md">
        </div>
        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
            <input type="text" id="phone" name="phone" value="{{ $user->phone_number }}" class="mt-1 block w-full border-gray-300 rounded-md">
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password (leave blank if unchanged)</label>
            <input type="password" id="password" name="password" class="mt-1 block w-full border-gray-300 rounded-md">
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full border-gray-300 rounded-md">
        </div>
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
            <a href="{{ route('users.index') }}" class="ml-2 text-blue-500">Cancel</a>
        </div>
    </form>
</div>
@endsection