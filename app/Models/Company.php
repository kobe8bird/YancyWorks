<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'logo'
    ];


    /**
     * Get the Employees record associated with the Companie.
     */
    public function employees()
    {
        return $this->hasMany('App\Models\Employees', 'company_id', 'id');
    }



}
