<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Symfony\Contracts\Service\Attribute\Required;

class AdminProfileTabs extends Component
{
    public $tab = null;
    public $tabname = 'personal_details';
    protected $queryString = ['tab'];
    public $name, $email, $username, $admin_id;
    public $current_password,$new_password,$new_password_confirmation;

    public function selectTab($tab)
    {
        $this->tab = $tab;
    }

    public function mount()
    {
        $this->tab = request()->tab ? request()->tab : $this->tabname;

        if (Auth::guard('admin')->check()) {
            $admin = Admin::findOrFail(auth()->id());
            $this->admin_id = $admin->id;
            $this->name = $admin->name;
            $this->email = $admin->email;
            $this->username = $admin->username;
        }
    }

    public function updateAdminPersonalDetails()
    {
        $this->validate([
            'name' => 'required|min:5',
            'email' => [
                'required',
                'email',
                Rule::unique('admins', 'email')->ignore($this->admin_id),
            ],
            'username' => [
                'required',
                'min:3',
                Rule::unique('admins', 'username')->ignore($this->admin_id),
            ],
        ]);

        Admin::find($this->admin_id)->update([
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
        ]);

        $this->showToastr('success', 'Your personal details have been successfully updated....');
    }

    public function updatePassword(){
        $this->validate([
            'current_password'=>[
                'required', function($attribute,$value, $fail){
                    if (!Hash::check($value, Admin::find(auth('admin')->id())->password)) {
                        return $fail(('The current password is incorrect'));
                    }

                }
            ],
            'new_password'=>'required|min:5|max:45|confirmed'
        ]);
        $query = Admin::findOrFail(auth('admin')->id())->update([
                'password'=>Hash::make($this->new_password)
        ]);
        if ($query) {
            //send notification email
            $admin = Admin::findOrFail($this->admin_id);
            $data = array(
                'admin'=>$admin,
                'new_password'=>$this->new_password
            );

            $mail_body = view('email-template.admin-reset-email-template', $data)->render();

            $mailConfig = array(
               'mail_from_email'=>env('EMAIL_FROM_ADDRESS'),
               'mail_from_name'=>env('EMAIL_FROM_NAME'),
               'mail_recipient_email'=>$admin->email,
               'mail_recipient_name'=>$admin->name,
               'mail_subject'=>'password changed',
               'mail_body'=>$mail_body
            );

            sendEmail($mailConfig);
            $this->current_password = $this->new_password = $ths->new_password_comfirmation = null;
            $this->showToastr('success','Password successfully changed...');
        }else {
            $this->showToastr('error','Something went wrong');
        }
    }

    public function showToastr($type, $message)
    {
        $this->emit('showToastr', [
            'type' => $type,
            'message' => $message,
        ]);

        $this->emit('updateAdminSellerHeaderInfo');
        $this->dispatchBrowserEvent('updateAdminInfo', [
            'adminname' => $this->name,
            'adminemail' => $this->email,
        ]);
    }

    public function render()
    {
        return view('livewire.admin-profile-tabs');
    }
}
