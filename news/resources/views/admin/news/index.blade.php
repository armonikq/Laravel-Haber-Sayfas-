@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-6">
    <div class="grid grid-cols-1 gap-6">

        <div>
            <h2 class="text-2xl font-bold mb-4">Haberler</h2>

            <div class="mb-4 text-right">
                <a href="{{ route('admin.news.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">Haber Oluştur</a>
            </div>

            <div class="space-y-4">
                @foreach ($news as $haber)
                <div class="bg-white shadow-md rounded-lg overflow-hidden flex">
                    <img src="{{ asset('storage/' . $haber->image) }}" alt="{{ $haber->title }}" class="w-1/3 object-cover">
                    <div class="p-4 w-2/3">
                        <h3 class="text-lg font-semibold">{{ $haber->title }}</h3>
                        <p class="text-gray-500 text-sm">{{ $haber->created_at->format('d M Y') }}</p>
                        <p class="mt-2 text-gray-700 line-clamp-2">{{ Str::limit($haber->content, 150) }}</p>

                        <div class="mt-4 flex space-x-4">
                            <a href="{{ route('admin.news.edit', $haber->id) }}" class="text-blue-600 hover:underline">Düzenle</a>
                            <form action="{{ route('admin.news.destroy', $haber->id) }}" method="POST" onsubmit="return confirm('Bu haberi silmek istediğinizden emin misiniz?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Sil</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection
