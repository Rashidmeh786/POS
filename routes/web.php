<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Pos\PosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Pos\SaleController;
use App\Http\Controllers\Unit\UnitController;
use App\Http\Controllers\Roles\RoleController;
use App\Http\Controllers\Brand\BrandController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Salary\SalaryController;
use App\Http\Controllers\Expense\ExpenseController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\employee\EmployeeController;
use App\Http\Controllers\Purchase\PurchaseController;
use App\Http\Controllers\Supplier\SupplierController;
use App\Http\Controllers\adjustment\AdjustmentController;
use App\Http\Controllers\Attendance\AttendenceController;
// this is test line
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/admin.logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth'])->group(function () {
    
Route::get('/admin.profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
Route::Post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

Route::get('/changePassword', [AdminController::class, 'changePassword'])->name('changePassword');
Route::Post('/update/password', [AdminController::class, 'UpdatePassword'])->name('update.password');


});


Route::controller(AdminController::class)->group(function(){

    Route::get('/all/users','Allusers')->name('all.users');
    Route::get('/add/user','AddUser')->name('add.user');
    Route::post('/store/user','StoreUser')->name('user.store');
    Route::get('/edit/user/{id}','EditUser')->name('edit.user');
    Route::post('/update/user','UpdateUser')->name('update.user');
    Route::get('/delete/user/{id}','DeleteUser')->name('delete.user');
   
   
   });

/// Employee All Route 
// Route::controller(EmployeeController::class)->group(function(){

//     Route::get('/all/employee','AllEmployee')->name('all.employee');
    
//     });



Route::controller(EmployeeController::class)->group(function(){

    Route::get('/all/employees','AllEmployee')->name('all.employee');
    Route::get('/add/employee','AddEmployee')->name('add.employee');
    Route::post('/store/employee','StoreEmployee')->name('employee.store');
    Route::get('/edit/employee/{id}','EditEmployee')->name('edit.employee');
    Route::post('/update/employee','UpdateEmployee')->name('employee.update');
    Route::get('/delete/employee/{id}','DeleteEmployee')->name('delete.employee');


                    // Designations
                    Route::get('/all/designations','AllDesignations')->name('all.designation');
                    Route::post('/store/designations','StoreDesignations')->name('designation.store');
                    Route::get('edit_designation/{id}','EditDesignation')->name('edit.designation');
                    Route::post('/update/designation/{id}','UpdateDesignation')->name('designation.update');
                    Route::get('delete_designation/{id}','DeleteDesignation')->name('delete.designation');

                            //departments

                    Route::get('/all/departments','AllDepartments')->name('all.department');
                    Route::post('/store/departments','StoreDepartments')->name('department.store');
                    Route::get('edit_department/{id}','EditDepartment')->name('edit.department');
                    Route::post('/update/department/{id}','UpdateDepartment')->name('departments.update');
                    Route::get('delete_department/{id}','DeleteDepartment')->name('delete.department');
                
 
    });

    Route::controller(CustomerController::class)->group(function(){

        Route::get('/all/customer','AllCustomer')->name('all.customer');
        Route::get('/add/customer','AddCustomer')->name('add.customer');
        Route::post('/store/customer','StoreCustomer')->name('customer.store');
        Route::get('/edit/customer/{id}','EditCustomer')->name('edit.customer');
        Route::post('/update/customer','UpdateCustomer')->name('customer.update');
        Route::get('/delete/customer/{id}','DeleteCustomer')->name('delete.customer');
        Route::get('/details/customer/{id}','DetailsCustomer')->name('details.customer');
        Route::post('/store/newcustomer','StoreNewCustomer')->name('newcustomer.store'); // ajax request for adding new customer in pos page


        });
      

        Route::controller(SupplierController::class)->group(function(){

            Route::get('/all/supplier','AllSupplier')->name('all.supplier');
            Route::get('/add/supplier','AddSupplier')->name('add.supplier');
            Route::post('/store/supplier','StoreSupplier')->name('supplier.store');
            Route::get('/edit/supplier/{id}','EditSupplier')->name('edit.supplier');
            Route::post('/update/supplier','UpdateSupplier')->name('supplier.update');
            Route::get('/delete/supplier/{id}','DeleteSupplier')->name('delete.supplier');
            Route::get('/details/supplier/{id}','DetailsSupplier')->name('details.supplier');
            });



                Route::controller(ProductController::class)->group(function(){

                    Route::get('/all/product','AllProduct')->name('all.product');
                    Route::get('/add/product','AddProduct')->name('add.product');
                    Route::post('/store/product','StoreProduct')->name('product.store');
                    Route::get('/edit/product/{id}','EditProduct')->name('edit.product');
                    Route::post('/update/product','UdateProduct')->name('product.update');
                    Route::get('/delete/product/{id}','DeleteProduct')->name('delete.product');
                    Route::get('/barcode/product/{id}','BarcodeProduct')->name('barcode.product');
                    Route::post('ajaxcategory/store','Storecategoryajax')->name('ajaxcategory.store');  //--ajax request
                    Route::post('ajaxbrand/store','Storebrandajax')->name('ajaxbrand.store');  //--ajax request
                    Route::post('ajaxunit/store','Storeunitajax')->name('ajaxunit.store');  //--ajax request

                    });


                    Route::controller(AdjustmentController::class)->group(function(){

                        Route::get('/create/adjustment','addadjustment')->name('create.adjustment');
                Route::post('/store/adjustment','createadjustment')->name('store.adjustment');
                Route::get('/all/adjustment','alladjustment')->name('all.adjustment');
        Route::get('/details/adjustment/{id}','DetailsAdjustment')->name('details.adjustment');

        Route::get('/adjustment/details/download/{id}','PrintInvoice')->name('print.adjustment');

    
        Route::get('/adjustment/reason/{id}','AdjustmentResonAjax');


                       
                        });


                    Route::controller(CategoryController::class)->group(function(){

                        Route::get('/all/category','AllCategory')->name('all.category'); 
                        Route::post('/store/category','Storecategory')->name('category.store');

                        Route::get('edit_Category/{id}','Editcategory')->name('edit.category');
                        Route::post('/update/category/{id}','Updatecategory')->name('category.update');
                        Route::get('delete_category/{id}','Deletecategory')->name('delete.category');

                        
                        });

                        Route::controller(UnitController::class)->group(function(){

                            Route::get('/all/unit','Allunit')->name('all.unit'); 
                            Route::post('/store/unit','Storeunit')->name('unit.store');
                            Route::get('edit_Unit/{id}','Editunit')->name('edit.unit');
                            Route::post('/update/unit/{id}','Updateunit')->name('unit.update');
                            Route::get('delete_unit/{id}','Deleteunit')->name('delete.unit');
                            
                            });


                            Route::controller(BrandController::class)->group(function(){

                                Route::get('/all/brand','Allbrand')->name('all.brand'); 
                                Route::post('/store/brand','Storebrand')->name('brand.store');
                                Route::get('edit_Brand/{id}','Editbrand')->name('edit.brand');
                                Route::post('/update/brand/{id}','Updatebrand')->name('brand.update');
                                Route::get('delete_brand/{id}','Deletebrand')->name('delete.brand');
                                
                                });
        
            Route::controller(ExpenseController::class)->group(function(){

           Route::get('/add/expense','AddExpense')->name('add.expense');
                                    
     });



     Route::controller(PosController::class)->group(function(){

        Route::get('/pos','Pos')->name('pos');
        Route::post('/add-cart','AddCart');
        Route::get('/allitem','AllItem');
       
        Route::post('/cart-update/{rowId}','CartUpdate');

        Route::get('/cart-remove/{rowId}','CartRemove');
       
        Route::post('/create-invoice','CreateInvoice');
        Route::get('/product-details/{rowId}','getProductDetails');      //pos_page1 code
        Route::post('create-sale-invoice','CreatesaleInvoice');  //pos_page1 code
        

       });
       
       Route::controller(SaleController::class)->group(function(){

        Route::get('/add/sale','addsale')->name('add.sale');
        Route::post('/store/sale','createinvoice')->name('store.sale');

        Route::get('/searchSaleProduct', 'searchproduct')->name('saleproduct.search');
        Route::post('/final-invoice/sale','FinalInvoice');
       
        

       });
       

       Route::controller(SalaryController::class)->group(function(){

        Route::get('/pay/salary','PaySalary')->name('pay.salary');
        Route::get('/pay/now/salary/{id}','PayNowSalary')->name('pay.now.salary');
        Route::post('/employe/salary/store','EmployeSalaryStore')->name('employe.salary.store');
        Route::get('/month/salary','MonthSalary')->name('month.salary');
        Route::get('employee/salary/history/{id}','EmployeeSalaryHistory')->name('salary.history');
        // Route::get('/print-report/{id}', 'printReport')->name('salary.printReport');
        Route::get('print/salary/report/{id}', 'printReport')->name('salary.printEmpReport');

        Route::get('/list/unpaid/salary','unpaid_salaries')->name('unpaid.salary');
        Route::post('/employe/pay/unpaidsalary','EmployeunpaidSalaryStore')->name('salary.pay_unpaid_salary');


        

        Route::get('/add/advance/salary','AddAdvanceSalary')->name('add.advance.salary');
        Route::post('/advance/salary/store','AdvanceSalaryStore')->name('advance.salary.store');
        
 Route::get('/all/advance/salary','AllAdvanceSalary')->name('all.advance.salary');

 Route::get('/edit/advance/salary/{id}','EditAdvanceSalary')->name('edit.advance.salary');
 Route::post('/advance/salary/update','AdvanceSalaryUpdate')->name('advance.salary.update');
 Route::get('/delete/advanceSalary/{id}','DeleteadvanceSalary')->name('delete.advanceSalary');
 
        });

        Route::controller(AttendenceController::class)->group(function(){

            Route::get('/employee/attend/list','EmployeeAttendenceList')->name('employee.attendance.list'); 
            Route::get('/add/employee/attend','AddEmployeeAttendence')->name('add.employee.attend'); 
            Route::post('/employee/attend/store','EmployeeAttendenceStore')->name('employee.attend.store'); 
            Route::get('/edit/employee/attend/{date}','EditEmployeeAttendence')->name('employee.attend.edit'); 
            // Route::get('/edit/employee/attend/{date}','EditEmployeeAttendence')->name('employee.attend.edit'); 
            Route::get('/view/employee/attend/{date}','ViewEmployeeAttendence')->name('employee.attend.view'); 
            Route::get('/view/employee/attend/history/{id}','ViewEmployeeAttendenceHistory')->name('employee.attend.history'); 

        Route::get('/print-report/{id}', 'printReport')->name('attendance.printReport');
          

            });
        

            Route::controller(RoleController::class)->group(function(){

                Route::get('/all/permission','AllPermission')->name('all.permission');
                Route::get('/add/permission','AddPermission')->name('add.permission');
                Route::post('/store/permission','StorePermission')->name('permission.store');
                Route::get('/edit/permission/{id}','EditPermission')->name('edit.permission');

                Route::post('/update/permission','UpdatePermission')->name('permission.update');
                 Route::get('/delete/permission/{id}','DeletePermission')->name('delete.permission');
                                // Roles
                                
                 Route::get('/all/roles','AllRoles')->name('all.roles');
                //  Route::get('/add/roles','AddRoles')->name('add.roles');
                 Route::post('/store/roles','StoreRoles')->name('roles.store');
                 Route::get('/edit/roles/{id}','EditRoles')->name('edit.role');
                 Route::post('/update/roles','UpdateRoles')->name('roles.update');
                 Route::get('/delete/roles/{id}','DeleteRoles')->name('delete.role');
                 Route::get('/add/roles/permission','AddRolesPermission')->name('add.roles.permission');
                 Route::post('/role/permission/store','StoreRolesPermission')->name('role.permission.store');
                 
                    Route::get('/all/roles/permission','AllRolesPermission')->name('all.roles.permission');
                    Route::get('/admin/edit/roles/{id}','AdminEditRoles')->name('admin.edit.roles');
                    Route::get('/admin/delete/roles/{id}','AdminDeleteRoles')->name('admin.delete.roles');

                Route::post('/role/permission/update/{id}','RolePermissionUpdate')->name('role.permission.update');
               });


               Route::controller(OrderController::class)->group(function(){

                Route::post('/final-invoice','FinalInvoice');
               
                Route::get('/pending/order','PendingOrder')->name('pending.order');
                Route::get('/order/details/{order_id}','OrderDetails')->name('order.details');
                Route::post('/order/status/update','OrderStatusUpdate')->name('order.status.update');
                Route::get('/complete/order','CompleteOrder')->name('complete.order');
                Route::get('print/invoice','invoiceprint')->name('printInvoice');

                Route::get('/stock','StockManage')->name('stock.manage');
                Route::get('/order/invoice-download/{order_id}','OrderInvoice')->name('order.invoiceprint');
                Route::get('/pending/due','PendingDue')->name('pending.due');
                Route::get('/all/sales','AllSales')->name('all.sales');

                Route::get('/order/due/{id}','OrderDueAjax');
                Route::post('/update/due','UpdateDue')->name('update.due');
               
               });


               Route::controller(PurchaseController::class)->group(function(){
                Route::get('/add/purchase','addpurchase')->name('add.purchase');
                Route::post('/store/purchase','createinvoice')->name('store.purchase');

                Route::get('/search', 'searchproduct')->name('product.search');
                Route::post('/final-invoice/purchase','FinalInvoice');
                Route::get('/all/purchase','allpurchases')->name('all.purchase');
                Route::get('/purchase/due/{id}','PurchaseOrderDueAjax');
                Route::post('/updatePurchase/due','UpdateDue')->name('updatePurchase.due');
                Route::get('/purchaseorder/details/{order_id}','PurchaseOrderDetails')->name('purchaseorder.details');
                Route::post('/purchaseorder/status/update','PurchaseOrderStatusUpdate')->name('purchaseorder.status.update');
                Route::get('/complete/purchaseorder','CompletePurchaseOrder')->name('complete.purchaseorder');
                Route::get('/purchaseorder/invoice-download/{order_id}','OrderInvoice')->name('purchase.invoicePrint');
                Route::get('/pending/porder','PendingPurchaseOrder')->name('pending.purchaseorder');
                Route::get('/purchase/return/{id}','PurchaseReturn')->name('return.purchaseorder');

                
               });

            //    Route::get('/product/details/{productId}',[PurchaseController::class],'searchproduct'  )->name('product.details');
               Route::get('/product/details/{productId}', [PurchaseController::class, 'productDetails'])->name('product.details');
               Route::get('/saleproduct/details/{productId}', [SaleController::class, 'productDetails'])->name('product.details');


