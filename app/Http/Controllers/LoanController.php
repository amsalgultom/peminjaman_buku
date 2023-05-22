<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('member.loans.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function getloans($user)
    {   
        $loans = Loan::where('user_id', $user)->with('book','user');
        return DataTables::of($loans)->toJson();
    }

    /**
     * Display a listing of the resource.
     */
    public function requestloan()
    {
        return view('admin.loans.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function getrequestloan()
    {   
        $loans = Loan::where('status', 'Request Loan')->with('book','user');
        return DataTables::of($loans)->toJson();
    }

    /**
     * Display a listing of the resource.
     */
    public function returnloan()
    {
        return view('admin.loans.return');
    }

    /**
     * Display a listing of the resource.
     */
    public function getreturnloan()
    {   
        $loans = Loan::where('status', 'Approve')->with('book','user');
        return DataTables::of($loans)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $books = Book::all();
        return view('member.loans.create',compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required',
            'user_id' => 'required',
            'loan_date' => 'required',
            'return_date' => 'required',
            'status' => 'required'
        ]);

        $book = Book::where('id', $request->book_id)->first();
        if($book){
            $stok = $book->stok;
            if($stok < 1){
                return redirect()->route('loans.index')->with('failed', 'Loan Failed, Book Stock not available.');
            }
        }
        Loan::create($request->all());

        return redirect()->route('loans.index')->with('success', 'Loan Book created successfully.');
    }

    /**
     * Approve request loan book
     */
    public function approve(Request $request)
    {
        $approve = Loan::where('id', $request->id)->first();
        if ($approve) {
            $approve->status = 'Approve';
            $approve->save();
        }
        $book_id = $approve->book_id;
        $book = Book::where('id', $book_id)->first();
        if ($book) {
            $book->stok -= 1;
            $book->save();
        }
        return Response()->json($book);
    }

    /**
     * Approve request loan book
     */
    public function return(Request $request)
    {
        $return = Loan::where('id', $request->id)->first();
        if ($return) {
            $return->status = 'Return';
            $return->save();
        }
        $book_id = $return->book_id;
        $book = Book::where('id', $book_id)->first();
        if ($book) {
            $book->stok += 1;
            $book->save();
        }
        return Response()->json($book);
    }

    /**
     * Reject request loan book
     */
    public function reject(Request $request)
    {
        $reject = Loan::where('id', $request->id)->first();
        if ($reject) {
            $reject->status = 'Reject';
            $reject->save();
        }
        return Response()->json($reject);
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        //
    }
}
