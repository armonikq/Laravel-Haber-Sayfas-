@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-6">
    <div class="grid grid-cols-3 gap-6">

        <div class="col-span-2">
            <h2 class="text-2xl font-bold mb-4">Haberler</h2>

            <div class="space-y-4">
                @foreach ($news as $haber)
                <div class="bg-white shadow-md rounded-lg overflow-hidden flex">
                    <img src="{{ asset('storage/' . $haber->image) }}" alt="{{ $haber->title }}" class="w-1/3 object-cover">
                    <div class="p-4 w-2/3">
                        <h3 class="text-lg font-semibold">
                            <a href="{{ route('news.view', $haber->id) }}" class="text-blue-600 hover:underline">
                                {{ $haber->title }}
                            </a>
                        </h3>
                        <p class="text-gray-500 text-sm">{{ $haber->created_at->format('d M Y') }}</p>
                        <p class="mt-2 text-gray-700 line-clamp-2">{{ Str::limit($haber->content, 150) }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div>
            <h2 class="text-2xl font-bold mb-4">Global Haberler</h2>
            <div class="space-y-3">
                @foreach ($globalNews as $newsItem)
                <div class="bg-white shadow-md rounded-md p-3 flex">
                    <img src="{{ $newsItem['urlToImage'] }}" alt="{{ $newsItem['title'] }}" class="w-1/3 object-cover rounded-md">
                    <div class="ml-4 w-2/3">
                        <h3 class="text-md font-semibold">
                            <a href="{{ $newsItem['url'] }}" target="_blank" class="text-blue-600 hover:underline">
                                {{ $newsItem['title'] }}
                            </a>
                        </h3>
                        <p class="text-gray-500 text-sm">{{ \Carbon\Carbon::parse($newsItem['publishedAt'])->format('d M Y') }}</p>
                        <p class="mt-2 text-gray-700 text-sm">{{ Str::limit($newsItem['description'], 120) }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection
