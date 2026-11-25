<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContentRequest;
use App\Http\Requests\UpdateContentRequest;
use App\Models\Content;
use App\Models\Media;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContentController extends Controller
{
    public function index(Request $request): View
    {
        // Eager load media untuk menghindari N+1 saat menampilkan thumbnail.
        $drafts = $request->user()
            ->contents()
            ->with('media')
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

    public function create(Request $request): View
    {
        return view('workspace.drafts-form', [
            'draft' => new Content,
            'mediaItems' => $this->userMedia($request),
            'selectedMediaIds' => [],
        ]);
    }

    public function store(StoreContentRequest $request): RedirectResponse
    {
        $draft = $request->user()->contents()->create([
            ...$request->safe()->only(['title', 'caption']),
            'status' => 'draft',
        ]);

        // Sinkronkan media terpilih ke pivot content_media.
        $draft->media()->sync($this->mediaSyncData($request));

        return to_route('drafts')->with('status', 'Draft saved.');
    }

    public function edit(Request $request, Content $draft): View
    {
        $ownedDraft = $this->findOwnedDraft($request, $draft);

        return view('workspace.drafts-form', [
            'draft' => $ownedDraft,
            'mediaItems' => $this->userMedia($request),
            'selectedMediaIds' => $ownedDraft->media()->pluck('media.id')->all(),
        ]);
    }

    public function update(UpdateContentRequest $request, Content $draft): RedirectResponse
    {
        $ownedDraft = $this->findOwnedDraft($request, $draft);
        $ownedDraft->update($request->safe()->only(['title', 'caption']));

        // sync() menambah/menghapus lampiran agar sama persis dengan pilihan user.
        $ownedDraft->media()->sync($this->mediaSyncData($request));

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

    /**
     * Media milik user untuk ditampilkan di form draft.
     *
     * @return Collection<int, Media>
     */
    private function userMedia(Request $request): Collection
    {
        return $request->user()->media()->latest()->get();
    }

    /**
     * Ubah daftar ID media menjadi format sync() dengan urutan pivot.
     *
     * @return array<int, array<string, int>>
     */
    private function mediaSyncData(StoreContentRequest $request): array
    {
        return collect($request->validated('media', []))
            ->values()
            ->mapWithKeys(fn (int $mediaId, int $index): array => [$mediaId => ['order' => $index]])
            ->all();
    }
}
