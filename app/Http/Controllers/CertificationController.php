<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CertificationRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $certifications = Certification::paginate(10);

        return view('certification.index', compact('certifications'))
            ->with('i', ($request->input('page', 1) - 1) * $certifications->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $certification = new Certification();

        return view('certification.create', compact('certification'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CertificationRequest $request): RedirectResponse
    {
        Certification::create($request->validated());

        return Redirect::route('certifications.index')
            ->with('success', 'Certification created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $certification = Certification::find($id);

        return view('certification.show', compact('certification'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $certification = Certification::find($id);

        return view('certification.edit', compact('certification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CertificationRequest $request, Certification $certification): RedirectResponse
    {
        $certification->update($request->validated());

        return Redirect::route('certifications.index')
            ->with('success', 'Certification updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Certification::find($id)->delete();

        return Redirect::route('certifications.index')
            ->with('success', 'Certification deleted successfully');
    }
}
