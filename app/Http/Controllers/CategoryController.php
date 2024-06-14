<?php

namespace App\Http\Controllers;

use App\Constants\PolicyName;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $this->authorize(PolicyName::VIEW_ANY, Category::class);

        $categories = Category::query()
            ->select(['id', 'name'])
            ->orderBy('name')
            ->get();

        return view('categories.index', compact('categories'));
    }

    public function create(): View
    {
        $this->authorize(PolicyName::CREATE, Category::class);
        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $this->authorize(PolicyName::CREATE, Category::class);
        Category::query()->create($request->all());
        return redirect()->route('categories.index');
    }

    public function show(Category $category): View
    {
        $this->authorize(PolicyName::VIEW, Category::class);
        return view('categories.show', compact('category'));
    }


    public function edit(Category $category): View
    {
        $this->authorize(PolicyName::UPDATE, Category::class);
        return view('categories.create', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $this->authorize(PolicyName::UPDATE, Category::class);
        $category->update([
            'name' => $request->get('name')
        ]);
        return redirect()->route('categories.index');
    }


    public function destroy(Category $category): RedirectResponse
    {
        $this->authorize(PolicyName::DELETE, Category::class);
        $category->delete();
        return redirect()->route('categories.index');
    }
}
