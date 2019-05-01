<?php

namespace App\Http\Controllers;

use League\Csv\Reader;

class ImportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('imports.index');
    }

    public function store()
    {
        $csvData = array_map(function ($file) {
            if ('csv' === $file->getClientOriginalExtension()) {
                return Reader::createFromFileObject($file->openFile())->setHeaderOffset(0);
            }

            return false;
        }, request()->file());

        foreach ($csvData as $index => $row) {
            dump($row[1]);
        }
    }
}
