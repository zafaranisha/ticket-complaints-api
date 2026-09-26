<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    // 1. Menampilkan semua tiket pengaduan
    public function index()
    {
        $tickets = Ticket::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar tiket pengaduan pelanggan',
            'data'    => $tickets
        ], 200);
    }

    // 2. Membuat tiket pengaduan baru
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone_number'  => 'required|string|max:20',
            'category'      => 'required|in:kebocoran,air_mati,tagihan,kualitas_air,lainnya',
            'description'   => 'required|string',
        ]);

        $ticketNumber = 'TCK-' . strtoupper(Str::random(5));

        $ticket = Ticket::create([
            'ticket_number' => $ticketNumber,
            'customer_name' => $request->customer_name,
            'phone_number'  => $request->phone_number,
            'category'      => $request->category,
            'description'   => $request->description,
            'status'        => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengaduan berhasil dikirim!',
            'data'    => $ticket
        ], 201);
    }

    // 3. Menampilkan detail 1 tiket berdasarkan ID
    public function show(string $id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Tiket tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail tiket pengaduan',
            'data'    => $ticket
        ], 200);
    }

    // 4. Mengubah status tiket (misal dari 'pending' ke 'diproses' / 'selesai')
    public function update(Request $request, string $id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Tiket tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'status' => 'required|in:pending,diproses,selesai,ditolak',
        ]);

        $ticket->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status tiket berhasil diperbarui!',
            'data'    => $ticket
        ], 200);
    }

    // 5. Menghapus tiket
    public function destroy(string $id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Tiket tidak ditemukan'
            ], 404);
        }

        $ticket->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tiket berhasil dihapus!'
        ], 200);
    }
}