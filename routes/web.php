<?php

use App\Livewire\TroubleshootDocumentation;
use App\Livewire\BlogDetail;
use App\Livewire\ShowBlog;
use App\Livewire\ShowContactPage;
use App\Livewire\ShowDocs;
use App\Livewire\ShowFaqPage;
use App\Livewire\ShowHome;
use App\Livewire\ShowMonitoringExtractData;
use App\Livewire\ShowPage;
use App\Livewire\ShowService;
use App\Livewire\ShowServicePage;
use App\Livewire\ShowTeamPage;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', ShowHome::class)
    ->name('home');
Route::get('/services', ShowServicePage::class)
    ->name('servicesPage');
Route::get('/service/{id}', ShowService::class)
    ->name('servicePage');
Route::get('/team', ShowTeamPage::class)
    ->name('teamPage');
Route::get('/articles', ShowBlog::class)
    ->name('blogPage');
Route::get('/blog/{id}', BlogDetail::class)
    ->name('blogDetail');
Route::get('/faqs', ShowFaqPage::class)
    ->name('faqPage');
Route::get('/page/{pageId}', ShowPage::class)
    ->name('page');
Route::get('/contact', ShowContactPage::class)
    ->name('contactPage');
// Route::get('/docs', ShowDocs::class)
//     ->name('docsPage');
Route::get('/docs', TroubleshootDocumentation::class)
    ->name('docsPages');
Route::get('/monitoring', ShowMonitoringExtractData::class)
    ->name('monitoringPage');
