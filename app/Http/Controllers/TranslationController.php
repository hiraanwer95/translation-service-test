<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Translation;
use App\Models\Tag;

class TranslationController extends Controller
{
    public function index(Request $request) {
        $query = Translation::query()->with('tags');

        if ($request->has('key')) {
            $query->where('key', 'like', '%' . $request->key . '%');
        }

        if ($request->has('content')) {
            $query->where('content', 'like', '%' . $request->content . '%');
        }

        if ($request->has('locale')) {
            $query->where('locale', $request->locale);
        }

        if ($request->has('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('name', $request->tag);
            });
        }

        return response()->json($query->paginate(50)); // paginate to avoid big loads
    }
    
    public function store(Request $request) {
        $data = $request->validate([
            'key' => 'required|string',
            'locale' => 'required|string',
            'content' => 'required|string',
            'tags' => 'array',
            'tags.*' => 'string',
        ]);
    
        $translation = Translation::create([
            'key' => $data['key'],
            'locale' => $data['locale'],
            'content' => $data['content'],
        ]);
    
        if (!empty($data['tags'])) {
            $tagIds = [];
            foreach ($data['tags'] as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
            $translation->tags()->sync($tagIds);
        }
    
        return response()->json($translation->load('tags'), 201);
    
    }
    
    public function update(Request $request, Translation $translation) {
        $data = $request->validate([
            'content' => 'sometimes|string',
            'tags' => 'array',
            'tags.*' => 'string',
        ]);
    
        if (isset($data['content'])) {
            $translation->update(['content' => $data['content']]);
        }
    
        if (!empty($data['tags'])) {
            $tagIds = [];
            foreach ($data['tags'] as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
            $translation->tags()->sync($tagIds);
        }
    
        return response()->json($translation->load('tags'));
    }
    
    public function export($locale) {
        $translations = Translation::where('locale', $locale)
        ->select('key', 'content')
        ->get()
        ->pluck('content', 'key');

        return response()->json($translations);
    }
    
}
