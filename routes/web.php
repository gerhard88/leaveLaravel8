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
use App\Http\Controllers\FullCalendarController;

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
Route::get('country/add', [CountryController::class, 'add'])->name('addCountry');

// store country
Route::post('country/store', [CountryController::class, 'store'])->name('storeCountry');

// edit country
Route::get('country/edit/{id}', [CountryController::class, 'edit'])->name('editCountry');

// update country
Route::PATCH('country/update/{id}', [CountryController::class, 'update'])->name('updateCountry');

// delete country
Route::get('country/destroy/{id}', [CountryController::class, 'destroy'])->name('destroyCountry');

// get the companies for the selected country
Route::get('ajax-country-company/{id}', [CountryController::class, 'ajaxCompanies']);

// route to list companies
Route::get('companies', [CompanyController::class, 'index'])->name('companies');

// add company
Route::get('company/add', [CompanyController::class, 'add'])->name('addCompany');

// store company
Route::post('company/store', [CompanyController::class, 'store'])->name('storeCompany');

// edit company
Route::get('company/edit/{id}', [CompanyController::class, 'edit'])->name('editCompany');

// update company
Route::PATCH('company/update/{id}', [CompanyController::class, 'update'])->name('updateCompany');

// delete company
Route::get('company/destroy/{id}', [CompanyController::class, 'destroy'])->name('destroyCompany');

// edit departments linked to a company
Route::get('company/departments/{id}', [CompanyController::class, 'departments'])->name('deptsCompany');

// get the departments for the selected company
Route::get('ajax-company-department/{id}', [CompanyController::class, 'ajaxDepartments']);

// edit teams linked to a company
Route::get('company/teams/{id}', [CompanyController::class, 'teams'])->name('teamsCompany');

// get the teams for the selected company
Route::get('ajax-company-team/{id}', [CompanyController::class, 'ajaxTeams']);

// route to list departments
Route::get('departments', [DepartmentController::class, 'index'])->name('departments');

// add department
Route::get('department/add', [DepartmentController::class, 'add'])->name('addDepartment');

// store department
Route::post('department/store', [DepartmentController::class, 'store'])->name('storeDepartment');

// edit department
Route::get('department/edit/{id}', [DepartmentController::class, 'edit'])->name('editDepartment');

// update department
Route::PATCH('department/update/{id}', [DepartmentController::class, 'update'])->name('updateDepartment');

// delete department
Route::get('department/destroy/{id}', [DepartmentController::class, 'destroy'])->name('destroyDepartment');

// route to list teams
Route::get('teams', [TeamController::class, 'index'])->name('teams');

// add team
Route::get('team/add', [TeamController::class, 'add'])->name('addTeam');

// store team
Route::post('team/store', [TeamController::class, 'store'])->name('storeTeam');

// edit team
Route::get('team/edit/{id}', [TeamController::class, 'edit'])->name('editTeam');

// update team
Route::PATCH('team/update/{id}', [TeamController::class, 'update'])->name('updateTeam');

// delete team
Route::get('team/destroy/{id}', [TeamController::class, 'destroy'])->name('destroyTeam');

// route to list employee types
Route::get('employeeTypes', [EmployeeTypeController::class, 'index'])->name('employeeTypes');

// add employee type
Route::get('employeeType/add', [EmployeeTypeController::class, 'add'])->name('addEmployeeType');

// store employee type
Route::post('employeeType/store', [EmployeeTypeController::class, 'store'])->name('storeEmployeeType');

// edit employee type
Route::get('employeeType/edit/{id}', [EmployeeTypeController::class, 'edit'])->name('editEmployeeType');

// update employee type
Route::PATCH('employeeType/update/{id}', [EmployeeTypeController::class, 'update'])->name('updateEmployeeType');

// delete employee type
Route::get('employeeType/destroy/{id}', [EmployeeTypeController::class, 'destroy'])->name('destroyEmployeeType');

// route to list leave types
Route::get('leaveTypes', [LeaveTypeController::class, 'index'])->name('leaveTypes');

// add leave type
Route::get('leaveType/add', [LeaveTypeController::class, 'add'])->name('addLeaveType');

// store leave type
Route::post('leaveType/store', [LeaveTypeController::class, 'store'])->name('storeLeaveType');

// edit leave type
Route::get('leaveType/edit/{id}', [LeaveTypeController::class, 'edit'])->name('editLeaveType');

// update leave type
Route::PATCH('leaveType/update/{id}', [LeaveTypeController::class, 'update'])->name('updateLeaveType');

// delete leave type
Route::get('leaveType/destroy/{id}', [LeaveTypeController::class, 'destroy'])->name('destroyLeaveType');

// route to list employees
Route::get('employees', [EmployeeController::class, 'index'])->name('employees');

// add employee
Route::get('employee/add', [EmployeeController::class, 'add'])->name('addEmployee');

// store employee
Route::post('employee/store', [EmployeeController::class, 'store'])->name('storeEmployee');

// edit employee
Route::get('employee/edit/{id}', [EmployeeController::class, 'edit'])->name('editEmployee');

// update employee
Route::PATCH('employee/update/{id}', [EmployeeController::class, 'update'])->name('updateEmployee');

// terminate employee's employment
Route::get('employee/destroy/{id}', [EmployeeController::class, 'destroy'])->name('destroyEmployee');

// leave route
Route::get('leaves', [LeaveController::class, 'index'])->name('leaves');

// route to capture leave for an employee
Route::get('leave/add', [LeaveController::class, 'add'])->name('addLeave');

// store leave
Route::post('leave/store', [LeaveController::class, 'store'])->name('storeLeave');

// edit leave
Route::get('leave/edit/{id}', [LeaveController::class, 'edit'])->name('editLeave');

// update leave
Route::PATCH('leave/update/{id}', [LeaveController::class, 'update'])->name('updateLeave');

// approve leave
Route::get('leave/approve/{id}', [LeaveController::class, 'approve'])->name('approveLeave');

// cancel leave
Route::get('leave/destroy/{id}', [LeaveController::class, 'destroy'])->name('destroyLeave');

// route to list annual leave balances
Route::get('reports/annualLeave', [ReportController::class, 'annualLeave'])->name('annualLeave');

// route to list sick leave balances
Route::get('reports/sickLeave', [ReportController::class, 'sickLeave'])->name('sickLeave');

// route to search leave type
Route::get('reports/leaveRequests', [ReportController::class, 'leaveRequests'])->name('leaveRequests');

// route to list employees leave request
Route::get('reports/leaveSummary', [ReportController::class, 'index'])->name('leaveSummary');

// route to report on settings
Route::get('settings', [ReportController::class, 'settings'])->name('settings');

// add hours worked by employees
Route::get('attendanceRegister/search', [AttendanceRegisterController::class, 'search'])->name('searchAttRegister');

// add hours worked by employees
Route::get('attendanceRegister/add', [AttendanceRegisterController::class, 'add'])->name('addAttRegister');

// store storing hours worked by employees
Route::post('attendanceRegister/store', [AttendanceRegisterController::class, 'store'])->name('storeAttRegister');

// route to paginate to the left
Route::get('paginateLeft', [AttendanceRegisterController::class, 'paginateLeft'])->name('paginateLeft');

// route to paginate to the right
Route::get('paginateRight', [AttendanceRegisterController::class, 'paginateRight'])->name('paginateRight');

// get the ajaxfunction for employee names
Route::get('getNameData', [EmployeeController::class, 'getNameData']);

Route::get('calendar', [FullCalendarController::class, 'index'])->name('calendar');

// route to secure routes
Route::group(['middleware' => ['myMiddleware']], function () {
    Route::get('roles', [RoleController::class, 'index'])->name('roles');
    Route::get('role/create', [RoleController::class, 'create'])->name('create');
    Route::get('role/edit/{id}', [RoleController::class, 'edit'])->name('edit');
    Route::get('countries', [CountryController::class, 'index'])->name('countries');
    Route::get('country/add', [CountryController::class, 'add'])->name('addCountry');
    Route::get('country/edit/{id}', [CountryController::class, 'edit'])->name('editCountry');
    Route::get('companies', [CompanyController::class, 'index'])->name('companies');
    Route::get('company/add', [CompanyController::class, 'add'])->name('addCompany');
    Route::get('company/edit/{id}', [CompanyController::class, 'edit'])->name('editCompany');
    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::get('user/add', [UserController::class, 'add'])->name('addUser');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('editUser');
    Route::get('employeeTypes', [EmployeeTypeController::class, 'index'])->name('employeeTypes');
    Route::get('employeeType/add', [EmployeeTypeController::class, 'add'])->name('addEmployeeType');
    Route::get('employeeType/edit/{id}', [EmployeeTypeController::class, 'edit'])->name('editEmployeeType');
    Route::get('leaveTypes', [LeaveTypeController::class, 'index'])->name('leaveTypes');
    Route::get('leaveType/add', [LeaveTypeController::class, 'add'])->name('addLeaveType');
    Route::get('leaveType/edit/{id}', [LeaveTypeController::class, 'edit'])->name('editLeaveType');
    Route::get('departments', [DepartmentController::class, 'index'])->name('departments');
    Route::get('department/add', [DepartmentController::class, 'add'])->name('addDepartment');
    Route::get('department/edit/{id}', [DepartmentController::class, 'edit'])->name('editDepartment');
    Route::get('teams', [TeamController::class, 'index'])->name('teams');
    Route::get('team/add', [TeamController::class, 'add'])->name('addTeam');
    Route::get('team/edit/{id}', [TeamController::class, 'edit'])->name('editTeam');
    Route::get('employees', [EmployeeController::class, 'index'])->name('employees');
    Route::get('employee/add', [EmployeeController::class, 'add'])->name('addEmployee');
    Route::get('employee/edit/{id}', [EmployeeController::class, 'edit'])->name('editEmployee');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('leaves', [LeaveController::class, 'index'])->name('leaves');
    Route::get('leave/add', [LeaveController::class, 'add'])->name('addLeave');
    Route::get('reports/annualLeave', [ReportController::class, 'annualLeave'])->name('annualLeave');
    Route::get('reports/sickLeave', [ReportController::class, 'sickLeave'])->name('sickLeave');
    Route::get('attendanceRegister/add', [AttendanceRegisterController::class, 'add'])->name('addAttRegister');
    Route::get('settings', [ReportController::class, 'settings'])->name('settings');
    Route::get('calendar', [FullCalendarController::class, 'index'])->name('calendar');
});

