<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $contacts = Contact::all();

        if($keyword)
        {
            $contacts = Contact::where("name","LIKE","%$keyword%")->get();
        }

        return view('contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validasi utk form tambah contact harus required
        $request->validate([
            'full_name' => 'required|max:30',
            'phone' => 'required',
            'email' => 'required|email:rfc,dns',
            'address' => 'required'
        ]);
        
        $contact = new Contact([
            // 'nama kolom di database' => $request->inputan dari ('nama field dari form'),
            'name' => $request->input('full_name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            ]);
        $contact->save();

        return redirect('/')->with('success','Contact Saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::find($id);
        return view('contact.edit',compact('contact'));
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
        // validasi utk form edit contact harus required
        $request->validate([
            'full_name' => 'required|max:30',
            'phone' => 'required',
            'email' => 'required|email:rfc,dns',
            'address' => 'required'
        ]);
        $contact = Contact::find($id);
        $contact->name = $request->input('full_name');
        $contact->email = $request->input('email');
        $contact->phone = $request->input('phone');
        $contact->address = $request->input('address');
        $contact->save();

        return redirect('/')->with('success','Contact Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        
        return redirect('/')->with('success','Contact Deleted!');
    }
}
