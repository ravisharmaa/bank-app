<?php

namespace App\Http\Controllers;

use League\Csv\Reader;
use Symfony\Component\HttpKernel\Exception\UnsupportedMediaTypeHttpException;

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

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        array_map(function ($file) {
            if ('csv' === $file->getClientOriginalExtension()) {
                foreach (Reader::createFromFileObject($file->openFile())->setHeaderOffset(0) as $index => $row) {
                    return Demo::create($row);
                }
            }
            throw new UnsupportedMediaTypeHttpException('Cannot process with your request');
        }, request()->file());

        return redirect('/');
    }
}
