<?php

namespace App\Http\Controllers;

use App\DataTables\ContactDataTable;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(ContactDataTable $dataTable)
    {
        return $dataTable->render('admin.contact');
    }
}
