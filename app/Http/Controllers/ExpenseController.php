<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Expense_Category;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {

        $expensesTable = Expense::all();

        $expensesByCategory = Expense::selectRaw('expense_category_id, SUM(Amount) as totalAmount')
        ->groupBy('expense_category_id')
        ->with(['expense_category' => function ($query) {
            $query->select('id', 'expense_category_name'); // Select only the id and name columns from the related model
        }])
        ->get();




        return view('components/admin/section/admin-dashboard', compact('expensesByCategory', 'expensesTable'));
    }
    
    public function index()
    {
        return Expense::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = app('App\Http\Controller\ExpenseCategoryController')->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'expense_category_id' => ['required', Rule::exists('expense_catgories', 'id')],
            'amount' => 'required',
            'entry_date' => 'required'
        ]);


        return Expense::create([
            'user_id' => auth()->user()->id,
            'expense_category_id' => $request->expense_category_id,
            'amount' => $request->amount,
            'entry_date' => $request->entry_date
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        return Expense::where('user_id', $user_id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function softDelete($id)
    {
        return Expense::where('id', $id)
        ->update([
            
            'is_active' => 0
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $_id)
    {
        return Expense::where('id', $id)
        ->update([
            'expense_category_id' => $request->expense_category_id,
            'amount' => $request->amount,
            'entry_date' => $request->entry_date
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    
    // to get the total sum per expense category in the expenses table
    public function getTotalAmountSumByCategory($category_id)
    {
        
        
        return view('component/admin/section/admin-dashboard', compact('expensesByCategory'));
    }

    
}
