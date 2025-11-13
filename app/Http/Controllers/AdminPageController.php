<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of pages.
     */
    public function index()
    {
        $pages = Page::with('menu')->orderBy('created_at', 'desc')->get();
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for editing a page.
     */
    public function edit($id)
    {
        $page = Page::with('menu')->findOrFail($id);
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified page.
     */
    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'banner' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'is_active' => 'boolean'
        ]);

        $data = $request->except('banner');
        $data['is_active'] = $request->has('is_active') ? true : false;

        // Handle banner upload
        if ($request->hasFile('banner')) {
            // Delete old banner if exists
            if ($page->banner && Storage::disk('public')->exists($page->banner)) {
                Storage::disk('public')->delete($page->banner);
            }

            $banner = $request->file('banner');
            $filename = time() . '_' . $banner->getClientOriginalName();
            $path = $banner->storeAs('banners', $filename, 'public');
            $data['banner'] = $path;
        }

        $page->update($data);

        return redirect()->route('pages.edit', $page->id)
            ->with('success', 'Halaman berhasil diperbarui!');
    }

    /**
     * Toggle the active status of a page.
     */
    public function toggleStatus(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $page->is_active = !$page->is_active;
        $page->save();

        return response()->json([
            'success' => true,
            'is_active' => $page->is_active,
            'message' => 'Status halaman berhasil diubah!'
        ]);
    }

    /**
     * Remove the specified page.
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);

        // Delete banner if exists
        if ($page->banner && Storage::disk('public')->exists($page->banner)) {
            Storage::disk('public')->delete($page->banner);
        }

        $page->delete();

        return redirect()->route('pages.index')
            ->with('success', 'Halaman berhasil dihapus!');
    }

    /**
     * Create a new page from menu via AJAX.
     */
    public function createFromMenu(Request $request)
    {
        $validated = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255'
        ]);

        $page = Page::create([
            'menu_id' => $request->menu_id,
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => '<p>Konten untuk halaman ' . $request->title . '</p>',
            'is_active' => true
        ]);

        return response()->json([
            'success' => true,
            'page_id' => $page->id,
            'message' => 'Halaman berhasil dibuat!'
        ]);
    }

    /**
     * Upload image for content editor.
     */
    public function uploadImage(Request $request)
    {
        try {
            $request->validate([
                'upload' => 'required|image|mimes:jpeg,jpg,png,gif,webp,bmp|max:5120'
            ]);

            if ($request->hasFile('upload')) {
                $image = $request->file('upload');
                $filename = time() . '_' . str_replace(' ', '_', $image->getClientOriginalName());
                $path = $image->storeAs('content-images', $filename, 'public');
                
                $url = asset('storage/' . $path);
                
                // Return URL for Summernote
                return response()->json([
                    'url' => $url
                ]);
            }

            return response()->json([
                'error' => 'File tidak ditemukan'
            ], 400);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete banner from page.
     */
    public function deleteBanner($id)
    {
        $page = Page::findOrFail($id);

        if ($page->banner && Storage::disk('public')->exists($page->banner)) {
            Storage::disk('public')->delete($page->banner);
            $page->banner = null;
            $page->save();

            return response()->json([
                'success' => true,
                'message' => 'Banner berhasil dihapus!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Banner tidak ditemukan!'
        ], 404);
    }
}

