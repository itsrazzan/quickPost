<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContentRequest;
use App\Http\Requests\UpdateContentRequest;
use App\Models\Content;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContentController extends Controller
{
    public function index(Request $request): View
    {
        $drafts = $request->user()
            ->contents()
            ->where('status', 'draft')
            ->latest()
            ->paginate(12);

        $deletedDrafts = $request->user()
            ->contents()
            ->onlyTrashed()
            ->where('status', 'draft')
            ->latest('deleted_at')
            ->get();

        return view('workspace.drafts', [
            'drafts' => $drafts,
            'deletedDrafts' => $deletedDrafts,
        ]);
    }

    public function create(): View
    {
        return view('workspace.drafts-form', ['draft' => new Content]);
    }

    public function store(StoreContentRequest $request): RedirectResponse
    {
        $request->user()->contents()->create([
            ...$request->safe()->only(['title', 'caption']),
            'status' => 'draft',
        ]);

        return to_route('drafts')->with('status', 'Draft saved.');
    }

    public function edit(Request $request, Content $draft): View
    {
        $ownedDraft = $this->findOwnedDraft($request, $draft);

        return view('workspace.drafts-form', ['draft' => $ownedDraft]);
    }

    public function update(UpdateContentRequest $request, Content $draft): RedirectResponse
    {
        $ownedDraft = $this->findOwnedDraft($request, $draft);
        $ownedDraft->update($request->safe()->only(['title', 'caption']));

        return to_route('drafts')->with('status', 'Draft updated.');
    }

    public function destroy(Request $request, Content $draft): RedirectResponse
    {
        $this->findOwnedDraft($request, $draft)->delete();

        return to_route('drafts')->with('status', 'Draft moved to recently deleted.');
    }

    public function restore(Request $request, int $draftId): RedirectResponse
    {
        $request->user()
            ->contents()
            ->onlyTrashed()
            ->where('status', 'draft')
            ->findOrFail($draftId)
            ->restore();

        return to_route('drafts')->with('status', 'Draft restored.');
    }

    private function findOwnedDraft(Request $request, Content $draft): Content
    {
        return $request->user()
            ->contents()
            ->where('status', 'draft')
            ->findOrFail($draft->getKey());
    }
}
