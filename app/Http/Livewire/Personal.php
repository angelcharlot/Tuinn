<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class Personal extends Component
{
    public $usuarios, $name, $email, $password, $rol, $usuario;
    public $updateMode = false;
    public $personal;
    protected $listeners = ['destroy'];
    protected $messages = [
        'email.required' => 'email obligatorio',
        'email.email' => 'email no valido',
        'name.required' => 'nombre obligatorio',
        'name.min' => 'minimo 5 caracteres',
        'password.required' => 'campo obligatorio',
        'email.unique' => 'El email ya ha sido registrado.',
    ];
    protected $rules = [
        'name' => 'required|min:5',
        'email' => 'required|email|unique:App\Models\User,email',
        'rol' => 'required',
        'password' => 'required',
    ];
    public function destroy(user $user){
        $user->delete();
   }
    public function cancelar(){

        $this->updateMode = false;

    }
    public function render()
    {
        $this->usuario = Auth()->user()->id;
        $this->usuarios = auth()
            ->user()
            ->personal()
            ->get();
        return view('livewire.negocio.personal');
    }
    public function changeEvent($value)
    {
        $this->rol = $value;
    }
    public function store()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'fk_user' => $this->usuario,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ])->assignRole($this->rol);
        $this->emit('alert_guardad');
        $this->resetInput();
    }
    public function edit($id)
    {
        $change = user::findOrFail($id);
        $this->selected_id = $id;
        $this->name = $change->name;
        $this->email = $change->email;
        $this->password = '';
        $this->updateMode = true;
    }
    public function update()
    {
        $this->validate();
        $record = user::find($this->selected_id);
        if (isset($record->getRoleNames()[0])) {
            $record->removeRole($record->getRoleNames()[0]);
        }
        $record->assignRole($this->rol);
        if ($this->selected_id) {
            $record = user::find($this->selected_id);
            $record->update([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);

            $this->resetInput();
            $this->updateMode = false;
        }
        $this->emit('alert_editado');
    }
    private function resetInput()
    {
        $this->name = null;
        $this->email = null;
        $this->password = null;
    }
}
