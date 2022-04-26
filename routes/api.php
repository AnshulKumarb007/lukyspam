<?php

use Illuminate\Http\Request;
$api = app('Dingo\Api\Routing\Router');

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

//$api->post('login', 'MobileApps\Auth\LoginController@login');
$api->post('login-with-otp', 'MobileApps\Auth\LoginController@loginWithOtp');
//$api->post('register', 'MobileApps\Auth\RegisterController@register');
$api->post('verify-otp', 'MobileApps\Auth\OtpController@verify');
$api->post('resend-otp', 'MobileApps\Auth\OtpController@resend');
$api->get('days-filter', 'MobileApps\Api\ServiceCustomerController@days_filter');
$api->get('planstatus','MobileApps\Api\PaymentController@planstatuss');
$api->get('invoice-download/{id}/{userid}/{invoiceno}', 'MobileApps\Api\ServiceCustomerController@createPDF');
$api->get('warranty-card/{id}/{userid}', 'MobileApps\Api\ServiceCustomerController@createCard');
$api->get('listby-invoice/{id}', 'MobileApps\Api\ServiceCustomerController@listbyinvoice');
$api->get('invdelete/{id}', 'MobileApps\Api\ServiceCustomerController@invdelete');
$api->get('shistory', 'MobileApps\Api\ServiceCustomerController@shistory');
//$api->post('forgot-password', 'MobileApps\Auth\ForgotPasswordController@forgot');
//$api->post('update-password', 'MobileApps\Auth\ForgotPasswordController@updatePassword');
//$api->get('get-profile', 'MobileApps\Api\ProfileController@index');
//$api->post('update-profile', 'MobileApps\Api\ProfileController@update');
//$api->post('fb-login', 'MobileApps\Auth\LoginController@facebookLogin');
//$api->post('gmail-login', 'MobileApps\Auth\LoginController@gmailLogin');

$api->group(['middleware' => ['customer-api-auth']], function ($api) {
    $api->get('history', 'MobileApps\Api\ServiceCustomerController@history');
    $api->post('service-customer', 'MobileApps\Api\ServiceCustomerController@index');
    $api->post('bank-details-update', 'MobileApps\Api\ProfileController@bankdetails_update');
    $api->post('update-profile', 'MobileApps\Api\ProfileController@update');
    $api->get('viewprofile', 'MobileApps\Api\ProfileController@viewprofiles');
    $api->group(['prefix' => 'requests'], function ($api) {
       /* $api->get('', 'MobileApps\MessageCotroller@index');
        $api->get('interest/{receiver_id}', 'MobileApps\MessageCotroller@sendInterest');
      */
    });

});
$api->post('genrateinv','MobileApps\Api\InvoiceController@store');
$api->get('subscription-list', 'MobileApps\Api\SubscriptionController@index');
$api->get('service-list', 'MobileApps\Api\ServiceController@index');
$api->get('service-customer-list/{serviceid}','MobileApps\Api\ServiceCustomerController@service_customerlist');
$api->get('paymenthistory','MobileApps\Api\PaymentController@index');
$api->get('cusviewdetails/{id}','MobileApps\Api\ServiceCustomerController@viewdetailss');
$api->get('cus-delete/{id}','MobileApps\Api\ServiceCustomerController@deleteviewdetailss');

$api->post('cus-update','MobileApps\Api\ProfileController@updatedetails');
$api->post('customerinvoiceupdate','MobileApps\Api\ServiceCustomerController@updatedetails');

$api->get('genrateorderid','MobileApps\Api\GenrateorderidController@index');
$api->post('storepayment','MobileApps\Api\PaymentController@store');
//$api->get('pdf-recipt/{id}','MobileApps\Api\ServiceCustomerController@pdfGenerator');

/*
$api->get('search-list/{search}', 'MobileApps\Api\CategoryController@search');
$api->get('services-list/{cat_id}', 'MobileApps\Api\ServiceController@services');
$api->post('initate-order', 'MobileApps\Api\OrderController@index');
$api->get('partners/{lat}/{lang}/{order_id}/{partner_type}', 'MobileApps\Api\PartnerController@index');
$api->post('confirm-order', 'MobileApps\Api\OrderController@confirmbook');
$api->get('partner-details/{partner_id}', 'MobileApps\Api\PartnerController@partnerDetails');
$api->get('order-history', 'MobileApps\Api\OrderController@orderhistory');
$api->post('add-cart', 'MobileApps\Api\CartController@addcart');
$api->get('get-complain-customer', 'MobileApps\Api\ComplaintController@index');
$api->get('get-complain-list-customer', 'MobileApps\Api\ComplaintController@complainlist');
$api->post('send-complaient', 'MobileApps\Api\ComplaintController@postcomplain');
$api->get('partner-order-details/{orderId}', 'MobileApps\Api\OrderController@pertnerdetail');
$api->get('service-order-details/{orderId}', 'MobileApps\Api\OrderController@orderservicedetails');
$api->get('cancel-order/{orderId}', 'MobileApps\Api\OrderController@ordercancel');
$api->post('feedback-send', 'MobileApps\Api\FeedbackController@feedback');
$api->get('contact-us', 'MobileApps\Api\FeedbackController@contactus');
$api->post('upload-image', 'MobileApps\Api\CartController@uploadimage');
$api->post('rate-us', 'MobileApps\Api\RatingController@rateus');*/


$api->group(['prefix' => 'partner'], function ($api) {
    /*$api->post('login-with-otp', 'Partner\Auth\LoginController@loginWithOtp');
    $api->post('login', 'Partner\Auth\LoginController@login');
    $api->post('verify-otp', 'Partner\Auth\OtpController@verify');*/

    $api->group(['middleware' => ['partner-api-auth']], function ($api) {

      /*  $api->post('partner-update-kyc', 'Partner\Api\ProfileController@updatekyc');
        $api->get('kyc-details', 'Partner\Api\ProfileController@kycdetails');
        $api->get('profile', 'Partner\Api\ProfileController@profile');
        $api->get('rate-master-category', 'Partner\Api\RateMasterController@index');
        $api->get('rate-master-servicelist/{catId}', 'Partner\Api\RateMasterController@servicelist');
        $api->get('customer-care', 'Partner\Api\CustomerCareController@index');*/
    });

});
/*
$api->get('customer-balance', 'MobileApps\Api\WalletController@userbalance');
$api->get('wallet-history', 'MobileApps\Api\WalletController@index');
$api->post('recharge','MobileApps\Api\WalletController@addMoney');
$api->post('verify-recharge','MobileApps\Api\WalletController@verifyRecharge');
//
$api->get('home', 'MobileApps\Api\HomeController@index');

$api->get('customer-address', 'MobileApps\Api\CustomerAddressController@getcustomeraddress');
$api->post('add-customer-address', 'MobileApps\Api\CustomerAddressController@addcustomeraddress');
$api->get('products/{cat_id}/{subcat_id}', 'MobileApps\Api\ProductController@products');
$api->get('search-products/{search}', 'MobileApps\Api\ProductController@search_products');
$api->get('product-details/{product_id}', 'MobileApps\Api\ProductController@product_detail');
$api->post('add-cart', 'MobileApps\Api\CartController@addcart');
$api->get('get-cart', 'MobileApps\Api\CartController@getCartDetails');
$api->post('update-customer-address/{id}', 'MobileApps\Api\CustomerAddressController@addressupdate');
$api->get('get-address-detail/{id}', 'MobileApps\Api\CustomerAddressController@getaddressdetail');
$api->get('membership-list', 'MobileApps\Api\MemberShipController@index');

//privacy-policy url
$api->get('privacy-policy', 'SuperAdmin\UrlController@privacy');
$api->get('about-us', 'SuperAdmin\UrlController@about');
$api->get('terms-condition', 'SuperAdmin\UrlController@termscond');

//loginbanner
$api->get('login-banner', 'MobileApps\Api\HomeController@login_Banner');
$api->get('active-address/{id}', 'MobileApps\Api\CustomerAddressController@deliveryaddressactive');*/

