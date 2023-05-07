<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{

    public function index(Request $request)
    {
        $clients = Client::where(function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate(25);
        return view('Dashboard.Clients.index', compact('clients'));
    }


    public function create()
    {
        return view('Dashboard.Clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:clients,name',
            'phone' => 'required|unique:clients,phone',
            'address' => 'required',
        ]);
        $client = Client::create($request->all());

        if ($client) {
            session()->flash('success', _('site.added_success'));
        }
        return redirect()->route('dashboard.clients.index');;
    }


    public function edit(Client $client)
    {
        //return $client;
        return view('Dashboard.Clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => ['required', Rule::unique('clients')->ignore($client->id)],
            'phone' => ['required', Rule::unique('clients')->ignore($client->id)],
            'address' => 'required',
        ]);
        $client->update($request->all());

        if ($client) {
            session()->flash('success', _('site.updated_success'));
        }
        return redirect()->route('dashboard.clients.index');;
    }

    public function destroy(Client $client)
    {
        $client->delete();
        session()->flash('success', __('site.deleted_success'));
        return redirect()->route('dashboard.clients.index');
    }
}
