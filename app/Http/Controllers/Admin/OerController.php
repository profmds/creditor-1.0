<?php

namespace App\Http\Controllers\Admin;

use App\Oer;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OerController extends Controller
{
    public function index(){
        $this->authorize('view', User::class);
        $oers = Oer::all();
        return view('admin.teachers.oers.index', compact('oers'));
    }

    public function view($uri){
        $this->authorize('view', User::class);

        return view('xapi.viewer', compact('uri'));
    }

    public function new(){
        $this->authorize('create', User::class);

        $users = User::all(['id', 'name']);
        return view('admin.teachers.oers.store', compact('users'));
    }

    public function store(Request $request){
        $this->authorize('create', User::class);

        $oerData = $request->all();

        //$request->validated();

        $oer = new Oer();
        $oer->create($oerData);

        flash('REA cadastrado com sucesso')->success();

        return redirect()->route('oer.index');
    }

    public function delete($id){
        $this->authorize('delete', User::class);

        $oer = Oer::findOrFail($id);
        $oer->delete();

        flash('Rea removido com sucesso')->success();

        return redirect()->route('oer.index');
    }

    public function edit(Oer $oer){
        $this->authorize('update', User::class);

        $users = User::all(['id', 'name']);
        return view('admin.teachers.oers.edit', compact('oer','users'));
    }

    public function update(Request $request, $id){
        $this->authorize('update', User::class);

        $oerData = $request->all();

        //$request->validated();

        $oer = Oer::findOrFail($id);
        $oer->update($oerData);

        flash('REA atualizado com sucesso')->success();

        return redirect()->route('oer.edit',['oer' => $id]);
    }
}
