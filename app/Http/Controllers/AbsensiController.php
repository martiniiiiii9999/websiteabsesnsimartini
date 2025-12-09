<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AbsensiController extends Controller
{
    /**
     * Display the attendance form.
     */
    public function index()
    {
        return view('absensi.form');
    }

    /**
     * Display the attendance list.
     */
    public function daftar(Request $request)
    {
        $query = Absensi::query();

        // Filter by date if provided
        if ($request->has('tanggal') && $request->tanggal) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // Filter by status if provided
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Filter by nama if provided
        if ($request->has('nama') && $request->nama) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        $absensis = $query->orderBy('tanggal', 'desc')
                         ->orderBy('waktu_masuk', 'desc')
                         ->paginate(10);

        return view('absensi.daftar', compact('absensis'));
    }

    /**
     * Store a newly created attendance record.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'nip' => 'nullable|string|max:50',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i|after:waktu_masuk',
            'status' => 'required|in:hadir,izin,sakit,alfa',
            'keterangan' => 'nullable|string|max:500',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'status.required' => 'Status wajib dipilih.',
            'waktu_keluar.after' => 'Waktu keluar harus setelah waktu masuk.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('absensi.index')
                           ->withErrors($validator)
                           ->withInput();
        }

        Absensi::create($request->all());

        return redirect()->route('absensi.daftar')
                        ->with('success', 'Data absensi berhasil disimpan!');
    }

    /**
     * Update attendance record.
     */
    public function update(Request $request, $id)
    {
        $absensi = Absensi::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'nip' => 'nullable|string|max:50',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i|after:waktu_masuk',
            'status' => 'required|in:hadir,izin,sakit,alfa',
            'keterangan' => 'nullable|string|max:500',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
            'waktu_keluar.after' => 'Waktu keluar harus setelah waktu masuk.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('absensi.daftar')
                           ->withErrors($validator);
        }

        $absensi->update($request->all());

        return redirect()->route('absensi.daftar')
                        ->with('success', 'Data absensi berhasil diperbarui!');
    }

    /**
     * Delete attendance record.
     */
    public function destroy($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();

        return redirect()->route('absensi.daftar')
                        ->with('success', 'Data absensi berhasil dihapus!');
    }
}
