<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->paginate(10);

        return view('news.index', compact('news'));
    }

    public function listNews()
    {
        $news = News::orderBy('created_at', 'desc')->paginate(10);
        
        return view('news.admin', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'title' => 'required',
            'body' => 'required',
            'category' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        
        if ($validator->fails())
        {
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        } else
        {
            $news = new News;
            $news->title = $request->title;
            $news->body = $request->body;
            $news->category = $request->category;
            $news->author = $request->author;
            $news->keywords = $request->keywords;
            $news->save();

            $request->session()->flash('message', 'Notícia cadastrada com sucesso!');
            $request->session()->flash('message-type', 'success');

            return response()->json(json_encode($news));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);
        
        return view('news.show')->with('news', $news);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $edit = News::find($id)->update($request->all());
        
        $request->session()->flash('message', 'Notícia atualizada com sucesso!');
        $request->session()->flash('message-type', 'success');

        return response()->json(json_encode($edit));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        News::find($id)->delete();

        $request->session()->flash('message', 'Notícia excluída com sucesso!');
        $request->session()->flash('message-type', 'success');

        return response()->json();
    }
}
