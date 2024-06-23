<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ApiDaerah extends Component
{

    public $provinsiId, $kotaId;

    public function mount($user = null)
    {
        if ($user != null) {
            $this->provinsiId = $user->provinsi;
            $this->kotaId = $user->kota;
        }
    }

    public function provinsi()
    {
        $respon = Http::get("https://dev.farizdotid.com/api/daerahindonesia/provinsi")['provinsi'];
        // dd($respon);
        return $respon;
    }

    public function kota()
    {
        $id = explode('/', $this->provinsiId);
        return HTTP::get("https://dev.farizdotid.com/api/daerahindonesia/kota", ['id_provinsi' => $id[0]])['kota_kabupaten'];
    }


    public function render()
    {
        return view('livewire.api-daerah', [
            'provinsi' => $this->provinsi(),
            'kota' => $this->kota(),
        ]);
    }
}
