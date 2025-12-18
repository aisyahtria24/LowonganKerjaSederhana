<?php

namespace App\Http\Controllers;

use App\Models\Pelamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;

class PelamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pelamar::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'LIKE', "%{$search}%")
                  ->orWhere('last_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('posisi_dilamar', 'LIKE', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $pelamars = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.pelamar.index', compact('pelamars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pelamar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'birthday' => 'nullable|date',
            'gender' => 'required|in:Male,Female,Other',
            'email' => 'required|email|unique:pelamar,email',
            'phone' => 'nullable|string|max:20',
            'posisi_dilamar' => 'nullable|string|max:255',
            'cv_file' => 'nullable|file|mimes:pdf|max:2048', // 2MB max
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('cv_file')) {
            $file = $request->file('cv_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $data['cv_file'] = $file->storeAs('cv_files', $filename, 'public');
        }

        Pelamar::create($data);

        return redirect()->route('admin.pelamar.index')->with('success', 'Pelamar berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelamar $pelamar)
    {
        return view('pelamar.show', compact('pelamar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelamar $pelamar)
    {
        return view('admin.pelamar.edit', compact('pelamar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelamar $pelamar)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'birthday' => 'nullable|date',
            'gender' => 'required|in:Male,Female,Other',
            'email' => 'required|email|unique:pelamar,email,' . $pelamar->pelamar_id . ',pelamar_id',
            'phone' => 'nullable|string|max:20',
            'posisi_dilamar' => 'nullable|string|max:255',
            'cv_file' => 'nullable|file|mimes:pdf|max:2048',
            'status' => 'required|in:Pending,Diterima,Ditolak',
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('cv_file')) {
            // Delete old file if exists
            if ($pelamar->cv_file && Storage::disk('public')->exists($pelamar->cv_file)) {
                Storage::disk('public')->delete($pelamar->cv_file);
            }

            $file = $request->file('cv_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $data['cv_file'] = $file->storeAs('cv_files', $filename, 'public');
        }

        $pelamar->update($data);

        return redirect()->route('admin.pelamar.index')->with('success', 'Pelamar berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelamar $pelamar)
    {
        // Delete CV file if exists
        if ($pelamar->cv_file && Storage::disk('public')->exists($pelamar->cv_file)) {
            Storage::disk('public')->delete($pelamar->cv_file);
        }

        $pelamar->delete();

        return redirect()->route('admin.pelamar.index')->with('success', 'Pelamar berhasil dihapus!');
    }

    /**
     * Display staff dashboard with card-style pelamar list
     */
    public function staffDashboard(Request $request)
    {
        $query = Pelamar::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'LIKE', "%{$search}%")
                  ->orWhere('last_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('posisi_dilamar', 'LIKE', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $pelamars = $query->orderBy('created_at', 'desc')->paginate(12);

        return view('staff.dashboard', compact('pelamars'));
    }

    /**
     * Update pelamar status (for staff)
     */
    public function updateStatus(Request $request, Pelamar $pelamar)
    {
        $request->validate([
            'status' => 'required|in:Pending,Diterima,Ditolak',
        ]);

        $pelamar->update(['status' => $request->status]);

        $message = 'Status pelamar berhasil diperbarui menjadi ' . $request->status;

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => $message]);
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Guest apply for job
     */
    public function guestApply()
    {
        return view('pelamar.create');
    }

    /**
     * Store guest application
     */
    public function guestStore(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'birthday' => 'nullable|date',
            'gender' => 'required|in:Male,Female,Other',
            'email' => 'required|email|unique:pelamar,email',
            'phone' => 'nullable|string|max:20',
            'posisi_dilamar' => 'nullable|string|max:255',
            'cv_file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('cv_file')) {
            $file = $request->file('cv_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $data['cv_file'] = $file->storeAs('cv_files', $filename, 'public');
        }

        Pelamar::create($data);

        return redirect()->route('guest.jobs')->with('success', 'Lamaran Anda telah berhasil dikirim!');
    }

    /**
     * Display guest jobs page
     */
    public function guestJobs()
    {
        // For now, just show a simple jobs page
        // In a real application, this would show actual job listings
        return view('guest.jobs');
    }
}
