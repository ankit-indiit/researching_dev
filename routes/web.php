<?php

use App\Http\Controllers\AffiliateController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\GoogleSocialiteController;
use App\Http\Controllers\IndexController;

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
//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

Route::name('front.')->middleware('visitor')->group(function() {
//route to get main index page
Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/getwhatsapp/{id}', [IndexController::class, 'getWhatsappLink'])->name('getwhatsapp');

Auth::routes();

//route for signup/registration controller
Route::post('/signup', [App\Http\Controllers\RegisterController::class, 'doSignup'])->name('signup');

//get degree listing for signup form
Route::post('/getdegree', [App\Http\Controllers\DegreeController::class, 'getdegree'])->name('getdegree');

//get degree listing for signup form
Route::post('/get_degree', [App\Http\Controllers\DegreeController::class, 'get_degree'])->name('get_degree');


//route for login controller
Route::post('/loginpage', [App\Http\Controllers\RegisterController::class, 'doLogin'])->name('loginpage');

Route::get('/Logout', [App\Http\Controllers\RegisterController::class, 'logout'])->name('Logout');

//Route for forgot password
Route::get('/forgot-password', [App\Http\Controllers\RegisterController::class,'showforgot'])->name('forgotpassword');    
Route::post('/forgot-password', [App\Http\Controllers\RegisterController::class,'do_forgot'])->name('do_forgotpassword');
Route::get('/reset-password/{token}', [App\Http\Controllers\RegisterController::class,'resetPassword'])->name('resetpassword');
Route::post('/set-password', [App\Http\Controllers\RegisterController::class,'setPassword'])->name('setpassword');

//route for updating password from profile page
Route::post('/home/password', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('home.password');

//route to get message page from profile page of user
Route::get('/home/message', [App\Http\Controllers\HomeController::class, 'Messages'])->name('messages');
Route::get('/home/message/{id}', [App\Http\Controllers\HomeController::class, 'ShowMessagesDetails'])->name('messages.details');

//route to get notification page from profile page of user
Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'Notifications'])->name('notifications');

//remove item from cart table and session as well
Route::post('/remove_notification', [App\Http\Controllers\NotificationController::class, 'remove']);

//route to get payment-methood page from profile image of user
Route::get('/home/payment-method', [App\Http\Controllers\HomeController::class, 'PaymentMethods'])->name('paymethod');

//route to get purchase history page from profile image of user
Route::get('/history', [App\Http\Controllers\HistoryController::class, 'index'])->name('history');

Route::get('/getinstitute', [App\Http\Controllers\Auth\GoogleSocialiteController::class, 'getinstitute'])->name('getinstitute');

Route::post('/institute_update', [App\Http\Controllers\Auth\GoogleSocialiteController::class, 'institute_update'])->name('institute_update');

//route for redirecting social login with google account
Route::get('auth/google', [App\Http\Controllers\Auth\GoogleSocialiteController::class, 'redirectToGoogle'])->name('googlelogin');

//route for callback method for google login
Route::get('auth/google/callback', [App\Http\Controllers\Auth\GoogleSocialiteController::class, 'handleGoogleCallback']);

//route for redirecting social login with facebook account
Route::get('auth/facebook', [App\Http\Controllers\Auth\GoogleSocialiteController::class, 'redirectToFacebook'])->name('facebooklogin');

//route for callback method for google login
Route::get('auth/facebook/callback', [App\Http\Controllers\Auth\GoogleSocialiteController::class, 'handleFacebookCallback']);

//route for redirecting and listing of blogs and categories on blogs page.
Route::get('/blog', [App\Http\Controllers\BlogsController::class, 'loadDataAjax'])->name('Blogs');

//route to get blogs listing on the basis of catefgories.
Route::post('/blogs', [App\Http\Controllers\BlogsController::class, 'getBlogs'])->name('showBlogs');


Route::get('/blogs', [App\Http\Controllers\BlogsController::class, 'getBlogs']);
Route::get('/blogsbycat', [App\Http\Controllers\BlogsController::class, 'getBlogsByCat'])->name('blogsbycat');

//route to get blog listing on the basis of category.
Route::post('/list_category', [App\Http\Controllers\BlogsController::class, 'listBlogs'])->name('list_category');

//route to get blog-detail for particular blog on the basis of slug title
Route::get('/blog/{slug}', [App\Http\Controllers\BlogsController::class, 'showBlog'])->name('blog.show');

//route to post comments on blogs
Route::post('/blog_comments', [App\Http\Controllers\BlogsController::class, 'addcomments'])->name('blog_comments');

//show particular instructor related to each blog.
Route::post('/blog_instructor_detail', [App\Http\Controllers\BlogsController::class, 'showbloginstructor']);

//route to get listing of courses for courses page.
Route::get('/courses', [App\Http\Controllers\CoursesController::class, 'index'])->name('courses');

//route to show particular course basically course detail on the basis of courseid
Route::get('/courses/show/{id}', [App\Http\Controllers\CoursesController::class, 'showCourse'])->name('course.show');

//route to upload docs for particular course and package
Route::post('/upload_docs', [App\Http\Controllers\CoursesMaterialController::class, 'storedocs'])->name('upload_docs');

//route to show package detail page on the basis of particular package id
Route::get('/courses/showpackage/{id}/{package_id}', [App\Http\Controllers\CoursesController::class, 'showPackage'])->name('package.show');

//route for contact us page load
Route::get('/contact-us', [App\Http\Controllers\ContactController::class, 'getContact'])->name('contact.show');

//route for send email for contact us and sending email for contacting.
Route::post('/contact-us', [App\Http\Controllers\ContactController::class, 'saveContact'])->name('contact-us.save');

//route method to add items in the cart
Route::get('/cart/{type}/{id}', [App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.show');

//route method to sow item detail on cart page.
Route::get('/showcart/{id}', [App\Http\Controllers\CartController::class, 'showCart'])->name('display.cart');

//remove item from cart table and session as well
Route::post('/remove_from_cart', [App\Http\Controllers\CartController::class, 'remove']);


//route to add ratings on purchased courses
Route::post('/ratings', [App\Http\Controllers\MyCoursesController::class, 'addratings'])->name('ratings');

//route to get listing of instructors for instructors page
Route::get('/instructors', [App\Http\Controllers\InstructorController::class, 'index'])->name('instructor');

//route to get detail of particular instructor 
Route::post('/instructor_detail', [App\Http\Controllers\InstructorController::class, 'get_details']);

//route for checking out for order
Route::post('/checkout_update', [App\Http\Controllers\CartController::class, 'checkout']);

//route to get or load about us page.
Route::get('/about-us', [App\Http\Controllers\AboutusController::class, 'index'])->name('about-us');

//get instructors listing and detail on about us page
Route::post('/about_detail', [App\Http\Controllers\AboutusController::class, 'get_details']);

//route for saving chatbox data in db from mycourse detail page and cart page
Route::post('/chatbox', [App\Http\Controllers\ChatboxController::class, 'storechats'])->name('chatbox');

//route when click on direct but now button.
Route::get('/buycourse/{type}/{courseid}', [App\Http\Controllers\BuynowController::class, 'buyCourse'])->name('buycourse');

//route for adding cards for particular user
//route for checking out for order
Route::post('/add_card', [App\Http\Controllers\PaymentMethodController::class, 'add_payment_card'])->name('add_payment_cards');

//remove card for particular user
Route::post('/remove_card', [App\Http\Controllers\PaymentMethodController::class, 'remove_payment_card']);

//route to get listing of courses for courses page.
Route::get('/search_courses/{ids}/{type}', [App\Http\Controllers\SearchCoursesController::class, 'search_courses'])->name('search_courses');

//route to get simulation/quiz page.
Route::get('/simulation', [App\Http\Controllers\SimulationController::class, 'index'])->name('simulation');

Route::get('/simulation/{cid?}/{id?}', [App\Http\Controllers\SimulationController::class, 'show_simulation'])->name('simulation.show');

//route for saving chatbox data in db from mycourse detail page and cart page
Route::post('/download_study_course', [App\Http\Controllers\MyCoursesController::class, 'download'])->name('download_study_course');

//route for saving chatbox data in db from mycourse detail page and cart page
Route::post('/newsletters', [App\Http\Controllers\SubscribersController::class, 'store'])->name('newsletters');

//route for adding recommendation
Route::post('/add_recommend', [App\Http\Controllers\RecommendController::class, 'addrecommend'])->name('add_recommend');

//route for adding recommendation
Route::get('/user_recommend/{id?}/{course_id?}', [App\Http\Controllers\RecommendController::class, 'userrecommend'])->name('userrecommend');

//route for adding recommendation
Route::get('/instructor-recommendation/{id?}', [App\Http\Controllers\RecommendController::class, 'instructor_recommend'])->name('instructor_recommend');


//route for apply coupon section
Route::post('/apply_coupon', [App\Http\Controllers\CartController::class, 'applycoupon'])->name('apply_coupon');


//route for instructor-detail page
Route::get('/instructor-details', [App\Http\Controllers\InstructorController::class, 'get_instructor_detail'])->name('instructor.show');

//get degree listing for private lesson form form
Route::post('/get_private_degree', [App\Http\Controllers\DegreeController::class, 'get_private_degree'])->name('get_private_degree');

Route::post('/get_marathon', [App\Http\Controllers\MarathonController::class, 'get_marathon'])->name('get_marathon');

//get degree listing for simulation form
Route::post('/get_simulation_degree', [App\Http\Controllers\DegreeController::class, 'get_simulation_degree'])->name('get_simulation_degree');

Route::get('/marathon/{id}','App\Http\Controllers\MarathonController@showMarathonDetails')->name('marathon.details');

Route::get('/degree/{id}', [App\Http\Controllers\DegreeController::class, 'showDegree'])->name('showDegree');

Route::post('/marathonregister','App\Http\Controllers\MarathonController@marathonRegistartion')->name('marathon.register');

Route::post('/marathonquestion','App\Http\Controllers\MarathonController@storeQuestions')->name('marathon.questions.store');

});

Route::name('front.')->middleware('authuser')->group(function() {

//route for user choose the mcq answwer save in db.
Route::post('/chooseAnswer', [App\Http\Controllers\SimulationController::class, 'chooseAnswer'])->name('chooseAnswer');

Route::post('/correctAnswerList', [App\Http\Controllers\SimulationController::class, 'correctAnswerList'])->name('correctAnswerList');


//route to show profile page after login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//route for updating the profile ofthe user
Route::post('/home', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('home.update');

//route to get my courses listing page purchase by particular user
Route::get('/my-courses', [App\Http\Controllers\MyCoursesController::class, 'index'])->name('my-courses');

//route to sow my course detail page when user wnats to see my course detail page
Route::get('/my-courses/{id}', [App\Http\Controllers\MyCoursesController::class, 'showMyCourse'])->name('mycourse.show');

//route to show single lecture questions answers lists
//Route::get('question_answers/{course_id?}/{lecture_id?}',[App\Http\Controllers\MyCoursesController::class, 'showMyCourse'])->name('question_answers');

// Route for affiliate page
Route::get('/affiliate',[AffiliateController::class,'index'])->name('affiliate');

Route::get('/tickets', [App\Http\Controllers\TicketController::class, 'index'])->name('ticket');
Route::post('/tickets', [App\Http\Controllers\TicketController::class, 'store'])->name('ticket.store');
Route::post('/ticketsmessage', [App\Http\Controllers\TicketController::class, 'updateMessage'])->name('ticket.message.store');
Route::get('/ticket/{id}', [App\Http\Controllers\TicketController::class, 'ShowDetails'])->name('ticket.details');

Route::post('/updateTicket', [App\Http\Controllers\TicketController::class, 'updateTicket'])->name('updateTicket');

Route::post('/addTicket', [App\Http\Controllers\TicketController::class, 'addTicket'])->name('addTicket');

Route::post('/showTicketDetail', [App\Http\Controllers\TicketController::class, 'showTicketDetail'])->name('showTicketDetail');
Route::post('/deleteTicket', [App\Http\Controllers\TicketController::class, 'deleteTicket'])->name('deleteTicket');


});



Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    
    Route::get('/', 'App\Http\Controllers\Admin\AdminLoginController@admin_login')->name('adminLogin');
    
    Route::post('/admin_do_login', 'App\Http\Controllers\Admin\AdminLoginController@admin_do_login')->name('admin_login');
    
    Route::get('/admin_forgot_password', 'App\Http\Controllers\Admin\AdminLoginController@adminforgotpassword')->name('adminforgotpassword');
    
    Route::post('/admin_do_forgotpassword', 'App\Http\Controllers\Admin\AdminLoginController@admin_do_forgotpassword')->name('admin_do_forgotpassword');

    Route::post('/admin_user_forgotpassword', 'App\Http\Controllers\Admin\UsersListController@admin_user_forgotpassword')->name('admin_user_forgotpassword');

    Route::get('/resetuserpassword/{id?}', 'App\Http\Controllers\Admin\UsersListController@admin_user_resetpassword')->name('admin_user_resetpassword');

    Route::post('/set_user_password', 'App\Http\Controllers\Admin\UsersListController@set_user_password')->name('set_user_password');
    
    Route::get('/resetpassword/{token}', 'App\Http\Controllers\Admin\AdminLoginController@admin_resetpassword')->name('admin_resetpassword');
    
    Route::post('/set_password', 'App\Http\Controllers\Admin\AdminLoginController@admin_set_password')->name('admin_set_password');
    
    Route::get('/logout', 'App\Http\Controllers\Admin\AdminLoginController@logout')->name('logout');
    
    Route::get('/dashboard/{from_date?}/{to_date?}', 'App\Http\Controllers\Admin\DashboardController@dashboard')->name('dashboard');

    Route::get('/filtered_data/{from_date?}/{to_date?}', 'App\Http\Controllers\Admin\DashboardController@filtered_data')->name('filtered_data');
    
    Route::get('/graphSegment', 'App\Http\Controllers\Admin\DashboardController@graphSegment')->name('graphSegment');

    Route::get('/admin_profile','App\Http\Controllers\Admin\DashboardController@adminProfile' )->name('adminprofile');
    //route for updating the profile ofthe user
    Route::post('/admin_profile', 'App\Http\Controllers\Admin\DashboardController@updateProfile')->name('update_profile');
    
    Route::post('/admin_profile/password', 'App\Http\Controllers\Admin\DashboardController@changepassword')->name('update_password');
    
    Route::get('/users','App\Http\Controllers\Admin\UsersListController@listing' )->name('userslisting');

    Route::get('/adduser','App\Http\Controllers\Admin\UsersListController@adduser' )->name('adduser');
    
    Route::post('/adduser','App\Http\Controllers\Admin\UsersListController@saveuser' )->name('saveuser'); 

    Route::get('/edituser/{id?}','App\Http\Controllers\Admin\UsersListController@edituser' )->name('edituser'); 

    Route::get('/refunduser/{id?}','App\Http\Controllers\Admin\UsersListController@refunduser' )->name('refunduser'); 

    //route for updating the user
    Route::post('/updateuser', 'App\Http\Controllers\Admin\UsersListController@updateUser')->name('updateuser');

    //route for updating the user
    Route::post('/updatestatus', 'App\Http\Controllers\Admin\UsersListController@updatestatus')->name('updatestatus');

    Route::get('/userlogs/{id?}', 'App\Http\Controllers\Admin\UsersListController@userlogs')->name('userlogs');

    Route::get('/add_comment/{id?}', 'App\Http\Controllers\Admin\UsersListController@add_comment')->name('add_comment');

    Route::post('/saveuserrecommend','App\Http\Controllers\Admin\UsersListController@saveuserrecommend' )->name('saveuserrecommend');

    Route::post('/deletelogs','App\Http\Controllers\Admin\UsersListController@deletelog')->name('deletelog');

    Route::get('/productcategory','App\Http\Controllers\Admin\ProductCategoryController@listing' )->name('productslisting');

    Route::get('/addproductcategory','App\Http\Controllers\Admin\ProductCategoryController@addproductcategory' )->name('addproductcategory');

    Route::post('/addproductcategory','App\Http\Controllers\Admin\ProductCategoryController@saveproductcategory' )->name('saveproductcategory');

    Route::get('/editproductcategory/{id?}','App\Http\Controllers\Admin\ProductCategoryController@editproductcategory' )->name('editproductcategory');
    
    Route::post('/updateproductcategory','App\Http\Controllers\Admin\ProductCategoryController@updateproductcategory')->name('updateproductcategory');
   
    Route::put('/universitystatusupdate','App\Http\Controllers\Admin\ProductCategoryController@universityStatusUpdate')->name('universityStatusUpdate');

    Route::post('/deleteproductcategory','App\Http\Controllers\Admin\ProductCategoryController@deleteproductcategory')->name('deleteproductcategory');
    
    Route::post('/uploadfiles','App\Http\Controllers\Admin\ProductCategoryController@uploadfiles')->name('uploadfiles');

    Route::get('/degrees/{id?}','App\Http\Controllers\Admin\DegreesController@listing' )->name('degreeslisting');

    Route::get('/adddegrees/{id?}','App\Http\Controllers\Admin\DegreesController@adddegrees' )->name('adddegrees'); 
    
    Route::post('/adddegrees','App\Http\Controllers\Admin\DegreesController@savedegree' )->name('savedegree');

    Route::get('/editdegrees/{id?}','App\Http\Controllers\Admin\DegreesController@editdegrees' )->name('editdegrees');

    //route for updating the user
    Route::post('/updatedegree', 'App\Http\Controllers\Admin\DegreesController@updatedegree')->name('updatedegree');

    Route::post('/deletedegree','App\Http\Controllers\Admin\DegreesController@deletedegree')->name('deletedegree');

    Route::get('/questions','App\Http\Controllers\Admin\QuestionsController@listing' )->name('questionlisting');

    Route::get('/addquestions','App\Http\Controllers\Admin\QuestionsController@addquestions' )->name('addquestions');
    
    Route::post('/savequestions','App\Http\Controllers\Admin\QuestionsController@savequestions' )->name('savequestions'); 

    Route::get('/editquestions/{id?}','App\Http\Controllers\Admin\QuestionsController@editquestions' )->name('editquestions'); 

    //route for updating the user
    Route::post('/updatequestions', 'App\Http\Controllers\Admin\QuestionsController@updatequestions')->name('updatequestions');

    Route::post('/deletequestions','App\Http\Controllers\Admin\QuestionsController@deletequestions')->name('deletequestions');
    
    Route::get('/homepage', 'App\Http\Controllers\Admin\HomepageController@index' )->name('home.setting');
	
    Route::post('/homepage', 'App\Http\Controllers\Admin\HomepageController@saveSettings' )->name('home.savesetting');
    
    Route::post('/homepage','App\Http\Controllers\Admin\HomepageController@updateHomepage' )->name('update_homepage');

    Route::get('/tickets', 'App\Http\Controllers\Admin\TicketController@showtickets')->name('tickets');

    Route::get('/tickets/{id}', 'App\Http\Controllers\Admin\TicketController@showDetails')->name('ticketdetails');
   
    Route::post('/tickets', 'App\Http\Controllers\Admin\TicketController@updateMessage')->name('ticket.update');

    Route::post('/ticketstatus', 'App\Http\Controllers\Admin\TicketController@updateStatus')->name('ticket.status');

    Route::get('/packages', 'App\Http\Controllers\Admin\PackageController@index')->name('package');

    Route::post('/packages', 'App\Http\Controllers\Admin\PackageController@store')->name('package.store');

    Route::post('/packagesedit', 'App\Http\Controllers\Admin\PackageController@packageUpdate')->name('package.update');

    Route::post('/packagesaddcourse', 'App\Http\Controllers\Admin\PackageController@packageAddCourse')->name('package.add.course');

    Route::post('/packagedata', 'App\Http\Controllers\Admin\PackageController@getPackage')->name('package.get');

    Route::delete('/packages/{id}', 'App\Http\Controllers\Admin\PackageController@packageDelete')->name('package.delete');

    Route::post('/packagescourse', 'App\Http\Controllers\Admin\PackageController@packageCourseDelete')->name('package.course.delete');
    
    Route::get('/aboutus','App\Http\Controllers\Admin\AboutusController@getabout' )->name('get_aboutus');
    
    Route::post('/aboutus','App\Http\Controllers\Admin\AboutusController@updateabout' )->name('update_aboutus');
    
    Route::get('/contactus','App\Http\Controllers\Admin\ContactusController@getcontact' )->name('get_contactus');
    
    Route::post('/contactus','App\Http\Controllers\Admin\ContactusController@updatecontact' )->name('update_contactus');

    Route::get('/instructors','App\Http\Controllers\Admin\InstructorsController@listing' )->name('instructorlisting');

    Route::get('/addinstructor','App\Http\Controllers\Admin\InstructorsController@addinstructor' )->name('addinstructor');
    
    Route::post('/addinstructor','App\Http\Controllers\Admin\InstructorsController@saveinstructor' )->name('saveinstructor');

    Route::get('/editinstructor/{id?}','App\Http\Controllers\Admin\InstructorsController@editinstructor' )->name('editinstructor');

    //route for updating the user
    Route::post('/updateinstructor', 'App\Http\Controllers\Admin\InstructorsController@updateinstructor')->name('updateinstructor');

    Route::post('/deleteinstructor','App\Http\Controllers\Admin\InstructorsController@deleteinstructor')->name('deleteinstructor');

    Route::get('/coupons','App\Http\Controllers\Admin\CouponsController@listing' )->name('couponslisting');

    Route::get('/addcoupon','App\Http\Controllers\Admin\CouponsController@addcoupon' )->name('addcoupon');
    
    Route::post('/addcoupon','App\Http\Controllers\Admin\CouponsController@savecoupon' )->name('savecoupon'); 

    Route::get('/editcoupon/{id?}','App\Http\Controllers\Admin\CouponsController@editcoupon' )->name('editcoupon'); 

    //route for updating the user
    Route::post('/updatecoupon', 'App\Http\Controllers\Admin\CouponsController@updatecoupon')->name('updatecoupon');

    Route::post('/deletecoupon','App\Http\Controllers\Admin\CouponsController@deletecoupon')->name('deletecoupon');

    Route::get('/products/{id?}/{inst_id?}','App\Http\Controllers\Admin\ProductsController@listing' )->name('Productslisting');

    Route::get('/addproducts/{id?}/{university_id?}','App\Http\Controllers\Admin\ProductsController@addproduct' )->name('addproduct');
    
    Route::post('/addproducts','App\Http\Controllers\Admin\ProductsController@saveproduct' )->name('saveproduct'); 

    Route::get('/editproducts/{id?}/{degree_id?}/{uni_id?}','App\Http\Controllers\Admin\ProductsController@editproduct' )->name('editproduct'); 
    
    Route::get('/editintensiveproducts/{id?}/{degree_id?}/{uni_id?}','App\Http\Controllers\Admin\ProductsController@editintensiveproducts' )->name('editintensiveproducts'); 

    //route for updating the user
    Route::post('/updateproducts', 'App\Http\Controllers\Admin\ProductsController@updateproduct')->name('updateproduct');

    //route for updating the user
    Route::post('/updateintensiveproduct', 'App\Http\Controllers\Admin\ProductsController@updateintensiveproduct')->name('updateintensiveproduct');

    Route::post('/deleteproducts','App\Http\Controllers\Admin\ProductsController@deleteproduct')->name('deleteproduct');

    Route::match(array('GET','POST'),'/blogs','App\Http\Controllers\Admin\BlogsController@listing' )->name('blogslisting');

    Route::get('/addblogs','App\Http\Controllers\Admin\BlogsController@addblog' )->name('addblog');
    
    Route::post('/addblogs','App\Http\Controllers\Admin\BlogsController@saveblog' )->name('saveblog'); 

    Route::get('/editblog/{id?}','App\Http\Controllers\Admin\BlogsController@editblog' )->name('editblog'); 

    //route for updating the user
    Route::post('/updateblog', 'App\Http\Controllers\Admin\BlogsController@updateblog')->name('updateblog');

    Route::post('/deleteblog','App\Http\Controllers\Admin\BlogsController@deleteblog')->name('deleteblog');

    Route::post('/Uploadfiles','App\Http\Controllers\Admin\BlogsController@uploadfiles')->name('Uploadfiles');

    Route::post('/course_Uploadfiles','App\Http\Controllers\Admin\ProductsController@course_Uploadfiles')->name('course_Uploadfiles');

    Route::get('/categories','App\Http\Controllers\Admin\BlogsController@categorylisting' )->name('categorylisting');
    
    Route::post('/addcategory','App\Http\Controllers\Admin\BlogsController@savecategory' )->name('savecategory'); 

    Route::post('/editcategory','App\Http\Controllers\Admin\BlogsController@editcategory' )->name('editcategory'); 

    Route::post('/deletecategory','App\Http\Controllers\Admin\BlogsController@deletecategory')->name('deletecategory');


    Route::get('/transaction-history','App\Http\Controllers\Admin\TransactionsController@showhistory' )->name('showhistory');

    Route::get('/transaction-detail-history/{id?}','App\Http\Controllers\Admin\TransactionsController@showdetailhistory' )->name('showdetailhistory');

    Route::get('/sales','App\Http\Controllers\Admin\TransactionsController@showsales' )->name('showsales');


    Route::get('/events', 'App\Http\Controllers\Admin\EventsController@listings')->name('events');

    Route::get('/addevents', 'App\Http\Controllers\Admin\EventsController@addevent')->name('addevent');

    Route::post('/addevents', 'App\Http\Controllers\Admin\EventsController@saveevent')->name('saveevent');

    Route::get('/viewevent/{id?}', 'App\Http\Controllers\Admin\EventsController@viewevent')->name('viewevent');

    Route::get('/addeventcourses/{id?}', 'App\Http\Controllers\Admin\EventsController@addeventcourses')->name('addeventcourse');

    Route::get('/editevent/{id?}','App\Http\Controllers\Admin\EventsController@editevent' )->name('editevent'); 

    //route for updating the user
    Route::post('/updateevent', 'App\Http\Controllers\Admin\EventsController@updateevent')->name('updateevent');
    
    //route for updating the user
    Route::post('/addeventcourses', 'App\Http\Controllers\Admin\EventsController@addeventcourse')->name('addeventcourses');

    Route::post('/deleteevent','App\Http\Controllers\Admin\EventsController@deleteevent')->name('deleteevent');

    Route::post('/deletecourseevent','App\Http\Controllers\Admin\EventsController@deletecourseevent')->name('deletecourseevent');

    Route::post('/deletegroupevent','App\Http\Controllers\Admin\EventsController@deletegroupevent')->name('deletegroupevent');

    Route::get('/groupedcourses', 'App\Http\Controllers\Admin\GroupedCourseController@groupedcourses')->name('groupedcourses');

    Route::post('/geteditdata', 'App\Http\Controllers\Admin\GroupedCourseController@geteditdata')->name('geteditdata');

    Route::post('/editgroup', 'App\Http\Controllers\Admin\GroupedCourseController@editgroup')->name('editgroup');

    Route::post('/addgroup', 'App\Http\Controllers\Admin\GroupedCourseController@savegroup')->name('savegroup');

    Route::delete('/deletegroup/{id}', 'App\Http\Controllers\Admin\GroupedCourseController@deleteGroup')->name('delete.group');

    Route::post('/addgroupcourse/{id?}', 'App\Http\Controllers\Admin\GroupedCourseController@addgroupcourse')->name('addgroupcourse');

    Route::post('/editgroupcourse/{id?}', 'App\Http\Controllers\Admin\GroupedCourseController@editgroupcourse')->name('editgroupcourse');

    Route::post('/deletecourse','App\Http\Controllers\Admin\GroupedCourseController@deletecourse')->name('deletecourse');

    Route::get('/applicationmanagement', 'App\Http\Controllers\Admin\ApplicationController@application')->name('application');

    Route::get('/viewapplication/{id?}', 'App\Http\Controllers\Admin\ApplicationController@viewapplication')->name('viewapplication');

    Route::get('/addapplication', 'App\Http\Controllers\Admin\ApplicationController@addapplication')->name('addapplication');

    Route::post('/saveapp', 'App\Http\Controllers\Admin\ApplicationController@saveapp')->name('saveapp');

    //route for updating the user
    Route::post('/updateappstatus', 'App\Http\Controllers\Admin\ApplicationController@updateappstatus')->name('updateappstatus');

    //route for updating the user
    Route::post('/update_manager', 'App\Http\Controllers\Admin\ApplicationController@update_manager')->name('update_manager');

    Route::post('/deletechat','App\Http\Controllers\Admin\ApplicationController@deletechat')->name('deletechat');

    Route::post('/revertchat','App\Http\Controllers\Admin\ApplicationController@revertchat')->name('revertchat');

    Route::post('/savesummary','App\Http\Controllers\Admin\ApplicationController@savesummary')->name('savesummary');

    Route::get('/payment-history-category','App\Http\Controllers\Admin\TransactionsController@showhistorycategory' )->name('showhistorycategory');

    Route::get('/quiz/{topic_id?}/{lecture_id?}/{course_id?}','App\Http\Controllers\Admin\QuizController@quizlisting' )->name('quizlisting');

    Route::get('/addquiz','App\Http\Controllers\Admin\QuizController@addquiz' )->name('addquiz');

    Route::post('/savequiz','App\Http\Controllers\Admin\QuizController@savequiz' )->name('savequiz'); 

    Route::get('/editquiz/{id?}','App\Http\Controllers\Admin\QuizController@editquiz' )->name('editquiz');

    //route for updating the user
    Route::post('/updatequiz', 'App\Http\Controllers\Admin\QuizController@updatequiz')->name('updatequiz');

    Route::post('/deletequiz','App\Http\Controllers\Admin\QuizController@deletequiz')->name('deletequiz');

    Route::get('/addquizquestions/{id?}','App\Http\Controllers\Admin\QuizController@addquizquestions' )->name('addquizquestions');

    Route::get('/addquizoptions/{id?}','App\Http\Controllers\Admin\QuizController@addquizoptions' )->name('addquizoptions');

    Route::post('/savequizquestions','App\Http\Controllers\Admin\QuizController@savequizquestions' )->name('savequizquestions'); 

    Route::post('/updatequizquestions','App\Http\Controllers\Admin\QuizController@updatequizquestions' )->name('updatequizquestions'); 

    Route::post('/deletequizquestion','App\Http\Controllers\Admin\QuizController@deletequizquestion')->name('deletequizquestion');

    Route::get('/editquizoptions/{id?}','App\Http\Controllers\Admin\QuizController@editquizoptions' )->name('editquizoptions');

    Route::post('/savelectures','App\Http\Controllers\Admin\ProductsController@savelectures' )->name('savelectures'); 

    Route::post('/get_lecture_data','App\Http\Controllers\Admin\ProductsController@get_lecture_data' )->name('get_lecture_data'); 

    Route::post('/edit_lecture','App\Http\Controllers\Admin\ProductsController@edit_lecture' )->name('edit_lecture');

    Route::post('/deletelecture','App\Http\Controllers\Admin\ProductsController@deletelecture')->name('deletelecture');

    Route::post('/savetopic','App\Http\Controllers\Admin\ProductsController@savetopic')->name('savetopic');

    Route::post('/edit_topic','App\Http\Controllers\Admin\ProductsController@edit_topic')->name('edit_topic');

    Route::post('/get_topic_data','App\Http\Controllers\Admin\ProductsController@get_topic_data' )->name('get_topic_data');

    Route::post('/deletetopic','App\Http\Controllers\Admin\ProductsController@deletetopic')->name('deletetopic'); 

    Route::post('/savecourseqstn','App\Http\Controllers\Admin\ProductsController@savecourseqstn')->name('savecourseqstn'); 

    Route::post('/get_qa_data','App\Http\Controllers\Admin\ProductsController@get_qa_data' )->name('get_qa_data');

    Route::post('/edit_qa','App\Http\Controllers\Admin\ProductsController@edit_qa' )->name('edit_qa');

    Route::post('/deleteqa','App\Http\Controllers\Admin\ProductsController@deleteqa')->name('deleteqa');
    
    Route::get('/pendingmessage','App\Http\Controllers\Admin\AdminLoginController@pendingmessage' )->name('pendingmessage');
    
    Route::get('/programmingerror','App\Http\Controllers\Admin\AdminLoginController@programmingerror' )->name('programmingerror');
    
    Route::get('/paymentmanagement','App\Http\Controllers\Admin\AdminLoginController@paymentmanagement' )->name('paymentmanagement');
    
    Route::get('/responseconfirmation','App\Http\Controllers\Admin\AdminLoginController@responseconfirmation' )->name('responseconfirmation');
    
    Route::get('/recommendation','App\Http\Controllers\Admin\RecommendController@recommendation' )->name('recommendation');
    
    Route::get('/viewrecommendation/{id?}','App\Http\Controllers\Admin\RecommendController@viewrecommendation' )->name('viewrecommendation');
    
    Route::get('/editrecommendation/{id?}','App\Http\Controllers\Admin\RecommendController@editrecommendation' )->name('editrecommendation');
    
    Route::post('/upd_online_recommend','App\Http\Controllers\Admin\RecommendController@upd_online_recommend' )->name('upd_online_recommend');
    
    Route::post('/delete_onlie_recommed','App\Http\Controllers\Admin\RecommendController@delete_onlie_recommed' )->name('delete_onlie_recommed');
    
    Route::delete('/clearNotification','App\Http\Controllers\Admin\AdminNotification@clearNotification' )->name('clear_notification');
    
    
    Route::get('/addrecommendation','App\Http\Controllers\Admin\RecommendController@addrecommendation' )->name('addrecommendation');

    Route::post('/saverecommend','App\Http\Controllers\Admin\RecommendController@saverecommend' )->name('saverecommend');

    Route::post('/updaterecommend','App\Http\Controllers\Admin\RecommendController@updaterecommend' )->name('updaterecommend');

     //route for updating the user
    Route::post('/updatecommentstatus', 'App\Http\Controllers\Admin\RecommendController@updatecommentstatus')->name('updatecommentstatus');

    Route::post('/updateshowhide', 'App\Http\Controllers\Admin\RecommendController@updateshowhide')->name('updateshowhide');

    Route::post('/updateshowposted', 'App\Http\Controllers\Admin\RecommendController@updateshowposted')->name('updateshowposted');

    Route::get('/applicationmanagement-detail', function () {
        return view('admin.applicationmanagement-detail');
    });

    Route::get('/message', function () {
        return view('admin.message');
    });

    Route::get('/notification', function () {
        return view('admin.notification');
    });

    Route::get('/purchasehistory', function () {
        return view('admin.purchasehistory');
    });

    Route::get('/marathon','App\Http\Controllers\Admin\MarathonController@index')->name('marathon');
    Route::get('/marathon/{id}','App\Http\Controllers\Admin\MarathonController@showMarathon')->name('marathon.show');
    Route::get('/marathonquestions','App\Http\Controllers\Admin\MarathonController@showQuestions')->name('marathon.questions');
});