@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-6">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <img src="{{ asset('storage/' . $haber->image) }}" alt="{{ $haber->title }}" class="w-full h-64 object-cover rounded-md">

        <div class="p-6">
            <h1 class="text-3xl font-bold mb-4">{{ $haber->title }}</h1>
            <p class="text-gray-500 text-sm mb-4">{{ $haber->created_at->format('d M Y') }}</p>

            <p class="text-gray-700 text-lg">{{ $haber->content }}</p>

            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow">Geri Dön</a>
            </div>
        </div>
    </div>
</div>
@endsection
