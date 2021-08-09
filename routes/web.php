<?php

use App\Announcement;
use App\Gallery;
use App\Jadwal;
use App\Klasemen;
use App\News;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $items = Gallery::where('lokasi', 'home')->take(3)->get();

    return view('pages.landingpage', ['galleries' => $items]);
})->name('beranda');


Route::get('/berita', function () {
    $items = News::where('status', 'publish')->orderBy('updated_at', 'DESC')->get();
    return view('pages.berita', ['news' => $items]);
})->name('berita');

Route::get('/berita/{slug}', function ($slug) {
    $items = News::where('slug', $slug)->first();
    if (!$items) {
        return abort(404);
    }
    return view('pages.detailberita', ['items' => $items]);
})->name('detailberita');

Route::get('/klasemen', function () {
    $items = Klasemen::orderBy('rank', 'asc')->get();
    return view('pages.klasemen', ['items' => $items]);
})->name('klasemen');

Route::get('/galeri', function () {
    $items = Gallery::where('lokasi', 'gallery')->get();
    return view('pages.galeri', ['galleries' => $items]);
})->name('galeri');

Route::get('/jadwal', function () {
    $items = Jadwal::orderBy('tanggal', 'asc')->get();
    return view('pages.jadwal', ['jadwal' => $items]);
})->name('jadwal');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Auth::routes();

Route::prefix('dashboard')
    ->middleware(['auth', 'user'])
    ->group(function () {
        Route::get('/', function () {
            return view('user');
        });
        Route::get('/{slug}', function () {
            return view('user');
        });
        Route::get('/{slug}/{subslug}', function () {
            return view('user');
        });
    });



Route::prefix('admin')
    ->middleware('auth', 'admin')
    ->group(function () {
        Route::get('/', function () {
            return view('admin');
        });
        Route::get('/{slug}', function () {
            return view('admin');
        });
        Route::get('/{slug}/{id}/edit', function () {
            return view('admin');
        });
    });

Route::prefix('app')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        Route::get('/competition', 'AdminController@index');
        Route::get('/competition/{id}', 'AdminController@show');
        Route::post('/competition/{id}', 'AdminController@update'); //change on prod

        Route::get('/overview', 'AdminController@countCompetition');

        Route::get('/announcement', 'AnnouncementController@index');
        Route::get('/announcement/{id}', 'AnnouncementController@show');
        Route::post('/announcement', 'AnnouncementController@create');
        Route::post('/update_announcement/{id}', 'AnnouncementController@update'); //change prod
        Route::post('/announcement/{id}', 'AnnouncementController@delete'); //change prod

        Route::get('/news', 'NewsController@index');
        Route::get('/news/{id}', 'NewsController@show');
        Route::post('/news', 'NewsController@create');
        Route::post('/update_news/{id}', 'NewsController@update'); //change on prod
        Route::post('/news/{id}', 'NewsController@delete'); //change on prod

        Route::post('/upload_image', 'ImageController@upload_images');
        Route::post('/upload_image_byurl', 'ImageController@upload_image_byurl');
        Route::post('/delete_image', 'ImageController@delete_images');

        Route::get('/gallery', 'GalleryController@index');
        Route::post('/gallery', 'GalleryController@create');
        Route::post('/gallery/{id}', 'GalleryController@delete'); //change prod

        Route::get('/jadwal', 'JadwalController@index');
        Route::post('/jadwal', 'JadwalController@create');
        Route::post('/jadwal/{id}', 'JadwalController@delete'); //change prod

        Route::post('/upload_thumbnail', 'ImageController@upload_thumbnail');
        Route::post('/delete_thumbnail', 'ImageController@delete_thumbnail');

        Route::get('/klasemen', 'KlasemenController@index');
        Route::post('/klasemen', 'KlasemenController@create');
        Route::post('/klasemen/{id}', 'KlasemenController@delete'); //change prod
        Route::post('/klasemen_update/{id}', 'KlasemenController@update'); //change prod
    });
Route::get('/test', 'AdminController@countCompetition');

Route::prefix('client')
    ->middleware('auth')
    ->group(function () {

        Route::post('/competition', 'CompetitionController@create');
        Route::post('/update_competition/{id}', 'CompetitionController@update'); //change prod
        Route::get('/competition', 'CompetitionController@show');
        Route::post('/competition/{id}', 'CompetitionController@delete'); //change prod

        Route::post('/player', 'PlayerController@create');
        Route::get('/player', 'PlayerController@show');
        Route::post('/update_player/{id}', 'PlayerController@update'); //change prod
        Route::post('/player/{id}', 'PlayerController@delete'); //change prod

        Route::post('/official', 'OfficialController@create');
        Route::get('/official', 'OfficialController@show');
        Route::post('/update_official/{id}', 'OfficialController@update'); //change prod
        Route::post('/official/{id}', 'OfficialController@delete'); //change prod



        Route::post('/upload_avatar', 'UserController@upload_avatar');
        Route::post('/delete_avatar', 'UserController@delete_avatar');
        Route::post('/upload_krs', 'UserController@upload_krs');
        Route::post('/delete_krs', 'UserController@delete_krs');
        Route::post('/upload_ktm', 'UserController@upload_ktm');
        Route::post('/delete_ktm', 'UserController@delete_ktm');

        Route::post('/upload_lampiran', 'UserController@upload_lampiran');
        Route::post('/delete_lampiran', 'UserController@delete_lampiran');
        Route::post('/upload_pembayaran', 'UserController@upload_pembayaran');
        Route::post('/delete_pembayaran', 'UserController@delete_pembayaran');

        Route::get('/announcement', 'AnnouncementController@index');

        Route::get('/announcement/{slug}', 'AnnouncementController@slug');

        Route::get('/news', 'NewsController@index');
        Route::get('/news/{slug}', 'NewsController@slug');
    });
