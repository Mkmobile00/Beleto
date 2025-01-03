<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CinemasBranchController;
use App\Http\Controllers\CinemasController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FeaturedSectionController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LanguageSelectionController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MovieTheaterController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\PlanContentController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PushNotificationController;
use App\Http\Controllers\ShowsController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StarController;
use App\Http\Controllers\StartUpAddController;
use App\Http\Controllers\StremmingController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TvEpisodeController;
use App\Http\Controllers\TvSeriesController;
use App\Http\Controllers\VideoTypeController;
use App\Http\Controllers\WebSeriesController;
use App\Http\Controllers\WebSeriesEpisodeController;
use Illuminate\Support\Facades\Route;



Route::group(['middleware'=>['auth:web','language'],'prefix'=>'nd-admin'],function()
{
      //-------------------------Post Category--------------------------
      Route::resource('post-category',PostCategoryController::class);
      //------------------------/Post Category--------------------------

      //-------------------------Post--------------------------
      Route::resource('post',PostController::class);
      //------------------------/Post--------------------------

      //-------------------------subscription--------------------------
      Route::resource('subscription',SubscriptionController::class);
      //------------------------/subscription--------------------------

      //-------------------------Period--------------------------
      Route::resource('period',PeriodController::class);
      //------------------------/Period--------------------------

      //-------------------------Post Content--------------------------
      Route::resource('plan-content',PlanContentController::class);
      //------------------------/Post Content--------------------------

      //-------------------------Post--------------------------
      Route::resource('plan',PlanController::class);
      //------------------------/Post--------------------------

      //-------------------------Genre--------------------------
      Route::resource('genre',GenreController::class);
      //------------------------/Genre--------------------------

      //-------------------------Star--------------------------
      Route::resource('star',StarController::class);
      //------------------------/Star--------------------------

      //-------------------------Country--------------------------
      Route::resource('country',CountryController::class);
      //------------------------/Country--------------------------

       //-------------------------Notification--------------------------
       Route::resource('pushnotification',PushNotificationController::class);
       //------------------------/Notification--------------------------

      //  ----------------------------City------------------------
      Route::resource('city',CityController::class);
      //  ----------------------------/City------------------------


      //  ----------------------------Cinemas------------------------
      Route::resource('cinemas',CinemasController::class);
      //  ----------------------------/Cinemas------------------------



       //  ----------------------------CinemasBranch------------------------
       Route::resource('cinemasbranch',CinemasBranchController::class);
       //  ----------------------------/CinemasBranch------------------------

       //  ----------------------------Movie Theater------------------------
       Route::resource('movietheater',MovieTheaterController::class);
       Route::get('/movietheater/{id?}/theater-timmimg-view',[MovieTheaterController::class,'timmimgView'])->name('theater.timmimgview');
       Route::post('/movietheater/{id?}/addTheaterTime',[MovieTheaterController::class,'addTheaterTime'])->name('addTheaterTime');
       Route::put('/movietheater/{id?}/addTheaterTime/edit',[MovieTheaterController::class,'editTheaterTime'])->name('editTheaterTime');

    //    Route::post('/movietheater/getSlotPopUp',[MovieTheaterController::class,'getSlotPopUp'])->name('getSlotPopUp');
    //    Route::post('/movietheater/setTheaterTimeSlot',[MovieTheaterController::class,'setTheaterTimeSlot'])->name('setTheaterTimeSlot');
    //    Route::post('/movietheater/deleteDate',[MovieTheaterController::class,'deleteDate'])->name('deleteDate');
       //  ----------------------------/Movie Theater------------------------

       //  ----------------------------CinemasBranch------------------------
       Route::resource('shows',ShowsController::class);
    //    Route::get('shows/{id?}/view',[ShowsController::class,'setTimeView'])->name('shows.setTiming');
    //    Route::post('shows/{id?}/setDates',[ShowsController::class,'setDatesData'])->name('shows.setDatesData');
    //    Route::post('shows/delete/dates',[ShowsController::class,'deleteDates'])->name('shows.deleteDates');
       //  ----------------------------/CinemasBranch------------------------

       //-------------------------Slider--------------------------
       Route::resource('slider',SliderController::class);
       Route::post('slider/update_postion',[SliderController::class,'updatePosition'])->name('slider.updatePosition');
       Route::post('/slideritemtype',[SliderController::class,'slideritemtype'])->name('slideritemtype');
       Route::post('/updateimagepathSlider',[SliderController::class,'updateimagepathSlider'])->name('updateimagepathSlider');
       Route::get('/slider/transcode/{id}',[SliderController::class,'transcodeSlider'])->name('slider.transcode');
       Route::get('/slider/transcode/action/performe',[SliderController::class,'transcodeActionPerforme'])->name('slider.transcodeActionPerforme');
       //------------------------/Slider--------------------------


      //-------------------------Featured Section--------------------------
      Route::resource('featuredsection',FeaturedSectionController::class);
      Route::post('featuredsection/update_postion',[FeaturedSectionController::class,'updatePosition'])->name('featuredsection.updatePosition');
      Route::get('featuredsection/setposition/{id}}',[FeaturedSectionController::class,'setPosition'])->name('setFeaturedSection.position');
      Route::get('featuredsectionaddItem/{id}',[FeaturedSectionController::class,'addFeaturedItem'])->name('featuredsection.addItem');
      Route::post('featuredsection/item/update_postion',[FeaturedSectionController::class,'updatePositionItem'])->name('featuredsectionitem.updatePosition');
      Route::post('featuredsectionaddItem',[FeaturedSectionController::class,'storeFeaturedItem'])->name('featuredsection.addItemStore');




      //------------------------/Featured Section--------------------------


      //-------------------------Language--------------------------
      Route::resource('language-selection',LanguageSelectionController::class)->except('update');
      Route::patch('language-selection/{languageSelection}',[LanguageSelectionController::class,'update'])->name('language-selection.update');
      //------------------------/Language--------------------------

      //-------------------------Post--------------------------
      Route::resource('category',CategoryController::class);
      Route::get('/organize-category',[CategoryController::class,'organizeCategory'])->name('category.organize');
      Route::post('/update-organize-category',[CategoryController::class,'updateOrganizeCategory'])->name('category.sortable');
      //------------------------/Post--------------------------

      //-------------------------Country--------------------------
      Route::resource('video-type',VideoTypeController::class)->except('update');
      Route::patch('video-type/{videoType}',[VideoTypeController::class,'update'])->name('video-type.update');
      //------------------------/Country--------------------------

      // ---------------------------Movie-----------------------------
      Route::resource('movie',MovieController::class);
      Route::post('movie/update_postion',[MovieController::class,'updatePosition'])->name('movie.updatePosition');
      Route::post('save/movie',[MovieController::class,'saveMovie'])->name('save.movie');
      Route::post('/update/image-path',[MovieController::class,'updateImagePath'])->name('updateimagepath');
      Route::post('/updateimagepathMovie',[MovieController::class,'updateimagepathMovie'])->name('updateimagepathMovie');
      Route::get('/movie/transcode/{id}',[MovieController::class,'transcodeMovie'])->name('movie.transcode');
      Route::get('/movie/transcode/action/performe',[MovieController::class,'transcodeActionPerforme'])->name('movie.transcodeActionPerforme');
      // ---------------------------Movie-----------------------------

      // ---------------------------tvseries-----------------------------
      Route::resource('tvseries',TvSeriesController::class);
      Route::post('save/tvseries',[TvSeriesController::class,'saveTvseries'])->name('save.tvseries');
      Route::post('/series/update/image-path',[TvSeriesController::class,'updateImagePath'])->name('seriesupdateimagepath');

      Route::get('/tvseries/episode/{id}',[TvEpisodeController::class,'episodeList'])->name('tvseries.episodelist');
      Route::get('/tvseries/episode/{id}/create',[TvEpisodeController::class,'episodeCreate'])->name('tvseries.episodeadd');
      Route::get('/tvseries/episode/{id}/edit',[TvEpisodeController::class,'episodeEdit'])->name('tvseries.episodeedit');
      Route::delete('/tvseries/episode/{id}/delete',[TvEpisodeController::class,'deleteEpisodes'])->name('tvseries.deleteEpisodes');
      Route::post('/series/episodes/update/data/image-path',[TvEpisodeController::class,'updateTvseriesEpisodes'])->name('updateTvseriesEpisodes');
      Route::post('save/tvseries/episodes',[TvEpisodeController::class,'saveEpisodes'])->name('save.tvseriesepisodes');
      Route::put('update/tvseries/episodes',[TvEpisodeController::class,'updateEpisodes'])->name('update.episodes');
      // ---------------------------tvseries-----------------------------

    // ---------------------------webseries-----------------------------
    Route::resource('webseries',WebSeriesController::class);
    Route::post('webseries/update_postion',[WebSeriesController::class,'updatePosition'])->name('webseries.updatePosition');
    Route::post('save/webseries',[WebSeriesController::class,'saveTvseries'])->name('save.webseries');
    Route::post('/series/update/image-path',[WebSeriesController::class,'updateImagePath'])->name('seriesupdateimagepath');
    Route::get('/webseries/episode/{id}',[WebSeriesEpisodeController::class,'episodeList'])->name('webseries.episodelist');
    Route::get('/webseries/episode/{id}/create',[WebSeriesEpisodeController::class,'episodeCreate'])->name('webseries.episodeadd');
    Route::post('webseries/episodes/update_postion',[WebSeriesEpisodeController::class,'updatePosition'])->name('webseriesepisodes.updatePosition');
    Route::get('/webseries/episode/{id}/edit',[WebSeriesEpisodeController::class,'episodeEdit'])->name('webseries.episodeedit');
    Route::delete('/webseries/episode/{id}/delete',[WebSeriesEpisodeController::class,'deleteEpisodes'])->name('webseries.deleteEpisodes');
    Route::post('/series/episodes/update/image-path',[WebSeriesEpisodeController::class,'updateTvseriesEpisodes'])->name('updatewebseriesEpisodes');
    Route::post('save/webseries/episodes',[WebSeriesEpisodeController::class,'saveEpisodes'])->name('save.episodes');
    Route::put('update/webseries/episodes',[WebSeriesEpisodeController::class,'updateEpisodes'])->name('update.webepisodes');
    Route::get('/webseries/episode/transcode/{id}',[WebSeriesEpisodeController::class,'transcodeMovie'])->name('webseriesepisodes.transcode');
    Route::get('/webseries/episode/transcode/action/performe',[WebSeriesEpisodeController::class,'transcodeActionPerforme'])->name('webseriespart.transcodeActionPerforme');
    // ---------------------------webseries-----------------------------


    Route::get('/customer/list',[CustomerController::class,'getCustomer'])->name('customer.list');

    Route::get('/customer/verified',[CustomerController::class,'getVerifiedCustomer'])->name('customer.verifiedlist');
    Route::get('/customer/active',[CustomerController::class,'getActiveCustomer'])->name('customer.activelist');
    Route::get('/customer/inactive',[CustomerController::class,'getInActiveCustomer'])->name('customer.inactivelist');
    Route::get('/customer/blocked',[CustomerController::class,'getBlockedCustomer'])->name('customer.blockedlist');
    Route::get('/customer/subscriotion/customer',[CustomerController::class,'getSubscriptionCustomer'])->name('customer.subscriptionuserlist');


    Route::get('/customer/search',[CustomerController::class,'searchCustomer'])->name('search.customer');

    Route::get('/customer/searchCustomerVerified',[CustomerController::class,'searchCustomerVerified'])->name('search.customerVerified');
    Route::get('/customer/searchCustomerActive',[CustomerController::class,'searchCustomerActive'])->name('search.customerActive');
    Route::get('/customer/searchCustomerInActive',[CustomerController::class,'searchCustomerInActive'])->name('search.customerInActive');
    Route::get('/customer/searchCustomerBlocked',[CustomerController::class,'searchCustomerBlocked'])->name('search.customerBlocked');
    Route::get('/customer/searchCustomerSubscription',[CustomerController::class,'searchCustomerSubscription'])->name('search.customerSubscription');


    Route::get('/customer/create',[CustomerController::class,'create'])->name('customer.create');
    Route::post('/customer/store',[CustomerController::class,'store'])->name('customer.store');
    Route::get('/customer/edit/{id}',[CustomerController::class,'edit'])->name('customer.edit');
    Route::patch('/customer/update/{id}',[CustomerController::class,'update'])->name('customer.update');
    Route::delete('/customer/destroy/{id}',[CustomerController::class,'destroy'])->name('customer.destroy');
    Route::get('/set/customer/{id}/subscription',[CustomerController::class,'setSubscription'])->name('setcustomercustome.susbcription');
    Route::post('/set/customer/subscription',[CustomerController::class,'setSubscriptionAction'])->name('customer.setSubscription');

    Route::get('/customer/show/{id}',[CustomerController::class,'getCustomerDetails'])->name('customer.show');
    Route::get('/customer/paginate-history/{id}',[CustomerController::class,'getCustomerWatchHistoryPaginate'])->name('customer.paginatewatchhistory');

    Route::delete('/customer/paginate-history/deleteDeviceList/{id}',[CustomerController::class,'customerDeleteDeviceList'])->name('customer.admindeletedevicelist');
    Route::get('/customer/susbcription-list/{id}',[CustomerController::class,'customerSusbcriptionList'])->name('customer.subscriptionlist');
    Route::get('/customer/payment-history/{id}',[CustomerController::class,'customerPaymentHistory'])->name('customer.paymenthistory');
    Route::get('/customer/devicelist/{id}',[CustomerController::class,'customerDevicelist'])->name('customer.devicelist');
    Route::get('/customer/watchhistory/{id}',[CustomerController::class,'customerWatchhistory'])->name('customer.watchhistory');

    Route::post('/setMoviePremium',[AdminController::class,'setMoviePremium'])->name('setMoviePremium');
    Route::post('/fetchPremiumContent',[AdminController::class,'fetchPremiumContent'])->name('fetchPremiumContent');

    Route::get('/alltransaction',[ReportController::class,'allTransaction'])->name('alltransaction.view');
    Route::get('/getCustomerSubscription',[AdminController::class,'getCustomerSubscription'])->name('getCustomerSubscription');

    Route::resource('stremming',StremmingController::class);
    Route::post('save/stremming',[StremmingController::class,'saveTvseries'])->name('save.stremming');
    Route::post('stremming/update_postion',[StremmingController::class,'updatePosition'])->name('stremming.updatePosition');


    Route::resource('startupadd',StartUpAddController::class);

    // Route::post('/stremming/update/image-path',[StremmingController::class,'updateImagePath'])->name('seriesupdateimagepath');
});
