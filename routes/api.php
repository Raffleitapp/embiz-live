<?php

use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public API routes
Route::get('/opportunities', [OpportunityController::class, 'index']);
Route::get('/opportunities/featured', [OpportunityController::class, 'featured']);
Route::get('/opportunities/{opportunity}', [OpportunityController::class, 'show']);

Route::get('/profiles/search', [UserProfileController::class, 'search']);
Route::get('/profiles/{user}', [UserProfileController::class, 'getProfile']);

Route::get('/affiliate/partners', [AffiliateController::class, 'getPartners']);
Route::get('/affiliate/code/{referralCode}', [AffiliateController::class, 'getByReferralCode']);

// Protected API routes
Route::middleware('auth:sanctum')->group(function () {
    // Profile routes
    Route::post('/profile/update', [UserProfileController::class, 'update']);
    Route::get('/profiles/recommendations', [UserProfileController::class, 'getRecommendations']);
    
    // Opportunity routes
    Route::post('/opportunities', [OpportunityController::class, 'store']);
    Route::put('/opportunities/{opportunity}', [OpportunityController::class, 'update']);
    Route::delete('/opportunities/{opportunity}', [OpportunityController::class, 'destroy']);
    Route::post('/opportunities/{opportunity}/apply', [OpportunityController::class, 'apply']);
    Route::get('/my-opportunities', [OpportunityController::class, 'myOpportunities']);
    
    // Network routes
    Route::get('/connections', [NetworkController::class, 'getConnections']);
    Route::get('/connections/pending', [NetworkController::class, 'getPendingRequests']);
    Route::get('/connections/sent', [NetworkController::class, 'getSentRequests']);
    Route::post('/connections/send/{user}', [NetworkController::class, 'sendRequest']);
    Route::post('/connections/accept/{connection}', [NetworkController::class, 'acceptRequest']);
    Route::post('/connections/decline/{connection}', [NetworkController::class, 'declineRequest']);
    Route::delete('/connections/{connection}', [NetworkController::class, 'removeConnection']);
    Route::get('/network/search', [NetworkController::class, 'search']);
    
    // Affiliate routes
    Route::get('/affiliate/stats', [AffiliateController::class, 'getStats']);
    Route::post('/affiliate/join', [AffiliateController::class, 'join']);
    Route::put('/affiliate/{affiliateProgramme}', [AffiliateController::class, 'update']);
    Route::post('/affiliate/{affiliateProgramme}/referral', [AffiliateController::class, 'processReferral']);
    Route::post('/affiliate/{affiliateProgramme}/payout', [AffiliateController::class, 'requestPayout']);
    Route::post('/affiliate/interest', [AffiliateController::class, 'expressInterest']);
    
    // Message routes
    Route::get('/messages', [MessageController::class, 'getMessages']);
    Route::post('/messages/send/{recipient}', [MessageController::class, 'send']);
    Route::get('/messages/thread/{threadId}', [MessageController::class, 'getThread']);
    Route::post('/messages/{message}/read', [MessageController::class, 'markAsRead']);
    Route::post('/messages/{message}/important', [MessageController::class, 'markAsImportant']);
    Route::post('/messages/{message}/archive', [MessageController::class, 'archive']);
    Route::delete('/messages/{message}', [MessageController::class, 'delete']);
    Route::get('/messages/unread-count', [MessageController::class, 'getUnreadCount']);
    Route::get('/messages/search', [MessageController::class, 'search']);
});
