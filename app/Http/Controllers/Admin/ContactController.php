<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function edit(Contact $contact)
    {
        return view('admin.contacts.edit', compact('contact'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'contact_name' => 'required|string|max:255',
        'contact_number' => 'required|string|max:255',
    ]);

    $contact = Contact::findOrFail($id);
    $contact->update($request->only(['contact_name', 'contact_number']));

    return redirect()->route('admin.contacts.index')
                     ->with('success', 'Contact modificat cu succes');
}

}
