<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;





class Personal extends Component
{




    public $usuarios,$name,$email,$password,$rol,$usuario;
    public $updateMode = false;   
    public $personal;

    protected $messages = [

        'email.required' => 'email obligatorio',
        'email.email' => 'email no valido',
        'name.required' => 'nombre obligatorio',
        'name.min' => 'minimo 5 caracteres',
        'password.required' => 'campo obligatorio',
        'email.unique'=>'El email ya ha sido registrado.'

    ];



    public function render()
    {
       

        $this->usuario=Auth()->user()->id;
        $this->usuarios=auth()->user()->personal()->get();
        return view('livewire.negocio.personal');
    }
        public function destroy($id)
    {
        if ($id) {
            $user_delete = user::where('id', $id);
            $user_delete->delete();
        }
    }
    public function changeEvent($value)

    {

        $this->rol = $value;

    }

     public function store()
     {
            



           
           $this->validate([
                'name' => 'required|min:5',
                'email' => 'required|email|unique:App\Models\User,email',
                'rol'=> 'required',
                'password'=> 'required'
            ]);      
              

            
            User::create([
            'name' => $this->name,
            'fk_user'=>$this->usuario,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            ])->assignRole($this->rol);

            $this->resetInput();

      
    }  
        public function edit($id)
        {
            $change = user::findOrFail($id);        
            $this->selected_id = $id;
            $this->name = $change->name;
            $this->email = $change->email;
            $this->password="";
            $this->updateMode = true;
        }  
                public function update()
        {
            $this->validate([
                'selected_id' => 'required|numeric',
                'name' => 'required|min:5',
                'email' => 'required|email:rfc,dns',
                'password'=> 'required'
            ]);        


            $record = user::find($this->selected_id);
            if(isset($record->getRoleNames()[0])){
               $record->removeRole($record->getRoleNames()[0]); 
            }
            $record->assignRole($this->rol);
            if ($this->selected_id) {
                $record = user::find($this->selected_id);
                $record->update([
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' => Hash::make($this->password)
                ]);

                $this->resetInput();
                $this->updateMode = false;
            }    }  

            private function resetInput()
        {
            $this->name = null;
            $this->email = null;
            $this->password=null;

        }  



}
