<?php
use App\Http\Controllers;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;

  Route::redirect('admin', 'admin/login');
  Route::post('the/genius/ocean/2441139', 'Frontend\FrontendController@subscription');
  Route::get('finalize', 'Frontend\FrontendController@finalize');

  Route::get('/', [FrontendController::class,'index'])->name('front.index');

  Route::get('blogs', [FrontendController::class,'blog'])->name('front.blog');
  Route::get('blog/{slug}', [FrontendController::class,'blogdetails'])->name('blog.details');
  Route::get('/blog-search', [FrontendController::class,'blogsearch'])->name('front.blogsearch');
  Route::get('/blog/category/{slug}', [FrontendController::class,'blogcategory'])->name('front.blogcategory');
  Route::get('/blog/tag/{slug}', [FrontendController::class,'blogtags'])->name('front.blogtags');
  Route::get('/blog/archive/{slug}', [FrontendController::class,'blogarchive'])->name('front.blogarchive');

  Route::get('/services', [FrontendController::class,'services'])->name('front.services');

  Route::get('/about', [FrontendController::class,'about'])->name('front.about');
  Route::get('/contact', [FrontendController::class,'contact'])->name('front.contact');
  Route::post('/contact', [FrontendController::class,'contactemail'])->name('front.contact.submit');
  Route::get('/faq', [FrontendController::class,'faq'])->name('front.faq');
  Route::get('/{slug}', [FrontendController::class,'page'])->name('front.page');
  Route::post('/subscriber', [FrontendController::class,'subscriber'])->name('front.subscriber');

  Route::get('/currency/{id}', [FrontendController::class,'currency'])->name('front.currency');
  Route::get('/language/{id}', [FrontendController::class,'language'])->name('front.language');

  Route::get('/currency/rate/update', [FrontendController::class,'currencyRate'])->name('front.currency.rate');


