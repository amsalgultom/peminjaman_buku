<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
  

  
Auth::routes();


Route::get('/', function () {
    return view('home');
});
  
/*------------------------------------------
--------------------------------------------
All Normal Anggota Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:anggota'])->group(function () {
    Route::get('/member/dashboard', [HomeController::class, 'index'])->name('member.dashboard');
    
    Route::get('/member/loans/', [LoanController::class,'index'])->name('loans.index');
    Route::put('/member/loans/update/{user}', [LoanController::class,'update'])->name('loans.update');
    Route::get('/member/loans/create', [LoanController::class,'create'])->name('loans.create');
    Route::post('/member/loans/store', [LoanController::class,'store'])->name('loans.store');
    Route::get('/member/loans/edit/{user}', [LoanController::class,'edit']);
    Route::get('/member/loans/show/{user}', [LoanController::class,'show']);
    Route::post('/member/loans/delete', [LoanController::class,'destroy']);
    Route::get('/member/loans/data/{user}', [LoanController::class, 'getloans'])->name('loans.data');
});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    
    Route::get('/admin/dashboard', [BookController::class,'dashboard'])->name('admin.dashboard');
    
    Route::get('/admin/books', [BookController::class,'index'])->name('books.index');
    Route::put('/admin/books/update/{book}', [BookController::class,'update'])->name('books.update');
    Route::post('/admin/books/store', [BookController::class,'store'])->name('books.store');
    Route::get('/admin/books/create', [BookController::class,'create'])->name('books.create');
    Route::get('/admin/books/edit/{buku}', [BookController::class,'edit']);
    Route::get('/admin/books/show/{buku}', [BookController::class,'show']);
    Route::post('/admin/book/delete', [BookController::class,'destroy']);
    Route::get('/book/data', [BookController::class, 'getBook'])->name('book.data');

    Route::get('/admin/members', [MemberController::class,'index'])->name('members.index');
    Route::put('/admin/members/update/{user}', [MemberController::class,'update'])->name('members.update');
    Route::get('/admin/members/create', [MemberController::class,'create'])->name('members.create');
    Route::post('/admin/members/store', [MemberController::class,'store'])->name('members.store');
    Route::get('/admin/members/edit/{user}', [MemberController::class,'edit']);
    Route::get('/admin/members/show/{user}', [MemberController::class,'show']);
    Route::post('/admin/members/delete', [MemberController::class,'destroy']);
    Route::get('admin/members/data', [MemberController::class, 'getmembers'])->name('members.data');

    
    Route::get('/admin/request-loan', [LoanController::class, 'requestloan'])->name('requestloan.data');
    Route::get('/admin/request-loan/data', [LoanController::class, 'getrequestloan'])->name('getrequestloan.data');
    Route::post('/admin/request-loan/approve', [LoanController::class,'approve'])->name('getrequestloan.approve');
    Route::post('/admin/request-loan/reject', [LoanController::class,'reject'])->name('getrequestloan.reject');
    Route::get('/admin/return-loan', [LoanController::class, 'returnloan'])->name('requestloan.data');
    Route::get('/admin/return-loan/data', [LoanController::class, 'getreturnloan'])->name('getreturnloan.data');
    Route::post('/admin/return-loan/return', [LoanController::class,'return'])->name('getreturnloan.return');

});