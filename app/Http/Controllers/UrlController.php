<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlRequest;
use App\Url;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return auth()->user()->urls()->paginate(2);
        // return Url::where('user_id', auth()->id())->latest()->get();
    }

  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UrlRequest $request)
    {

      
      $url=  auth()->user()->urls()->create($request->all());
        return response($url, Response::HTTP_CREATED);
        // $url = new Url();
        // $url->original_url = $request->original_url;
        // $url->shorten_url = $request->shorten_url;
        // $url->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function show(Url $url)
    {
        $url->increment('visits');
       return redirect($url->original_url);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Url $url)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function destroy(Url $url)
    {
        $url->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }
}
