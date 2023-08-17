<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense_Category;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenseCategories = Expense_Category::where('is_active', 1)->get();

        return view('components.admin.section.admin-expenseCategories', compact('expenseCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'expense_category_name' => 'required',
            'description' => 'required'
        ]);


        Expense_Category::create([
            'expense_category_name' => $request->expense_category_name,
            'description' => $request->description,
        ]);

        return redirect(route('admin.expenseCatTab'))->with('success', 'Expense Category successfully added');
    }

    public function edit(Expense_Category $expenseCategory)
    {
    
        $updateExpenseCategories = Expense_Category::where('is_active', 1)->get();

        return view('components.admin.modal.admin-expense-category-update', compact('updateExpenseCategories', 'expenseCategory'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Expense_Category::where('id', $id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function softDelete(Expense_Category $expenseCategory, Request $request)
    {
        $expenseCategory->update([ 
            'is_active' => 0
        ]);
        return redirect(route('admin.expenseCatTab'))->with('success', 'Expense Category successfully deleted');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Expense_Category $expenseCategory, Request $request)
    {
        $data = $request->validate([
           'expense_category_name' => 'required',
           'description' => 'required' 
        ]);

        $expenseCategory->update($data);

        return redirect(route('admin.expenseCatTab'))->with('success', 'Expense Category is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Expense_Category::where('id', $id)
        ->delete();
    }
}
