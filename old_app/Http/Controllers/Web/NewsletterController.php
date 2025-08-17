<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsletterRequest;
use App\Http\Requests\UpdateNewsletterRequest;
use App\Models\Newsletter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNewsletterRequest $request
     * @return RedirectResponse
     */
    public function store(StoreNewsletterRequest $request)
    {
        if ($this->recaptcha($request)) {
            $newsletterObj = Newsletter::create($request->validated());
            return redirect()->back()->with('result', 'You\'re email has submitted successfully.');
        }

        //return new NewsletterMail($request->validated('email'));
        return redirect()->back()->withErrors('newsletter_email', 'You\'re email registration fails.');
    }

    /**
     * Display the specified resource.
     *
     * @param Newsletter $newsletter
     * @return Response
     */
    public function show(Newsletter $newsletter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Newsletter $newsletter
     * @return Response
     */
    public function edit(Newsletter $newsletter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateNewsletterRequest $request
     * @param Newsletter $newsletter
     * @return Response
     */
    public function update(UpdateNewsletterRequest $request, Newsletter $newsletter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Newsletter $newsletter
     * @return Response
     */
    public function destroy(Newsletter $newsletter)
    {
        //
    }
}
