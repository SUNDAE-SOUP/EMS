<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\User;
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
        $userId = auth()->user()->id;

        $expensesByCategory = Expense::selectRaw('expense_category_id, SUM(Amount) as totalAmount')
        ->where('is_active', 1) // Display only active expenses
        ->groupBy('expense_category_id')
        ->with(['expense_category' => function ($query) {
            $query->select('id', 'expense_category_name'); // Select only the id and name columns from the related model
        }])
        ->get();
        
        if ($userId == 1) {
            return view('components/admin/section/admin-dashboard', 
            compact('expensesByCategory'));
        } else {
            return view('components/admin/user-section/user-dashboard',
            compact('expensesByCategory'));
        }
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userExpenses()
    {
        return view('components/admin/user-section/user-expenses');
    }
    
    public function index()
    {
        $expenses = Expense::where('is_active', 1)->get();
        $expenseCategories = Expense_Category::where('is_active', 1)->get();

        return view('components.admin.section.admin-expenses', compact('expenses', 'expenseCategories'));
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
            'expense_category_id' => 'required',
            'amount' => 'required',
            'entry_date' => 'required'
        ]);


        Expense::create([
            'user_id' => auth()->user()->id,
            'expense_category_id' => $request->expense_category_id,
            'amount' => $request->amount,
            'entry_date' => $request->entry_date
        ]);

        return redirect(route('admin.expensesTab'))->with('success', 'Expense successfully added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        $userRoleId = auth()->user()->role_id;
        $expenseLists = Expense::where('is_active', 1)->get();
        $expenseCategories = Expense_Category::where('is_active', 1)->get();

        if ($userRoleId == 1) {
            return view('components.admin.modal.admin-expenses-update', compact('expenseLists', 'expenseCategories', 'expense'));
        }
        

        
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
    public function softDelete(Expense $expense, Request $request)
    {
        if ($expense->is_active ==1) {
            $expense->is_active = 0;
            $expense->save();
        }

        $userRoleId = auth()->user()->role_id;
        if ($userRoleId == 1) {
            return redirect(route('admin.expensesTab'))->with('success', 'Expense successfully deleted');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Expense $expense, Request $request)
    {
        $userRoleId = auth()->user()->role_id;

        $data = $request->validate([
            'expense_category_id' => 'required',
            'amount' => 'required',
            'entry_date' => 'required'
        ]);
        $expense->update($data);

        if ($userRoleId == 1) {
            return redirect(route('admin.expensesTab'))->with('success', 'Expense successfully updated');
        }
        
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
