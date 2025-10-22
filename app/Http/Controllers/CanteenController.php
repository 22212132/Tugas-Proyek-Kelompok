<?php

namespace App\Http\Controllers;

use App\Models\Canteen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CanteenController extends Controller
{
    public function index(Request $request)
    {
        $query = Canteen::query();

        if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    $canteens = $query->get();

    return view('canteens.index', compact('canteens'));
    }

    public function create()
    {
        return view('canteens.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('name', 'description');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('canteens', 'public');
        }

        Canteen::create($data);

        return redirect()->route('canteens.index')->with('success', 'Kantin berhasil ditambahkan!');
    }

    public function edit(Canteen $canteen)
    {
        return view('canteens.edit', compact('canteen'));
    }

    public function update(Request $request, Canteen $canteen)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('name', 'description');

        if ($request->hasFile('image')) {
            if ($canteen->image) {
                Storage::disk('public')->delete($canteen->image);
            }
            $data['image'] = $request->file('image')->store('canteens', 'public');
        }

        $canteen->update($data);

        return redirect()->route('canteens.index')->with('success', 'Kantin berhasil diperbarui!');
    }

    public function destroy(Canteen $canteen)
    {
        if ($canteen->image) {
            Storage::disk('public')->delete($canteen->image);
        }

        $canteen->delete();

        return redirect()->route('canteens.index')->with('success', 'Kantin berhasil dihapus!');
    }
}