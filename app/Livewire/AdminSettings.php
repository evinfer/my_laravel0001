<?php

namespace App\Livewire;
use Livewire\Component;

use App\Models\GenaralSetting;
use App\Models\SocialNetworks;

use function PHPSTORM_META\type;

class AdminSettings extends Component
{
    public $tab = null;
    public $default_tab = 'general_setings';
    protected $queryString = ['$tab'];
    public $site_name,$site_email,$site_phone,$site_meta_keywords,$site_meta_description;
    public $facebook_url,$twitter_url,$instagram_url,$youtube_url,$github_url,$linkedin_url;

    public function selectTab($tab){
        $this->tab = $tab;
    }

    public function mount(){
        $this->tab = request()->tab ? request()->tab : $this->default_tab;

         //popualte
       $this->site_name = get_settings()->site_name;
       $this->site_email = get_settings()->site_email;
       $this->site_phone = get_settings()->site_phone;
       $this->site_meta_keywords = get_settings()->site_meta_keywords;
       $this->site_meta_description = get_settings()->site_meta_discription;

       //populate social networks
       $this->facebook_url = get_settings()->facebook_url;
       $this->twitter_url = get_settings()->twitter_url;
       $this->instagram_url = get_settings()->instagram_url;
       $this->youtube_url= get_settings()->youtube_url;
       $this->github_url = get_settings()->github_url;
       $this->linkedin_url = get_settings()->linkedin_url;
    }

    public function updateGeneralSettings(){
        $this->validate([
            'site_name' => '',
            'site_email' => 'required|email'
        ]);

         $settings = new GenaralSetting();
         $settings = $settings->first();
         $settings->site_name = $this->site_name;
         $settings->site_email = $this->site_email;
         $settings->site_phone = $this->site_phone;
         $settings->site_meta_keywords = $this->site_meta_keywords;
         $settings->site_meta_discription = $this->site_meta_description;
         $update = $settings->save();

         if ($update) {
            $this->showToastr('success','General settings have been successfully updated');
         }else {
         $this->showToastr('error','Something went wrong');
         }
    }

    public function updateSocialNetworks(){
        $social_network = new SocialNetworks(); 
        $social_network = new $social_network->first(); 
        $social_network->facebook_url = $this->facebook_url;
        $social_network->twitter_url = $this->twitter_url;
        $social_network->instagram_url = $this->instagram_url;
        $social_network->youtube_url = $this->youtube_url;
        $social_network->github_url = $this->github_url;
        $social_network->linkedin_url = $this->linkedin_url;
        $update = $social_network->save();

        if ( $update ) {
            $this->showToastr('success','General settings have been successfully updated');
         }else {
            $this->showToastr('error','Something went wrong','Try again later');
         }
    }

    public function showToastr($type,$message){
        return $this->dispatchBrowserEvent('showToastr',[
              'type' =>$type,
              'message' =>$message
        ]);
    }

    public function render()
    
    {
        return view('livewire.admin-settings');
    }
}
