<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSocialAccountRequest;
use App\Models\SocialAccount;
use App\Models\SocialPlatform;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SocialAccountController extends Controller
{
    /**
     * Tampilkan akun sosial terhubung dan platform yang tersedia.
     */
    public function index(Request $request): View
    {
        $accounts = $request->user()
            ->socialAccounts()
            ->with('platform') // eager load untuk mencegah N+1 saat render
            ->latest()
            ->get();

        // Hanya platform aktif yang boleh dipilih untuk koneksi baru.
        $platforms = SocialPlatform::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('workspace.settings-accounts', [
            'accounts' => $accounts,
            'platforms' => $platforms,
        ]);
    }

    /**
     * Simulasikan koneksi akun sosial (mock, tanpa OAuth).
     * is_demo = true menandai ini bukan koneksi sungguhan.
     */
    public function store(StoreSocialAccountRequest $request): RedirectResponse
    {
        $request->user()->socialAccounts()->create([
            ...$request->safe()->only(['social_platform_id', 'account_name', 'username']),
            'status' => 'connected',
            'is_demo' => true,
        ]);

        return to_route('accounts')->with('status', 'Account connected.');
    }

    /**
     * Putuskan koneksi akun (soft delete) dengan validasi kepemilikan.
     */
    public function destroy(Request $request, SocialAccount $account): RedirectResponse
    {
        $request->user()
            ->socialAccounts()
            ->findOrFail($account->getKey())
            ->delete();

        return to_route('accounts')->with('status', 'Account disconnected.');
    }
}
