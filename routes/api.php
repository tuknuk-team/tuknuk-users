<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Broadcast::routes(['middleware' => ['auth:sanctum']]);

# API Auth
Route::group(['prefix' => 'auth'], function () {
    # Login
    Route::post('login', [App\Http\Controllers\Api\Auth\LoginController::class, 'login']);

    # Forgot Password
    Route::post('forgot-password', [App\Http\Controllers\Api\Auth\ForgotPasswordController::class, 'recoverPassword']);

    # Reset Password
    Route::post('reset-password', [App\Http\Controllers\Api\Auth\ResetPasswordController::class, 'updatePasswordRecovery']);

    # Register
    Route::post('register', [App\Http\Controllers\Api\Auth\RegisterController::class, 'register']);
});

# API Logged
Route::group(['middleware' => 'auth:sanctum'], function () {

    # Verify Code
    Route::group(['prefix' => 'onboarding'], function () {
        Route::post('verify-code', [App\Http\Controllers\Api\Auth\VerifyController::class, 'verifyCode']);
    });

    # Onboarding
    Route::group(['prefix' => 'onboarding'], function () {
        Route::get('actual-step', [App\Http\Controllers\Api\Onboarding\OnboardingController::class, 'getActualStep']);
        Route::get('all-steps', [App\Http\Controllers\Api\Onboarding\OnboardingController::class, 'getAllSteps']);

        # Step One
        Route::post('update-step-one', [App\Http\Controllers\Api\Onboarding\OnboardingStepOneController::class, 'updateStep']);

        # Step Two
        Route::post('update-step-two', [App\Http\Controllers\Api\Onboarding\OnboardingStepTwoController::class, 'updateStep']);

        # Step Three
        Route::get('get-suggestions', [App\Http\Controllers\Api\Onboarding\OnboardingStepThreeController::class, 'getSuggestions']);

        # Step Four
        Route::post('update-step-four', [App\Http\Controllers\Api\Onboarding\OnboardingStepFourController::class, 'updateStep']);
    });

    # User
    Route::group(['prefix' => 'user'], function () {
        # User
        Route::get('data', [App\Http\Controllers\Api\Account\AccountController::class, 'userData']);
    });

    # Profile
    Route::group(['prefix' => 'profile'], function () {
        # Data
        Route::get('{username}', [App\Http\Controllers\Api\Profile\ProfileController::class, 'data']);

        # Publications
        Route::get('{username}/publications', [App\Http\Controllers\Api\Profile\ProfileController::class, 'publications'])->name('api.profile.publications');
        Route::get('{username}/publications/{type}', [App\Http\Controllers\Api\Profile\ProfileController::class, 'publicationsByType']);

        # Publications Liked
        Route::get('{username}/publications-liked', [App\Http\Controllers\Api\Profile\ProfileController::class, 'publicationsLiked'])->name('api.profile.publicationsLiked');

        # Following
        Route::get('{username}/following', [App\Http\Controllers\Api\Profile\ProfileController::class, 'following'])->name('api.profile.following');

        # Followers
        Route::get('{username}/followers', [App\Http\Controllers\Api\Profile\ProfileController::class, 'followers'])->name('api.profile.followers');

        # Actions
        Route::get('{username}/follow', [App\Http\Controllers\Api\Profile\ProfileController::class, 'follow']);
        Route::get('{username}/unfollow', [App\Http\Controllers\Api\Profile\ProfileController::class, 'unfollow']);
    });

    # Settings
    Route::group(['prefix' => 'settings'], function () {
        # General
        Route::get('general', [App\Http\Controllers\Api\Settings\SettingsGeneralController::class, 'data']);
        Route::post('general/update', [App\Http\Controllers\Api\Settings\SettingsGeneralController::class, 'update']);

        # Notifications
        Route::get('notifications', [App\Http\Controllers\Api\Settings\SettingsNotificationsController::class, 'data']);
        Route::post('notifications/update', [App\Http\Controllers\Api\Settings\SettingsNotificationsController::class, 'update']);

        # Social
        Route::get('social', [App\Http\Controllers\Api\Settings\SettingsSocialController::class, 'data']);
        Route::post('social/update', [App\Http\Controllers\Api\Settings\SettingsSocialController::class, 'update']);

        # Profile
        Route::get('profile', [App\Http\Controllers\Api\Settings\SettingsProfileController::class, 'data']);
        Route::post('profile/update', [App\Http\Controllers\Api\Settings\SettingsProfileController::class, 'update']);

        # Compliance
        Route::get('compliance', [App\Http\Controllers\Api\Settings\SettingsComplianceController::class, 'data']);
        Route::post('compliance/update', [App\Http\Controllers\Api\Settings\SettingsComplianceController::class, 'update']);

        # Privacy
        Route::get('privacy', [App\Http\Controllers\Api\Settings\SettingsPrivacyController::class, 'data']);
        Route::post('privacy/update', [App\Http\Controllers\Api\Settings\SettingsPrivacyController::class, 'update']);

        # Security
        Route::post('security/update-password', [App\Http\Controllers\Api\Settings\SettingsSecurityController::class, 'updatePassword']);
        Route::get('security/2fa', [App\Http\Controllers\Api\Settings\SettingsSecurityController::class, 'data2fa']);
        Route::post('security/2fa/enable', [App\Http\Controllers\Api\Settings\SettingsSecurityController::class, 'enable2fa']);
        Route::post('security/2fa/disable', [App\Http\Controllers\Api\Settings\SettingsSecurityController::class, 'disable2fa']);

        # Access Logs
        Route::get('access-logs', [App\Http\Controllers\Api\Settings\SettingsAccessLogsController::class, 'data']);

        # Users Blocked
        Route::get('users-blocked', [App\Http\Controllers\Api\Settings\SettingsUsersBlockedController::class, 'data']);

        # Update Device token
        Route::post('device-token/update', [App\Http\Controllers\Api\Settings\SettingsDeviceTokenController::class, 'updateDeviceToken']);
    });

    # Publication
    Route::group(['prefix' => 'publication'], function () {
        # Feed
        Route::get('feed', [App\Http\Controllers\Api\Publication\PublicationFeedController::class, 'feed'])->name('api.publication.feed');

        # Create
        Route::get('types', [App\Http\Controllers\Api\Publication\PublicationCreateController::class, 'types']);
        Route::post('create', [App\Http\Controllers\Api\Publication\PublicationCreateController::class, 'create']);
        Route::post('search-discover', [App\Http\Controllers\Api\Publication\PublicationCreateController::class, 'searchDiscover']);

        # Show
        Route::get('data/{uuid}', [App\Http\Controllers\Api\Publication\PublicationFeedController::class, 'publicationData']);

        # Likes
        Route::get('like/{uuid}', [App\Http\Controllers\Api\Publication\PublicationLikeController::class, 'like']);
        Route::get('dislike/{uuid}', [App\Http\Controllers\Api\Publication\PublicationLikeController::class, 'dislike']);

        # Likes
        Route::get('save/{uuid}', [App\Http\Controllers\Api\Publication\PublicationSaveController::class, 'save']);
        Route::get('save/{uuid}/remove', [App\Http\Controllers\Api\Publication\PublicationSaveController::class, 'remove']);

        # Report
        Route::get('report/{uuid}', [App\Http\Controllers\Api\Publication\PublicationReportController::class, 'report']);

        # Comment
        Route::post('comment/{uuid}', [App\Http\Controllers\Api\Publication\PublicationCommentController::class, 'create']);
        Route::get('comments/{uuid}', [App\Http\Controllers\Api\Publication\PublicationCommentController::class, 'historyByPublication'])->name('api.publication.comments');
        Route::get('comments/{uuid}/{commentParentId}', [App\Http\Controllers\Api\Publication\PublicationCommentController::class, 'historySubByPublication']);
        Route::get('comment/like/{id}', [App\Http\Controllers\Api\Publication\PublicationCommentController::class, 'like']);
        Route::get('comment/dislike/{id}', [App\Http\Controllers\Api\Publication\PublicationCommentController::class, 'dislike']);
    });

    # Rooms
    Route::group(['prefix' => 'rooms'], function () {
        # Create
        Route::post('/create', [App\Http\Controllers\Api\Room\RoomCreateController::class, 'create']);

        # Lists
        Route::get('/list/{type}', [App\Http\Controllers\Api\Room\RoomListController::class, 'list']);

        # Room
        Route::get('/data/{uuid}', [App\Http\Controllers\Api\Room\RoomController::class, 'data']);

        # Participate
        Route::get('/participate/{uuid}', [App\Http\Controllers\Api\Room\RoomController::class, 'participateStart']);
        Route::post('/participate', [App\Http\Controllers\Api\Room\RoomController::class, 'participateFinish']);
    });

    # Rooms
    Route::group(['prefix' => 'discover'], function () {
        # Movies
        Route::get('/movies/top', [App\Http\Controllers\Api\Discover\DiscoverMoviesController::class, 'top']);

        # Series
        Route::get('/series/top', [App\Http\Controllers\Api\Discover\DiscoverSeriesController::class, 'top']);
    });

    # Notifications
    Route::get('/notifications', [App\Http\Controllers\Api\Notifications\NotificationsController::class, 'list'])->name('api.notifications');

    # Chats
    Route::group(['prefix' => 'chat'], function () {
        # Chats
        Route::get('/list', [App\Http\Controllers\Api\Chat\ChatController::class, 'chats']);
        Route::post('/create', [App\Http\Controllers\Api\Chat\ChatController::class, 'create']);
        Route::get('/show/{uuid}', [App\Http\Controllers\Api\Chat\ChatController::class, 'show']);

        # Message
        Route::get('/show/{uuid}/messages', [App\Http\Controllers\Api\Chat\ChatMessageController::class, 'show']);
        Route::post('/show/{uuid}/messages/send', [App\Http\Controllers\Api\Chat\ChatMessageController::class, 'create']);
    });

    # Search
    Route::group(['prefix' => 'search'], function () {
        # Chats
        Route::post('/by-username', [App\Http\Controllers\Api\Search\SearchController::class, 'searchUsername']);
    });
});

# Helpers
Route::group(['prefix' => 'helpers'], function () {

    # Interests
    Route::get('interests/base', [App\Http\Controllers\Api\Helpers\HelpersController::class, 'getBaseInterests']);
    Route::get('interests', [App\Http\Controllers\Api\Helpers\HelpersController::class, 'getAllInterests']);

    # Countries
    Route::get('countries', [App\Http\Controllers\Api\Helpers\HelpersController::class, 'getAllCountries']);

    # Genre
    Route::get('genres', [App\Http\Controllers\Api\Helpers\HelpersController::class, 'getAllGenres']);

    # Privacy
    Route::get('privacy/types-with-options', [App\Http\Controllers\Api\Helpers\HelpersController::class, 'getAllPrivacyTypeWithOption']);
    Route::get('privacy/types', [App\Http\Controllers\Api\Helpers\HelpersController::class, 'getAllPrivacyType']);
    Route::get('privacy/options', [App\Http\Controllers\Api\Helpers\HelpersController::class, 'getAllPrivacyOption']);
});
