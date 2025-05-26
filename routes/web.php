<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\employeesController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

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
    return view('welcome');
});

Route::middleware(['middleware'=>'PreventBackHistory'])->group(function () {
    Auth::routes();
});
Auth::routes(['register' => false]);
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth','PreventBackHistory'])->group(function () {
Route::get('dashboard', [AdminController::class,'index'])->name('admin.dashboard');
Route::get('Profile', [AdminController::class,'profile'])->name('admin.profile');
Route::get('/department/add', [DepartmentController::class, 'create'])->name('department.add');
Route::get('/department/view', [DepartmentController::class, 'view'])->name('department.view');
Route::post('/department/store', [DepartmentController::class, 'store'])->name('department.store');
Route::get('/department/edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
Route::post('/department/update/{id}', [DepartmentController::class, 'update'])->name('department.update');
Route::get('/department/delete/{id}', [DepartmentController::class, 'delete'])->name('department.delete');
Route::get('/employee/add', [employeesController::class, 'create'])->name('employee.add');
Route::get('/employee/view', [employeesController::class, 'view'])->name('employee.view');
Route::post('/employee/store', [employeesController::class, 'store'])->name('employee.store');
Route::get('/employee/edit/{id}', [employeesController::class, 'edit'])->name('employee.edit');
Route::post('/employee/update/{id}', [employeesController::class, 'update'])->name('employee.update');
Route::get('/employee/delete/{id}', [employeesController::class, 'delete'])->name('employee.delete');
Route::get('get-designation', [DesignationController::class, 'getDesignation'])->name('getDesignation');
Route::get('/manage-attendance', [AttendanceController::class, 'index'])->name('admin.attendance');
Route::get('/get-attendance-data',[AttendanceController::class,'searchByDepartment'])->name('attendance.store');
Route::post('/tabledit/action', [AttendanceController::class,'action'])->name('tabledit.action');
Route::get('/genrate-attendance', [AttendanceController::class, 'attendanceReport'])->name('admin.attendance.report');
Route::get('/get-attendance-report',[AttendanceController::class,'report'])->name('attendance.report');
Route::get('/leave-edit/{id}', [LeaveController::class, 'edit'])->name('leave.edit');
Route::post('/leave-update/{id}', [LeaveController::class, 'update'])->name('leave.update');
Route::get('/leave-delete/{id}', [LeaveController::class, 'delete'])->name('leave.delete');
Route::get('/role/view', [RoleController::class, 'index'])->name('role.view');
Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
Route::post('/role/update/{id}', [RoleController::class, 'update'])->name('role.update');
Route::delete('/role/delete/{id}', [RoleController::class, 'delete'])->name('role.delete');

Route::get('/permission/view', [PermissionController::class, 'index'])->name('permission.view');
Route::get('/permission/create', [PermissionController::class, 'create'])->name('permission.create');
Route::get('/permission/edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit');
Route::post('/permission/update/{id}', [PermissionController::class, 'update'])->name('permission.update');
Route::delete('/permission/delete/{id}', [PermissionController::class, 'delete'])->name('permission.delete');
Route::post('/permission/store', [PermissionController::class, 'store'])->name('permission.store');


});

Route::group(['prefix'=>'user','middleware'=>['isUser','auth','PreventBackHistory']],function () {
    Route::get('dashboard', [UserController::class,'index'])->name('user.dashboard');
    Route::get('Profile', [UserController::class,'profile'])->name('user.profile');
    Route::post('startWork', [AttendanceController::class, 'startWork'])->name('attendance.startWork');
    Route::post('endWork', [AttendanceController::class, 'endWork'])->name('attendance.endWork');
    Route::get('attendance/getButtonState', [AttendanceController::class, 'getButtonState']);

    Route::get('attendance', [AttendanceController::class,'show'])->name('attendance.view');
    Route::get('/attendance/search',[AttendanceController::class,'searchAttendance'])->name('search');
});
Route::group(['middleware'=>['auth','PreventBackHistory']],function () {
    Route::get('leave/add', [LeaveController::class,'index'])->name('leave.add');
Route::post('leave', [LeaveController::class,'store'])->name('leave.store');
Route::get('leave/view', [LeaveController::class,'view'])->name('leave.view');
});
//Auth::routes();

//Route::get('/home', [UserController::class,'index'])->name('home');
