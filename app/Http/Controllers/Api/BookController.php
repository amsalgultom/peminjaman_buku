<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data semua buku
        $books = Book::all();

        if (!$books) {
            return response()->json([
                'message' => 'data tidak ditemukan'
            ], 200);
        } else {
            return response()->json([
                'books' => $books
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'kode'     => 'required|unique:books',
            'judul'   => 'required',
            'tahun_terbit'   => 'required',
            'penulis'   => 'required',
            'stok'   => 'required'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $books = Book::create($request->all());

        // Return Json Response
        return response()->json([
            'books' => $books
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($code)
    {
        // Mengambil data semua buku
        $books = Book::where('kode', $code)->first();

        if (!$books) {
            return response()->json([
                'message' => 'data tidak ditemukan'
            ], 200);
        } else {
            return response()->json([
                'books' => $books
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $code)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'kode'   => 'required',
            'judul'   => 'required',
            'tahun_terbit'   => 'required',
            'stok'   => 'required',
            'penulis'   => 'required'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $book = Book::where('kode', $code)->first();

        if (!$book) {
            return response()->json([
                'message' => 'data tidak ditemukan'
            ], 200);
        }

        $book->kode = $request->kode;
        $book->judul = $request->judul;
        $book->tahun_terbit = $request->tahun_terbit;
        $book->stok = $request->stok;
        $book->save();

        return response()->json([
            'book' => $book
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($code)
    {
        $books = Book::where('kode', $code)->delete();
        if ($books) {
            // Delete successful
            return response()->json(['message' => 'Data buku berhasil dihapus']);
        } else {
            // Delete failed
            return response()->json(['message' => 'Data buku gagal dihapus'], 500);
        }
    }
}
