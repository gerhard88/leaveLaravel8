<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\EmployeeTypeController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceRegisterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\LeaveController;

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
// route to list users
Route::get('users', [UserController::class, 'index'])->name('users');

// add user
Route::get('user/add', [UserController::class, 'add'])->name('addUser');

// store user
Route::post('user/store', [UserController::class, 'store'])->name('storeUser');

// edit user
Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('editUser');

// update user
Route::PATCH('user/update/{id}', [UserController::class, 'update'])->name('updateUser');

// delete user
Route::get('user/destroy/{id}', [UserController::class, 'destroy'])->name('destroyUser');

// show the login form
Route::get('login', [UserController::class, 'showLogin'])->name('login');

// process the login form
Route::post('login', array(UserController::class, 'doLogin'))->name('login');

// process the logout
Route::get('users/logout', [UserController::class, 'doLogout'])->name('logout');

// route to list user roles
Route::get('roles', [RoleController::class, 'index'])->name('roles');

// add user role
Route::get('role/create', [RoleController::class, 'create'])->name('create');

// store user role
Route::post('/store', [RoleController::class, 'store'])->name('store');

// edit user role
Route::get('role/edit/{id}', [RoleController::class, 'edit'])->name('edit');

// update user role
Route::PATCH('role/update/{id}', [RoleController::class, 'update'])->name('update');

//get the dashboard screen
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

// route to list countries
Route::get('countries', [CountryController::class, 'index'])->name('countries');

// add country
Route::get('country/add', ['as' => 'country.add','uses' => 'CountryController@add', 'middleware' => 'myMiddleware'])->middleware('auth');

// store country
Route::post('country/store', ['as' => 'country.store','uses' => 'CountryController@store']);

// edit country
Route::get('country/edit/{id}', ['as' => 'country.edit','uses' => 'CountryController@edit', 'middleware' => 'myMiddleware'])->middleware('auth');

// update country
Route::PATCH('country/update/{id}', ['as' => 'country.update','uses' => 'CountryController@update']);

// delete country
Route::get('country/destroy/{id}', ['as' => 'country.destroy','uses' => 'CountryController@destroy', 'middleware' => 'myMiddleware'])->middleware('auth');

// route to list companies
Route::get('companies', [CompanyController::class, 'index'])->name('companies');

// add company
Route::get('company/add', ['as' => 'company.add','uses' => 'CompanyController@add', 'middleware' => 'myMiddleware'])->middleware('auth');

// store company
Route::post('company/store', ['as' => 'company.store','uses' => 'CompanyController@store']);

// edit company
Route::get('company/edit/{id}', ['as' => 'company.edit','uses' => 'CompanyController@edit', 'middleware' => 'myMiddleware'])->middleware('auth');

// update company
Route::PATCH('company/update/{id}', ['as' => 'company.update','uses' => 'CompanyController@update']);

// delete company
Route::get('company/destroy/{id}', ['as' => 'company.destroy','uses' => 'CompanyController@destroy', 'middleware' => 'myMiddleware'])->middleware('auth');

// edit departments linked to a company
Route::get('company/departments/{id}', ['as' => 'company.departments','uses' => 'CompanyController@departments', 'middleware' => 'myMiddleware'])->middleware('auth');

// get the departments for the selected company
Route::get('ajax-company-department/{id}', ['as' => 'companies.ajaxDepartment','uses' => 'CompanyController@ajaxDepartments', 'middleware' => 'myMiddleware'])->middleware('auth');

// edit teams linked to a company
Route::get('company/teams/{id}', ['as' => 'company.teams','uses' => 'CompanyController@teams', 'middleware' => 'myMiddleware'])->middleware('auth');

// route to list departments
Route::get('departments', [DepartmentController::class, 'index'])->name('departments');

// add department
Route::get('department/add', ['as' => 'department.add','uses' => 'DepartmentController@add', 'middleware' => 'myMiddleware'])->middleware('auth');

// store department
Route::post('department/store', ['as' => 'department.store','uses' => 'DepartmentController@store']);

// edit department
Route::get('department/edit/{id}', ['as' => 'department.edit','uses' => 'DepartmentController@edit', 'middleware' => 'myMiddleware'])->middleware('auth');

// update department
Route::PATCH('department/update/{id}', ['as' => 'department.update','uses' => 'DepartmentController@update']);

// delete department
Route::get('department/destroy/{id}', ['as' => 'department.destroy','uses' => 'DepartmentController@destroy', 'middleware' => 'myMiddleware'])->middleware('auth');

// route to list teams
Route::get('teams', [TeamController::class, 'index'])->name('teams');

// add team
Route::get('team/add', ['as' => 'team.add','uses' => 'TeamController@add', 'middleware' => 'myMiddleware'])->middleware('auth');

// store team
Route::post('team/store', ['as' => 'team.store','uses' => 'TeamController@store']);

// edit team
Route::get('team/edit/{id}', ['as' => 'team.edit','uses' => 'TeamController@edit', 'middleware' => 'myMiddleware'])->middleware('auth');

// update team
Route::PATCH('team/update/{id}', ['as' => 'team.update','uses' => 'TeamController@update']);

// delete team
Route::get('team/destroy/{id}', ['as' => 'team.destroy','uses' => 'TeamController@destroy', 'middleware' => 'myMiddleware'])->middleware('auth');

// route to list employees
Route::get('employees', [EmployeeController::class, 'index'])->name('employees');

// add employee
Route::get('employee/add', ['as' => 'employee.add','uses' => 'EmployeeController@add', 'middleware' => 'myMiddleware'])->middleware('auth');

// store employee
Route::post('employee/store', ['as' => 'employee.store','uses' => 'EmployeeController@store']);

// edit employee
Route::get('employee/edit/{id}', ['as' => 'employee.edit','uses' => 'EmployeeController@edit', 'middleware' => 'myMiddleware'])->middleware('auth');

// update employee
Route::PATCH('employee/update/{id}', ['as' => 'employee.update','uses' => 'EmployeeController@update']);

// terminate employee's employment
Route::get('employee/destroy/{id}', ['as' => 'employee.destroy','uses' => 'EmployeeController@destroy', 'middleware' => 'myMiddleware'])->middleware('auth');

// route to list leave types
Route::get('leaveTypes', [LeaveTypeController::class, 'index'])->name('leaveTypes');

// add leave type
Route::get('leaveType/add', ['as' => 'leaveType.add','uses' => 'LeaveTypeController@add', 'middleware' => 'myMiddleware'])->middleware('auth');

// store leave type
Route::post('leaveType/store', ['as' => 'leaveType.store','uses' => 'LeaveTypeController@store']);

// edit leave type
Route::get('leaveType/edit/{id}', ['as' => 'leaveType.edit','uses' => 'LeaveTypeController@edit', 'middleware' => 'myMiddleware'])->middleware('auth');

// update leave type
Route::PATCH('leaveType/update/{id}', ['as' => 'leaveType.update','uses' => 'LeaveTypeController@update']);

// delete leave type
Route::get('leaveType/destroy/{id}', ['as' => 'leaveType.destroy','uses' => 'LeaveTypeController@destroy', 'middleware' => 'myMiddleware'])->middleware('auth');

// leave route
Route::get('leaves', [LeaveController::class, 'index'])->name('leaves');

// route to capture leave for an employee
Route::get('leave/add', [LeaveController::class, 'add'])->name('addLeave');

// store leave
Route::post('leave/store', ['as' => 'leave.store','uses' => 'LeaveController@store']);

// edit leave
Route::get('leave/edit/{id}', ['as' => 'leave.edit','uses' => 'LeaveController@edit', 'middleware' => 'myMiddleware'])->middleware('auth');

// update leave
Route::PATCH('leave/update/{id}', ['as' => 'leave.update','uses' => 'LeaveController@update']);

// approve leave
Route::get('leave/approve/{id}', [LeaveController::class, 'approve'])->name('approve');

// route to list annual leave balances
Route::get('reports/annualLeave', [ReportController::class, 'annualLeave'])->name('annualLeave');

// route to list sick leave balances
Route::get('reports/sickLeave', [ReportController::class, 'sickLeave'])->name('sickLeave');

// route to report on settings
Route::get('settings', [ReportController::class, 'settings'])->name('settings');

// get the companies for the selected country
Route::get('ajax-country-company/{id}', ['as' => 'countries.ajaxCompanies','uses' => 'CountryController@ajaxCompanies', 'middleware' => 'myMiddleware'])->middleware('auth');

// get the teams for the selected company
Route::get('ajax-company-team/{id}', ['as' => 'companies.ajaxTeam','uses' => 'CompanyController@ajaxTeams', 'middleware' => 'myMiddleware'])->middleware('auth');

// add hours worked by employees
Route::get('attendanceRegister/search', [AttendanceRegisterController::class, 'search'])->name('searchRegister');

// add hours worked by employees
Route::get('attendanceRegister/add', [AttendanceRegisterController::class, 'add'])->name('addAttRegister');

// store storing hours worked by employees
Route::post('attendanceRegister/store', ['as' => 'attendanceRegister.store','uses' => 'AttendanceRegisterController@store']);

// route to paginate to the left
Route::get('paginateLeft', ['as' => 'paginateLeft','uses' => 'AttendanceRegisterController@paginateLeft', 'middleware' => 'myMiddleware'])->middleware('auth');

// route to paginate to the right
Route::get('paginateRight', ['as' => 'paginateRight','uses' => 'AttendanceRegisterController@paginateRight', 'middleware' => 'myMiddleware'])->middleware('auth');

// route to list employee types
Route::get('employeeTypes', [EmployeeTypeController::class, 'index'])->name('employeeTypes');

// add employee type
Route::get('employeeType/add', ['as' => 'employeeType.add','uses' => 'EmployeeTypeController@add', 'middleware' => 'myMiddleware'])->middleware('auth');

// store employee type
Route::post('employeeType/store', ['as' => 'employeeType.store','uses' => 'EmployeeTypeController@store']);

// edit employee type
Route::get('employeeType/edit/{id}', ['as' => 'employeeType.edit','uses' => 'EmployeeTypeController@edit', 'middleware' => 'myMiddleware'])->middleware('auth');

// update employee type
Route::PATCH('employeeType/update/{id}', ['as' => 'employeeType.update','uses' => 'EmployeeTypeController@update']);

// delete employee type
Route::get('employeeType/destroy/{id}', ['as' => 'employeeType.destroy','uses' => 'EmployeeTypeController@destroy', 'middleware' => 'myMiddleware'])->middleware('auth');

//route to display calendar view
Route::get('calendar/view', [DashboardController::class, 'view'])->name('calendar');

// get the ajaxfunction for employee names
Route::get('getNameData', ['as' => 'getNameData','uses' => 'EmployeeController@getNameData', 'middleware' => 'myMiddleware'])->middleware('auth');

