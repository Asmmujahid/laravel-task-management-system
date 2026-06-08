<?php

namespace App\Http\Controllers\TeamLead;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('team_lead.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('team_lead.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return redirect()
            ->route('team_lead.categories.index')
            ->with('success', 'Category added successfully.');
    }

    // ✅ EDIT PAGE
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('team_lead.categories.edit', compact('category'));
    }

    // ✅ UPDATE CATEGORY
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $id,
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name
        ]);

        return redirect()
            ->route('team_lead.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    // ✅ DELETE
    public function destroy($id)
    {
        Category::destroy($id);

        return back()->with('success', 'Category deleted successfully.');
    }
}