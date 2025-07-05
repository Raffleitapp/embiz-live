<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Dashboard Routes
    Route::get('/dashboard/members', [DashboardController::class, 'members'])->name('dashboard.members');
    Route::get('/dashboard/add-member', [DashboardController::class, 'addMember'])->name('dashboard.add-member');
    Route::post('/dashboard/store-member', [DashboardController::class, 'storeMember'])->name('dashboard.store-member');
    Route::post('/dashboard/generate-password', [DashboardController::class, 'generatePassword'])->name('dashboard.generate-password');
    Route::put('/dashboard/users/{user}/role', [DashboardController::class, 'updateUserRole'])->name('dashboard.update-user-role');
    Route::post('/dashboard/users/{user}/toggle-status', [DashboardController::class, 'toggleUserStatus'])->name('dashboard.toggle-user-status');
    Route::delete('/dashboard/users/{user}', [DashboardController::class, 'deleteUser'])->name('dashboard.delete-user');
    Route::get('/dashboard/search-members', [DashboardController::class, 'searchMembers'])->name('dashboard.search-members');
    
    // Settings Routes
    Route::get('/dashboard/settings', [DashboardController::class, 'settings'])->name('dashboard.settings');
    Route::post('/dashboard/settings', [DashboardController::class, 'updateSettings'])->name('dashboard.update-settings');
    
    // Activity Logs Routes
    Route::get('/dashboard/activity-logs', [DashboardController::class, 'activityLogs'])->name('dashboard.activity-logs');
    
    // Roles & Permissions Routes
    Route::get('/dashboard/roles-permissions', [DashboardController::class, 'rolesPermissions'])->name('dashboard.roles-permissions');
    Route::post('/dashboard/roles/create', [DashboardController::class, 'createRole'])->name('dashboard.create-role');
    Route::get('/dashboard/roles/{role}/edit', [DashboardController::class, 'editRole'])->name('dashboard.edit-role');
    Route::put('/dashboard/roles/{role}/update', [DashboardController::class, 'updateRole'])->name('dashboard.update-role');
    Route::post('/dashboard/roles/{role}/delete', [DashboardController::class, 'deleteRole'])->name('dashboard.delete-role');
    
    // Support/Help Routes
    Route::get('/dashboard/support', [DashboardController::class, 'support'])->name('dashboard.support');
    Route::post('/dashboard/support/ticket', [DashboardController::class, 'createSupportTicket'])->name('dashboard.create-support-ticket');
    
    // User Profile Routes
    Route::get('/user-profile', [UserProfileController::class, 'showCurrentUser'])->name('user-profile');
    Route::get('/user-profile/{user}', [UserProfileController::class, 'show'])->name('user-profile.show');
    Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit-form');
    Route::post('/profile/update', [UserProfileController::class, 'update'])->name('profile.update-form');
    
    // User account management
    Route::get('/account/edit', [UserProfileController::class, 'editAccount'])->name('account.edit');
    Route::post('/account/update', [UserProfileController::class, 'updateAccount'])->name('account.update');
    
    // Opportunity Routes
    Route::get('/opportunities', [OpportunityController::class, 'index'])->name('opportunities.index');
    Route::get('/opportunities/create', [OpportunityController::class, 'create'])->name('opportunities.create');
    Route::post('/opportunities', [OpportunityController::class, 'store'])->name('opportunities.store');
    Route::get('/opportunities/{opportunity}', [OpportunityController::class, 'show'])->name('opportunities.show');
    Route::get('/opportunities/{opportunity}/edit', [OpportunityController::class, 'edit'])->name('opportunities.edit');
    Route::put('/opportunities/{opportunity}', [OpportunityController::class, 'update'])->name('opportunities.update');
    Route::delete('/opportunities/{opportunity}', [OpportunityController::class, 'destroy'])->name('opportunities.destroy');
    Route::post('/opportunities/{opportunity}/apply', [OpportunityController::class, 'apply'])->name('opportunities.apply');
    Route::get('/my-opportunities', [OpportunityController::class, 'myOpportunities'])->name('opportunities.mine');
    
    // Network Routes
    Route::get('/network', [NetworkController::class, 'index'])->name('network.index');
    Route::post('/network/connect/{user}', [NetworkController::class, 'sendRequest'])->name('network.connect');
    Route::post('/network/accept/{connection}', [NetworkController::class, 'acceptRequest'])->name('network.accept');
    Route::post('/network/decline/{connection}', [NetworkController::class, 'declineRequest'])->name('network.decline');
    Route::post('/network/block/{connection}', [NetworkController::class, 'blockConnection'])->name('network.block');
    Route::delete('/network/remove/{connection}', [NetworkController::class, 'removeConnection'])->name('network.remove');
    Route::get('/network/search', [NetworkController::class, 'search'])->name('network.search');
    
    // Affiliate Routes
    Route::get('/affiliate', [AffiliateController::class, 'index'])->name('affiliate.index');
    Route::post('/affiliate/join', [AffiliateController::class, 'join'])->name('affiliate.join');
    Route::put('/affiliate/{affiliateProgramme}', [AffiliateController::class, 'update'])->name('affiliate.update');
    Route::get('/affiliate/stats', [AffiliateController::class, 'getStats'])->name('affiliate.stats');
    Route::post('/affiliate/{affiliateProgramme}/referral', [AffiliateController::class, 'processReferral'])->name('affiliate.referral');
    Route::post('/affiliate/{affiliateProgramme}/payout', [AffiliateController::class, 'requestPayout'])->name('affiliate.payout');
    Route::post('/affiliate/interest', [AffiliateController::class, 'expressInterest'])->name('affiliate.interest');
    
    // Message Routes
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::post('/messages/send/{recipient}', [MessageController::class, 'send'])->name('messages.send');
    Route::get('/messages/thread/{threadId}', [MessageController::class, 'getThread'])->name('messages.thread');
    Route::get('/messages/list', [MessageController::class, 'getMessages'])->name('messages.list');
    Route::post('/messages/{message}/read', [MessageController::class, 'markAsRead'])->name('messages.read');
    Route::post('/messages/{message}/important', [MessageController::class, 'markAsImportant'])->name('messages.important');
    Route::post('/messages/{message}/archive', [MessageController::class, 'archive'])->name('messages.archive');
    Route::post('/messages/{message}/unarchive', [MessageController::class, 'unarchive'])->name('messages.unarchive');
    Route::delete('/messages/{message}', [MessageController::class, 'delete'])->name('messages.delete');
    Route::get('/messages/unread-count', [MessageController::class, 'getUnreadCount'])->name('messages.unread-count');
    Route::get('/messages/search', [MessageController::class, 'search'])->name('messages.search');
});


Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/services', function () {
    return view('services');
})->name('services');

// API Routes for public access
Route::get('/api/opportunities/featured', [OpportunityController::class, 'featured'])->name('api.opportunities.featured');
Route::get('/api/affiliate/partners', [AffiliateController::class, 'getPartners'])->name('api.affiliate.partners');
Route::get('/api/affiliate/code/{referralCode}', [AffiliateController::class, 'getByReferralCode'])->name('api.affiliate.code');
Route::get('/api/profiles/search', [UserProfileController::class, 'search'])->name('api.profiles.search');
Route::get('/api/profiles/recommendations', [UserProfileController::class, 'getRecommendations'])->name('api.profiles.recommendations');

require __DIR__ . '/auth.php';
