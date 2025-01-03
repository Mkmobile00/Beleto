<?php

namespace App\Providers;

use App\Models\Star;
use App\Models\Genre;
use App\Models\Slider;
use App\Models\TvSeries;
use App\Models\WebSeries;
use App\Models\WebsiteLogo;
use App\Models\SystemSetting;
use App\Enum\Star\StarTypeEnum;
use App\Http\Traits\SliderTrait;
use App\Data\Currency\CurrencyData;
use App\Models\Api\CustomerDeviceList;
use App\Models\Menu;
use App\Models\SeoSocial;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    use SliderTrait;
    public function register(): void
    {

        
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });
        
        View::composer(['admin*'], function ($view) {
            $systemSetting=SystemSetting::first();
            $logo=WebsiteLogo::first();
            $view->with('setting',$systemSetting);
            $view->with('logo',$logo);
        });
        
        View::composer(['frontend*'], function ($view) {
            $customer=Auth::guard('customer')->user();
            $computerId = $_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'];
            $seo=SeoSocial::first();
            // dd($seo_setting);
            if($customer){
                if($customer->manual_subscription){
                    Session::flush();
                    Auth::guard('customer')->logout();
                }

                $customerDevice=CustomerDeviceList::where('customer_id',$customer->id)->where('device_serial_num',$computerId)->withTrashed()->first();
                
                if(!$customerDevice){
                    
                    Session::flush();
                    Auth::guard('customer')->logout();
                }elseif($customerDevice->deleted_at !=null){
                        Session::flush();
                        Auth::guard('customer')->logout();
                }
            }

            $currencyType=(new CurrencyData())->getSelectionData();
            $customer=Auth::guard('customer')->user();
            $systemSetting=SystemSetting::first();
            $logo=WebsiteLogo::first();
            $topMenus=$this->topMenus();
            $sliders=$this->frontSlider();
            $data['sliders']=$sliders;
            $actors=Star::where('star_type',StarTypeEnum::ACTOR)->get();
            $directors=Star::where('star_type',StarTypeEnum::DIRECTOR)->get();
            $writers=Star::where('star_type',StarTypeEnum::WRITER)->get();
            $tvSeries=TvSeries::select(['title','slug','type'])->get();
            $webSeries=WebSeries::select(['title','slug','type'])->get();
            $genres=Genre::select(['title','slug'])->get();
            $pages=Menu::orderBy('position','Asc')->where('category_slug','page')->get();
            $headerPages=Menu::orderBy('position','Asc')->where('category_slug','page')->whereIn('header_footer',[1,3])->orderBy('position','ASC')->get();
            $footerPages=Menu::orderBy('position','Asc')->where('category_slug','page')->whereIn('header_footer',[2,3])->orderBy('position','ASC')->get();
            $view->with('topMenus',$topMenus);
            $view->with('sliders',$data['sliders']);
            $view->with('actors',$actors);
            $view->with('directors',$directors);
            $view->with('writers',$writers);
            $view->with('tvSeries',$tvSeries);
            $view->with('webSeries',$webSeries);
            $view->with('genres',$genres);
            $view->with('systemSetting',$systemSetting);
            $view->with('logo',$logo);
            $view->with('customer',$customer);
            $view->with('currencyTypes',$currencyType);
            $view->with('pages',$pages);
            $view->with('headerPages',$headerPages);
            $view->with('footerPages',$footerPages);
            $view->with('seo',$seo);
        });
    }

    /**
     * Bootstrap any application services.
    */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
