<?php

namespace App\Livewire;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AdminProfileTabs extends Component
{
    public $tab = null;
    public $tabname = 'personal_details';
    protected $queryString = ['tab'];
    public $name,$username,$email,$admin_id;
    public $current_password, $new_password, $new_password_confirmation;

    public function selectTab($tab){
        $this->tab = $tab;
    }
    public function mount(){
        $this->tab = request()->tab ? request()->tab : $this->tabname;
        if (Auth::guard('admin')->check()){
            $admin = Admin::findOrFail(auth()->id());
        $this->admin_id = $admin->id;
        $this->name = $admin->name;
        $this->email = $admin->email;
        $this->username = $admin->username;

        }
    }
    public function updateAdminProfileDetails(){
        $this->validate([
            'name' => 'required|min:5',
            'email' => 'required|email|unique:admins,email'.$this->admin_id,
            'username' => 'required|email|unique:admins,username'.$this->admin_id,
        ]);
        Admin::find($this->admin_id)
            ->update([
                'name' => $this->name,
                'email' => $this->email,
                'username' => $this->username
            ]);
        $this->emit('updateAdminSellerHeaderInfo');
        $this->dispatchBrowserEvent('updateAdminInfo',[
            'adminName' => $this->name,
            'adminEmail' => $this->email,
        ]);
        $this->showToaster('success','your personal details updated');
    }
    public function showToaster($type,$message){
        return $this->dispatchBrowserEvent('showToaster',[
            'type' => $type,
            'message' => $message
        ]);
    }
    public function updatePassword(){
            $this->validate([
                'current_password'=> [
                    'required', function($attribute,$value, $fail) {
                        if (!Hash::check($value, Admin::find(auth('admin')->id())->password)) {
                            return $fail(__('the current password is incorrect'));
                        }
                    }
                ],
                'new_password' => 'required|min:5|max:45|confirmed'
            ]);
            $query = Admin::findOrFail(auth('admin')->id())->update([
                'password' => Hash::make($this->new_password)
            ]);

        // send notif

            if ($query){
                $_admin = Admin::findOrFail($this->admin_id);
                $data = array(
                    'admin' => $_admin,
                    'new_password' => $this->new_password
                );
                $mail_body = view('email-templates.admin-forgot-email-template',$data)->render();
                $mailConfig = array(
                    'mail_from_email'=> env('EMAIL_FROM_ADDRESS'),
                    'mail_from_name' =>env('EMAIL_FROM_NAME'),
                    'mail_recipient_email'=>$_admin->email,
                    'mail_recipient_name'=>$_admin->name,
                    'mail_subject' => ' password changed',
                    'mail_body' => $mail_body
                );
                sendEmail($mailConfig);

                $this->current_password = $this->new_password = $this->new_password_confirmation= null;
                $this->showToaster('success','password successfully changed');
            }else{
                $this->showToaster('error', 'something went wrong');
            }
    }
    public function render()
    {
        return view('livewire.admin-profile-tabs');
    }
}
