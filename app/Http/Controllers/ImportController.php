<?php

namespace App\Http\Controllers;

use App\Constants\ImportStatus;
use App\Models\Import;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function index(): View
    {
        $imports = Import::whereBelongsTo(auth()->user())
            ->latest()
            ->paginate();

        return view('imports.index', [
            'imports' => $imports,
        ]);
    }

    public function create(): View
    {
        return view('imports.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $file = $request->file('file');

        $path = $file->store(options: ['disk' => Import::DISK]);

        $import = new Import();
        $import->path = Import::DISK.DIRECTORY_SEPARATOR.$path;
        $import->file_name = $file->getClientOriginalName();
        $import->status = ImportStatus::PENDING;
        $import->user()->associate(auth()->user());
        $import->save();

        return redirect()->route('admin.imports.show', $import);
    }

    public function show(Import $import): View
    {
        $this->authorize('view', $import);

        return view('imports.show', [
            'import' => $import,
        ]);
    }
}
