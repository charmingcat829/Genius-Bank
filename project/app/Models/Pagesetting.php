<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagesetting extends Model
{
    protected $fillable = [
        'contact_success',
        'contact_email',
        'contact_title',
        'contact_text',
        'street',
        'phone',
        'fax',
        'email',
        'site',
        'side_title',
        'side_text',
        'slider',
        'service',
        'featured',
        'small_banner',
        'best',
        'top_rated',
        'large_banner',
        'big','hot_sale',
        'review_blog',
        'pricing_plan',
        'video_subtitle',
        'video_title',
        'video_text',
        'video_link',
        'video_image',
        'video_background',
        'service_subtitle',
        'service_title',
        'service_text',
        'plan_title',
        'plan_subtitle',
        'portfolio_subtitle',
        'portfolio_title',
        'portfolio_text',
        'p_subtitle',
        'p_title',
        'p_text',
        'team_subtitle',
        'team_title',
        'team_text',
        'review_subtitle',
        'review_title',
        'review_text',
        'blog_subtitle',
        'blog_title',
        'blog_text',
        'faq_title',
        'faq_subtitle',
        'banner_title',
        'banner_text',
        'banner_link1',
        'banner_link2',
        'about_photo',
        'about_title',
        'about_attributes',
        'about_text',
        'about_details',
        'about_link',
        'service_photo',
        'service_video',
        'footer_top_photo',
        'footer_top_title',
        'footer_top_text',
        'hero_title',
        'hero_subtitle',
        'hero_btn_url',
        'hero_link',
        'hero_photo',
        'quick_title',
        'quick_subtitle',
        'quick_link',
        'quick_photo',
        'quick_background',
        'app_banner',
        'app_title',
        'app_details',
        'app_store_photo',
        'app_store_link',
        'app_google_store',
        'app_google_link',
        'strategy_title',
        'strategy_details',
        'strategy_banner',
        'home_module',
    ];

    public $timestamps = false;

    public function upload($name,$file,$oldname)
    {
        $file->move('assets/images',$name);
        if($oldname != null)
        {
            if (file_exists(public_path().'/assets/images/'.$oldname)) {
                unlink(public_path().'/assets/images/'.$oldname);
            }
        }
    }

    public function homeModuleCheck($value)
    {
        $sections = json_decode($this->home_module,true);

        if (in_array($value, $sections)){
            return true;
        }else{
            return false;
        }
    }

}
