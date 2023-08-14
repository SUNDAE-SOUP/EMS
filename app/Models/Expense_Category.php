<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense_Category extends Model
{
    use HasFactory;

    protected $table = 'expense_categories';

    protected $fillable = [
        'expense_category_name',
        'description',
        'is_active'
    ];

    public function expenses(): HasMany
    {
        return $this->hasMany(Expenses::class);
    }
}
