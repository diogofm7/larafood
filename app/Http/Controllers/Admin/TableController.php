<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTable;
use App\Models\Table;
use Facade\Ignition\Tabs\Tab;
use Illuminate\Http\Request;

class TableController extends Controller
{

    /**
     * @var Table
     */
    private $repository;

    public function __construct(Table $table)
    {
        $this->repository = $table;

        $this->middleware(['can:Tables']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = $this->repository->latest()->paginate();

        return view('admin.pages.tables.index', [
            'tables' => $tables
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTable $request)
    {
        $this->repository->create($request->validated());

        return redirect()->route('admin.tables.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Table $table)
    {
        return view('admin.pages.tables.show', [
            'table' => $table
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Table $table)
    {
        return view('admin.pages.tables.edit', [
            'table' => $table
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTable $request, $id)
    {
        $table = $this->repository->findOrFail($id);

        $table->update($request->validated());

        return redirect()->route('admin.tables.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        $table->delete();

        return redirect()->route('admin.tables.index');
    }

    public function search(Request $request)
    {
        $filters = $request->filter;

        $tables = $this->repository->search($filters);

        return view('admin.pages.tables.index', [
            'tables' => $tables,
            'filters' => $filters
        ]);
    }
}
