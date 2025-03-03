<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsController
{
    public function index()
    {
        $news = News::latest()->get();

        $apiResponse = Http::get('https://newsapi.org/v2/top-headlines', [
            'country' => 'us',
            'apiKey' => 'cf7a9705a6be4f27831bd21558dd0ade',
        ]);
        $globalNews = $apiResponse->json()['articles'];

        return view('home', compact('news', 'globalNews'));
    }

    public function view($id)
    {
        $haber = News::find($id);

        return view('news.view', compact('haber'));
    }

    public function indexAdmin()
    {
        $news = News::latest()->get();

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news_images', 'public');
        }

        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Haber başarıyla eklendi.');
    }

    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('admin.news.index');
    }


    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }


    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $imagePath = $news->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news_images', 'public');
        }

        $news->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Haber başarıyla güncellendi.');
    }
}

