<?php

namespace App\Http\Controllers;

use App\Models\Pelamar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PelamarController extends Controller
{
    // ================= ADMIN =================

    public function index(Request $request)
    {
        $query = Pelamar::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        $pelamars = $query->latest()->paginate(10);
        return view('admin.pelamar.index', compact('pelamars'));
    }

    public function destroy(Pelamar $pelamar)
    {
        if ($pelamar->cv_file && Storage::disk('public')->exists($pelamar->cv_file)) {
            Storage::disk('public')->delete($pelamar->cv_file);
        }

        $pelamar->delete();
        return back()->with('success', 'Pelamar dihapus');
    }

    // ================= GUEST =================

    public function guestApply()
    {
        return view('pelamar.create');
    }

    public function guestStore(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email|unique:pelamar,email',
            'cv_file'    => 'required|mimes:pdf|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('cv_file')) {
            $data['cv_file'] = $request->file('cv_file')
                ->store('cv_files', 'public');
        }

        Pelamar::create($data);

        return redirect()->route('guest.jobs')
            ->with('success', 'CV berhasil dikirim');
    }

    public function guestJobs()
    {
        return view('guest.jobs');
    }

    // ================= STAFF =================

    public function staffDashboard(Request $request)
    {
        $query = \App\Models\Job::with('category')->where('created_by', Auth::id());

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('company', 'like', '%' . $search . '%')
                    ->orWhere('location', 'like', '%' . $search . '%');
            });
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->has('category_id') && !empty($request->category_id)) {
            $query->where('category_id', $request->category_id);
        }

        $jobs = $query->paginate(10);
        $categories = \App\Models\Category::all(); // For filter dropdown

        return view('staff.dashboard', compact('jobs', 'categories'));
    }
}
