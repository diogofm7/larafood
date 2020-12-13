<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTenant;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TenantController extends Controller
{
    /**
     * @var Tenant
     */
    private $repository;

    public function __construct(Tenant $tenant)
    {
        $this->repository = $tenant;

        $this->middleware(['can:Tenants']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = $this->repository->latest()->paginate();

        return view('admin.pages.tenants.index', [
            'tenants' => $tenants
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tenant $tenant)
    {
        return view('admin.pages.tenants.show', [
            'tenant' => $tenant
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tenant $tenant)
    {
        return view('admin.pages.tenants.edit', [
            'tenant' => $tenant
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTenant $request, $id)
    {
        $tenant = $this->repository->findOrFail($id);

        $data = $request->validated();

        if ($request->hasFile('logo') && $request->logo->isValid()) {

            if (Storage::exists($tenant->logo))
                Storage::delete($tenant->logo);

            $data['logo'] = $request->logo->store('tenants/'.$tenant->uuid);
        }

        $tenant->update($data);

        return redirect()->route('admin.tenants.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tenant $tenant)
    {
        if (Storage::exists($tenant->logo))
            Storage::delete($tenant->logo);

        $tenant->delete();

        return redirect()->route('admin.tenants.index');
    }

    public function search(Request $request)
    {
        $filters = $request->filter;

        $tenants = $this->repository->search($filters);

        return view('admin.pages.tenants.index', [
            'tenants' => $tenants,
            'filters' => $filters
        ]);
    }
}
