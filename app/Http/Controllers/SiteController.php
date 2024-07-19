<?php

namespace App\Http\Controllers;

use App\Actions\Sites\DeleteAction;
use App\Actions\Sites\StoreAction;
use App\Constants\DocumentTypes;
use App\Http\Requests\StoreSiteRequest;
use App\Models\Category;
use App\Models\Site;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(): View
    {
        $sites = Site::query()
            ->select(['id', 'slug', 'name', 'category_id'])
            ->with('category:id,name')
            ->orderBy('name')
            ->get();

        return view('sites.index', compact('sites'));
    }

    public function create(): View
    {
        $categories = Category::query()->select(['id', 'name'])->get();
        $documentTypes = DocumentTypes::cases();

        return view('sites.create', compact('categories', 'documentTypes'));
    }

    public function store(StoreSiteRequest $request, StoreAction $storeAction): RedirectResponse
    {
        $storeAction->execute($request->validated());

        return redirect()->route('sites.index');
    }

    public function edit(Site $site): View
    {
        $categories = Category::query()->select(['id', 'name'])->get();
        $documentTypes = DocumentTypes::cases();
        return view('sites.create', compact('categories','site', 'documentTypes'));
    }

    public function update(Request $request, Site $site): RedirectResponse
    {
        $site->update([
            'category_id' => $request->get('category_id'),
            'slug' => $request->get('slug'),
            'name' => $request->get('name'),
            'document_type' => $request->get('document_type'),
            'document' => $request->get('document'),
        ]);
        return redirect()->route('sites.index');
    }

    public function show(Site $site): View
    {
        return view('sites.show', compact('site'));
    }

    public function destroy(Site $site, DeleteAction $deleteAction): RedirectResponse
    {
        $deleteAction->execute($site);

        return redirect()->route('sites.index');
    }
}
