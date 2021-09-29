<?php

use Illuminate\Support\Facades\Route;

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

Route::get('updatecommon', 'CommonController@updateSlug');

Route::group(['prefix' => 'administration','namespace'=> 'Admin','middleware' => 'auth:administration'], function()
{
    Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    Route::resource('admins','AdminController');

    Route::get('/mailbox','MailboxController@inbox')->name('admin.mailbox');
    Route::get('/maildetails/{id}','MailboxController@details')->name('admin.maildetails');
    Route::get('/newmail','MailboxController@newMail')->name('admin.newmail');
    Route::post('/newmailaction','MailboxController@mailSendAction')->name('admin.newmailaction');
    Route::get('/sentmail','MailboxController@sentmail')->name('admin.sentmail');
    Route::get('/draftmail','MailboxController@draftmail')->name('admin.draftmail');
    Route::any('/getautosellers', 'MailboxController@autocomplete')->name('admin.getautosellers');
    Route::post('/mailreply','MailboxController@mailReply')->name('admin.mailreply');


    // Product Module Routes
	
	Route::get('getbrand','ProductController@ajaxGetBrand')->name('admin.getbrand');
    Route::get('addnewbrand','ProductController@addNewBrand')->name('admin.addnewbrand');
	
    Route::get('product','ProductController@index')->name('product.index');
	Route::get('product/feature','ProductController@feature')->name('product.feature');
	Route::get('product/create','ProductController@create')->name('product.create');
	Route::post('product/store','ProductController@store')->name('admin.product.store');

	Route::get('copyproduct/{id}','ProductController@copyListing')->name('admin.copyproduct');
	Route::get('editproduct','ProductController@edit')->name('admin.editproduct');
	Route::patch('product/{product}','ProductController@update')->name('admin.product.update');

    Route::get('/product/ajaxsearch','ProductController@searchajax')->name('product.ajaxsearch');
    Route::get('/product/ajaxsearch1','LastcategoryController@searchajax1')->name('ajaxsearch1');
    Route::get('/product/ajaxsearch2','SubsubCategoryController@searchajaxSubcategory')->name('ajaxsearch2');


    Route::get('ajaxcheckcode','ProductController@checkPCodes')->name('admin.ajaxcheckcode');

    // Guest Customer Routes
    Route::get('guest/list', 'GuestAdminController@guestIndex')->name('admin.guest.list');
    Route::get('guest/edit/{id}', 'GuestAdminController@guest_edit')->name('admin.guest.edit');

    // Seller Orders Routes
    Route::get('/orders','AdminSellerOrderController@index')->name('orders');
    Route::get('/orders/{id}', 'AdminSellerOrderController@show')->name('orders.details');

	// Route::get('/ajaxorderreturn','AdminOrderController@ajaxReturn')->name('aleshamart_orders.ajaxorderreturn');
	// Route::post('/returnorder', array('uses' => 'AdminOrderController@returnorder'))->name('aleshamart_orders.returnorder');
	// Route::post('/returninvoice', array('uses' => 'AdminOrderController@returninvoice'))->name('aleshamart_orders.returninvoice');

    // Customer Routes
    // Route::get('guest/list', 'CustomerAdminController@guestIndex')->name('admin.guest.list');
	// Customer Routes
    // Route::get('guest/list', 'CustomerAdminController@guestIndex')->name('admin.guest.list');
	Route::get('customer/details/{id}', 'CustomerAdminController@customer_details')->name('admin.customer.details');
	Route::get('customer/edit/{id}', 'CustomerAdminController@customer_edit')->name('admin.customer.edit');
	Route::post('customer/update/{id}', 'CustomerAdminController@customer_update')->name('admin.customer.update');
	Route::get('customer/total_orders/{seller_id}', 'CustomerAdminController@total_orders')->name('admin.customer.total_orders');
	Route::get('customer/unshipped_orders/{seller_id}', 'CustomerAdminController@unshipped_orders')->name('admin.customer.unshipped_orders');
	Route::get('customer/complete_orders/{seller_id}', 'CustomerAdminController@complete_orders')->name('admin.customer.complete_orders');
	Route::get('customer/canceled_orders/{seller_id}', 'CustomerAdminController@canceled_orders')->name('admin.customer.canceled_orders');
	Route::get('customer/returned_orders/{seller_id}', 'CustomerAdminController@returned_orders')->name('admin.customer.returned_orders');

    // Merchant Routes
    Route::get('merchant/details/{seller_id}', 'MerchantController@details')->name('merchant.details');
    Route::get('merchant/total_orders/{seller_id}', 'MerchantController@total_orders')->name('merchant.total_orders');
	Route::get('merchant/unshipped_orders/{seller_id}', 'MerchantController@unshipped_orders')->name('merchant.unshipped_orders');
	Route::get('merchant/complete_orders/{seller_id}', 'MerchantController@complete_orders')->name('merchant.complete_orders');
	Route::get('merchant/canceled_orders/{seller_id}', 'MerchantController@canceled_orders')->name('merchant.canceled_orders');
	Route::get('merchant/returned_orders/{seller_id}', 'MerchantController@returned_orders')->name('merchant.returned_orders');
	Route::get('merchant/otal_product/{seller_id}', 'MerchantController@total_products')->name('merchant.total_product');
    Route::get('merchant/accounts/{seller_id}', 'MerchantController@accounts')->name('merchant.accounts');
	
	Route::any('sellerapproval', 'MerchantController@approvedAccount');
	Route::any('disapprovalAccount', 'MerchantController@disapproveAccount');
	Route::post('/delete/{id}', 'MerchantController@delete')->name('merchant.delete');

    Route::get('getAllPermission', 'PermissionController@getPermission');

	Route::resource('customer','CustomerAdminController');
    Route::resource('merchant','MerchantController');


    Route::resource('role','RoleController');
    Route::resource('returncause','ReturnCauseController');
    Route::resource('news','NewsController');
    Route::resource('category','CategoryController');
    Route::resource('subcategory','SubcategoryController');
    Route::resource('subsubcategory','SubsubCategoryController');
    Route::resource('lastcategory','LastcategoryController');
    Route::resource('category_variation','CategoryvariationController');
    Route::resource('cupon','CuponController');
    Route::resource('cupon_user','CuponUserController');
    Route::resource('sellermenus','SellerMenusController');
    Route::resource('sellercontents','SellerContentController');
    Route::resource('permission','PermissionController');
    Route::resource('group','GroupController');
    Route::resource('service','ServiceController');
    Route::resource('banner','BannerController');
    Route::resource('offer','OfferController');
	Route::resource('special_offer','SpecialOfferController');
	Route::resource('content','ContentController');
    Route::resource('menu','MenuController');
    Route::resource('brand','BrandController');
	Route::resource('companyprofile','CompanyProfileController');
    Route::resource('blog','BlogController');
    Route::resource('blogcategory','BlogCategoryController');
    Route::resource('faq','FaqController');
    Route::resource('faqtopic','FaqTopicController');

   //**************************************Campaign routes*********************************************************
    Route::any('permissionscampaign', 'CommonController@permissionsCampaign');
    Route::resource('campaign','CampaignController');
    Route::resource('campaign_sub','SubcampaignController');
    Route::resource('campaign_seller','CampaignSellerController');
    Route::get('/activecampaign', 'CampaignController@activecampaign')->name('campaign.active');
    Route::get('/activecampaign_seller', 'CampaignSellerController@activecampaign_seller')->name('campaign_seller.active');
    Route::get('/campaign_product/all', 'CampaignProductController@allproducts')->name('campaign_product.index');
    Route::get('/campaign_product/assigned', 'CampaignProductController@assignedproducts')->name('campaign_product.allproducts');
    Route::get('/ajaxcampaignseller', 'CampaignProductController@ajaxSubCampaign')->name('admin.campaign.subcampaign');
    Route::get('/ajaxcampaignsellerproducts', 'CampaignProductController@ajaxCampaignSellersProducts')->name('admin.campaign.products');
    Route::get('/ajaxcampaignsellerprod', 'CampaignProductController@ajaxCampaignSellersProd')->name('admin.campaign.sellers.prod');
    // Route::get('/ajaxcampaignsellerlist', 'CampaignProductController@ajaxCampaignSellersList')->name('admin.campaign.sellers.list');
    Route::post('/campaignproducts', 'CampaignProductController@store')->name('admin.campaign.sellers.products.action');
    Route::post('/campaignproducts11', 'CampaignProductController@storePercentage')->name('admin.campaign.sellers.products.percentage');
    ///////////////////////////////////////////////////////////////////////////////////////////


    Route::any('masterdelete', 'CommonController@deletedata');
	Route::any('permissions', 'CommonController@permissions');
	Route::any('changestatus', 'CommonController@changestatus');
	Route::get('updatecommon', 'CommonController@updateSlug');

    Route::get('generate-code','ProductController@codeGeneration')->name('admin.codegeneration');
    Route::get('add/feature/{id}', 'ProductController@addfeature')->name('admin.add.feature');

    //******************************************Order*************************************************************//
    /*Route::get('orderlist', 'AdminOrderController@index')->name('admin.orderlist');
    Route::get('order/reports','AdminOrderController@reports')->name('admin.order.reports');
    Route::get('orderdetail/{id}', 'AdminOrderController@show')->name('admin.orderdetail');
    Route::get('/ajaxordercancel','AdminOrderController@ajaxCancel')->name('admin.ajaxordercancel');
    Route::get('/ajaxorder','AdminOrderController@ajaxOrdrs')->name('admin.ajaxorder');*/

	  /****************************** Order *************************************************/
    Route::get('orderlist', 'AdminOrderController@index')->name('admin.orderlist');
    Route::get('orderdetail/{id}', 'AdminOrderController@show')->name('admin.orderdetail');
    Route::get('shedulepickup/{id}', 'AdminOrderController@shedulePickup')->name('admin.pickupshedule');
    Route::post('/order/confirm-shipment', 'AdminOrderController@confirmShipment')->name('admin.order.confirmshipment');
    Route::post('/order/confirm-pickup', 'AdminOrderController@confirmPickup')->name('admin.order.confirmpickup');

    Route::get('/pickupsuccess', 'AdminOrderController@pickupsuccess')->name('admin.pickupsuccess');
    Route::get('/ajaxorder','AdminOrderController@ajaxOrdrs')->name('admin.ajaxorder');
    Route::get('printinvoice/{id}/{slug}', 'AdminOrderController@invoice')->name('admin.printinvoice');
    Route::get('generateInvoice/{id}/{slug}', 'AdminOrderController@invoice')->name('admin.invoice');
    Route::get('packateslip/{id}', 'AdminOrderController@packateslip')->name('admin.packateslip');

    Route::get('/shippedinvoice/{id}', 'AdminOrderController@shipped_invoice')->name('admin.shippedinvoice');

    Route::get('order/reports','AdminOrderController@reports')->name('admin.order.reports');
    Route::get('/order/download/{type}', 'AdminOrderController@downloadExcel');
    Route::get('/order/changeStatus', 'AdminOrderController@changeStatus')->name('admin.orderStatusChange');
    Route::get('/ajaxeasyship','AdminOrderController@easyShipCalculation')->name('admin.ajaxeasyship');

    Route::get('/ajaxordercancel','AdminOrderController@ajaxCancel')->name('admin.ajaxordercancel');
    //Route::post('/cancelorder', array('uses' => 'AdminOrderController@cancelorder'))->name('admin.cancelorder');
    Route::post('/cancelorder', 'AdminOrderController@cancelorder')->name('admin.cancelorder');

    Route::get('/ajaxorderreturn','AdminOrderController@ajaxReturn')->name('admin.ajaxorderreturn');
    Route::post('/returnorder', array('uses' => 'AdminOrderController@returnorder'))->name('admin.returnorder');
    Route::post('/returninvoice', array('uses' => 'AdminOrderController@returninvoice'))->name('admin.returninvoice');

	Route::get('/ajaxsearch','ProductController@searchajax')->name('admin.ajaxsearch');
	Route::get('/ajaxcheckcodevariation','ProductController@checkPCodesVariation')->name('admin.ajaxcheckcodevariation');
	Route::get('/ajaxtaxcode','ProductController@searchTaxCode')->name('admin.ajaxtaxcode');
	Route::get('/ajaxCategoryVariation','ProductController@ajaxCategoryVariation')->name('admin.ajaxcatvariation');
	Route::get('/variationKeysajax','ProductController@variationKeysValue')->name('admin.variationKeysajax');	
	Route::get('/ajaxvariation','ProductController@ajaxVariation')->name('admin.ajaxvariation');
	
	
	Route::post('/import','ProductController@ImportProduct')->name('import.product');
    Route::get('/export','ProductController@ExportProduct')->name('export.product');

    Route::get('/order/export','AdminOrderController@ExportOrderReport')->name('export.order.report');

	//****************************************************Account**********************************************************************
    Route::any('/merchant/finance/report',   'SellePaymentController@index')->name('admin.seller.balance');
    Route::post('/paid','SellePaymentController@payments')->name('admin.paid');
    Route::any('/merchant/current/balance',   'SellePaymentController@sellerCurrentBalance')->name('admin.sellercurrentbalance');

     // Route for PO GENERATION
     Route::get('generate/po', 'ReportController@generatePO')->name('admin.generate.po');
     Route::get('download/po/{id}', 'ReportController@poDownloadFromStorage')->name('admin.download.po');
     Route::get('view/generated/po', 'ReportController@viewPO')->name('admin.view.generated.po');
     Route::get('download/generated/po/{id}', 'ReportController@downloadGeneratedPO')->name('admin.download.generated.po');
     Route::get('po/log', 'ReportController@POLog')->name('admin.po.log');

	//Notification type
    Route::get('/notification/type','NotificationController@notificationType')->name('notification.type');
    Route::get('/create/notification/type','NotificationController@createNotificationType')->name('create.notification.type');
    Route::post('/notification/type/store','NotificationController@notificationTypeStore')->name('notification.type.store');
    Route::get('/notification/type/edit/{id}','NotificationController@notificationTypeEdit')->name('notification.type.edit');
    Route::post('/notification/type/update','NotificationController@notificationTypeUpdate')->name('notification.type.update');

	//Notification Template type
    Route::get('/notification/template','NotificationController@notificationTemplate')->name('notification.template');
    Route::get('/create/notification/template','NotificationController@createNotificationTemplate')->name('create.notification.template');
    Route::post('/notification/template/store','NotificationController@notificationTemplateStore')->name('notification.template.store');
    Route::get('/notification/template/edit/{id}','NotificationController@notificationTemplateEdit')->name('notification.template.edit');
    Route::post('/notification/template/update','NotificationController@notificationTemplateUpdate')->name('notification.template.update');
    Route::post('/notification/template/ajax','NotificationController@notificationTypeAjax')->name('notification.template.ajax');

    //Notification User type
    Route::get('/notification/user/type','NotificationController@notificationUserType')->name('notification.user.type');
    Route::get('/notification/user/type/create','NotificationController@notificationUserTypeCreate')->name('notification.user.type.create');
    Route::post('/notification/user/type/store','NotificationController@notificationUserTypeStore')->name('notification.user.type.store');
    Route::get('/notification/user/type/edit/{id}','NotificationController@notificationUserTypeEdit')->name('notification.user.type.edit');
    Route::post('/notification/user/type/update','NotificationController@notificationUserTypeUpdate')->name('notification.user.type.update');
    Route::post('/notification/user/type/delete','NotificationController@notificationUserTypeDelete')->name('notification.user.type.delete');


    // Notification route here
    Route::get('/index/notification','NotificationController@indexNotification')->name('notification.index');
    Route::get('/create/notification','NotificationController@createNotification')->name('admin.create.notification');
    Route::post('/notification/store','NotificationController@storeNotification')->name('notification.store');
    Route::get('/notification/edit/{id}','NotificationController@notificationEdit')->name('notification.edit');
    Route::post('/notification/update','NotificationController@notificationUserUpdate')->name('notification.update');

	// Rewards category
	Route::resource('rewards-category','RewardsCategoryController');
    Route::resource('rewards-earning','RewardsEarningController');
    Route::resource('rewards-value','RewardsValueController');
    Route::resource('partner-manage','PartnerManageController');
    Route::resource('partner-rewards-value','PartnerRewardsValueController');
	
	Route::get('districts/{id}', function($id){
        return json_encode(App\Models\District::where('division_id', $id)->get());
    });
    Route::get('areas/{id}', function($id){
        return json_encode(App\Models\Area::where('district_id', $id)->get());
    });

    // Ajax Routes for category, first category, second category
    Route::get('sub-categories/{id}', function($id){
        return json_encode(App\Models\Subcategory::where('category_id', $id)->get());
    });
    Route::get('sub-subcategories/{id}', function($id){
        return json_encode(App\Models\Subsubcategory::where('subcat_id', $id)->get());
    });
    // Ajax Routes for get partners 
    Route::get('partners-rewards-value/{id}', function($id){
        return json_encode(App\Models\PartnerManage::where('rewards_category_id', $id)->get());
    });




});

require __DIR__.'/auth.php';



/*----------------------------------add to cart----------------------------------------------*/


