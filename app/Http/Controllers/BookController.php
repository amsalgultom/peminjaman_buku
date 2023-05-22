<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.books.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $years = range(1900, strftime("%Y", time()));
        return view('admin.books.create', compact('years'));
    }

    public function getBook()
    {
        
        $books = Book::all();
        return DataTables::of($books)->toJson();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:books',
            'judul' => 'required',
            'tahun_terbit' => 'required',
            'penulis' => 'required',
            'stok' => 'required'
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $buku)
    {
        return view('admin.books.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $buku)
    {
        $years = range(1900, strftime("%Y", time()));
        return view('admin.books.edit', compact('buku', 'years'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'kode' => 'required|unique:books',
            'judul' => 'required',
            'tahun_terbit' => 'required',
            'penulis' => 'required',
            'stok' => 'required'
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')->with('success', 'buku updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $com = Book::where('id', $request->id)->delete();
        return Response()->json($com);
    }
}
