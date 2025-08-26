<?php

namespace App\Livewire\Seller;

use App\Models\Seller;
use Livewire\Component;

class SellerProfile extends Component
{
    public $tab = null;
    public $tabname = 'personal_details';
    public $name,$email,$username,$phone,$address;
    protected $queryString = ['tab' => ['keep' => true]];

    public function selectTab($tab){
        $this->tab =  $tab;

    }
    public function mount()
    {
        $this->tab = request()->tab ? request()->tab : $this->tabname;
        $seller = Seller::findOrFail(auth('seller')->id());
        $this->name = $seller->name;
        $this->email = $seller->email;
        $this->username = $seller->username;
        $this->phone = $seller->phone;
        $this->address = $seller->address;
    }

    public function updateSellerPersonalDetails(){
        $this->validate([
            'name' => 'required|min:5',
            'username' => 'nullable|min:5|unique:sellers,username,'.auth('seller')->id(),

        ]);
        $seller = Seller::findOrFail(auth('seller')->id());
        $seller->name = $this->name;
        $seller->username = $this->username;
        $seller->address = $this->address;
        $seller->phone = $this->phone;
        $update = $seller->save();
        if($update){
            $this->dispatch('updateAdminSellerHeaderInfo');
            $this->showToaster('success','personal detail has been successfully update');
        }else{
            $this->showToaster('fail','something went wrong');
        }
    }

    public function showToaster($type,$message)
    {
        return $this->dispatch('showToaster',[
            'type' => $type,
            'message' => $message,
        ]);

    }
    public function render()
    {
        return view('livewire.seller.seller-profile');
    }
}
