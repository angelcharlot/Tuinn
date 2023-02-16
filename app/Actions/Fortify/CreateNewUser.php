<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\negocio;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

        $negocio= new negocio();
        $negocio->save();
        $confi=new config();
        $confi->negocio_id=$negocio->id;
        $confi->save();
        QrCode::size(200)->style('round')->format('svg')->generate('https://www.tuinn.es/menu/'.$negocio->id, Storage::path('qr/'.$negocio->id.'.svg'));
        QrCode::size(200)->style('round')->format('png')->generate('https://www.tuinn.es/menu/'.$negocio->id, Storage::path('qr/'.$negocio->id.'.png'));
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'id_negocio' =>$negocio->id,

        ])->assignRole('admin');
    }
}
