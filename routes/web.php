<?php

use App\Http\Controllers\Accountant\ExpenseController;
use App\Http\Controllers\Accountant\MobileAgentController;
use App\Http\Controllers\Admin\AccountantController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\CompounderController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\SpecialistController;
use App\Http\Controllers\Admin\TherapyController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Accountant\ExpenseTypeController;
use App\Http\Controllers\Accountant\MobileAgentTypeController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\LeaveTypeController;
use App\Http\Controllers\Admin\MachineController;
use App\Http\Controllers\Admin\SlotController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\TherapistController;
use App\Http\Controllers\Admin\UserAttendenceController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\SuperAdmin\SuperAdminHomeController;
use App\Http\Controllers\Doctor\DoctorAppointmentController;
use App\Http\Controllers\Employee\LeaveApplicationController;
use App\Http\Controllers\Employee\RequisitionController;

Route::get('/', function () {
    return view('welcome');
});
Route::view('index.html', 'welcome');
Route::view('about_us.html', 'about_us');
Route::view('services.html', 'services');
Route::view('blog.html', 'blog');
Route::view('contact_us.html', 'contact');
Route::view('gallery.html', 'gallery');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('role');

// super-admin route section
Route::get('super-admin/home', [SuperAdminHomeController::class, 'index'])->name('superadmin.home')->middleware('role');

/**
 * Route section of admin
 *
 * @return
 */
Route::get('admin/home', [AdminHomeController::class, 'index'])->name('admin.home')->middleware('role');

// Patient
Route::get('admin/patient/add', [AdminHomeController::class, 'addPatient'])->middleware('role');
Route::get('admin/calendar', [AdminHomeController::class, 'calendar'])->middleware('role');
Route::post('admin/calendar/set', [AdminHomeController::class, 'calendarSet'])->name('calendar.set')->middleware('role');

//calendar.set
Route::post('admin/patient/add', [AdminHomeController::class, 'createPatient'])->middleware('role');
Route::get('admin/patient/list', [AdminHomeController::class, 'patientList'])->middleware('role');
Route::get('admin/patient/rfid/{id}', [AdminHomeController::class, 'patientAddRFID'])->middleware('role');
Route::get('admin/patient/show/{id}', [AdminHomeController::class, 'patientShow'])->middleware('role');

Route::post('admin/patient/updateRFID', [AdminHomeController::class, 'patientUpdateRFID'])->middleware('role');
Route::get('admin/patient/edit/{id}/{uid}', [AdminHomeController::class, 'patientEdit'])->middleware('role');
Route::post('admin/patient/edit-store', [AdminHomeController::class, 'patientEditStore'])->middleware('role');
Route::get('admin/patient/change-status/{id}', [AdminHomeController::class, 'patientChangeStatus'])->middleware('role');
Route::get('admin/patient/delete/{id}', [AdminHomeController::class, 'patientDelete'])->middleware('role');
Route::get('admin/appointment/load-slot', [AdminHomeController::class, 'loadSlot'])->middleware('role');
Route::get('appointment/print/{appointment}', [AdminHomeController::class, 'print'])->name('appointment.print');

//


//machine

Route::resource('admin/machine', MachineController::class);
Route::get('admin/machine/remove/{machine}', [MachineController::class, 'destroy'])->name('machine.remove');
Route::resource('admin/user-attendence', UserAttendenceController::class);
Route::get('admin/attendence/report', [UserAttendenceController::class, 'report']);

Route::get('admin/user-leave', [UserAttendenceController::class, 'userLeave'])->name('user.leave');
//
Route::get('admin/user-leave/approve/{id}', [UserAttendenceController::class, 'approveLeave'])->name('leave.approve');
Route::get('admin/user-leave/show/{id}', [UserAttendenceController::class, 'showLeave'])->name('leave.show');
Route::post('admin/user-leave/update/{id}', [UserAttendenceController::class, 'updateLeave'])->name('leave.update');

//leave.update

Route::resource('admin/group', GroupController::class);
Route::get('admin/group/remove/{group}', [GroupController::class, 'destroy'])->name('group.remove');

Route::resource('admin/test', TestController::class);
Route::get('admin/test/remove/{test}', [TestController::class, 'destroy'])->name('test.remove');

Route::resource('admin/leave-type', LeaveTypeController::class);
Route::get('admin/leave-type/remove/{leaveType}', [LeaveTypeController::class, 'destroy'])->name('leave-type.remove');

Route::resource('admin/slot', SlotController::class);
Route::get('admin/slot/remove/{slot}', [SlotController::class, 'destroy'])->name('slot.remove');

Route::resource('admin/task', TaskController::class);
Route::get('admin/task/remove/{task}', [TaskController::class, 'destroy'])->name('task.remove');
Route::resource('conversation', ConversationController::class);
Route::get('conversation/chat/{conversation}', [ConversationController::class, 'chat'])->name('conversation.chat');

//conversation.chat


// Appointment
Route::get('admin/appointment/list', [AdminHomeController::class, 'appointmentList'])->middleware('role');
//admin/appointment/18/status/1
Route::get('admin/appointment/{appointment}/status/{status}', [AdminHomeController::class, 'appointmentStatus'])->middleware('role');

Route::get('admin/appointment/edit/{id}', [AdminHomeController::class, 'appointmentEdit'])->middleware('role');
Route::get('admin/appointment/show/{id}', [AdminHomeController::class, 'appointmentShow'])->middleware('role');

Route::post('admin/appointment/assign', [AdminHomeController::class, 'appointmentAssign'])->middleware('role');
Route::post('admin/appointment/update', [AdminHomeController::class, 'appointmentUpdate'])->middleware('role');
Route::get('admin/appointment/add', [AdminHomeController::class, 'appointmentAdd'])->middleware('role');
Route::post('admin/appointment/add-store', [AdminHomeController::class, 'appointmentAddStore'])->middleware('role');
Route::post('appointment/{appointment}/note-store', [AdminHomeController::class, 'noteStore'])->name('appointment.note.store');
Route::post('task/{task}/note-store', [AdminHomeController::class, 'noteTask'])->name('task.note.store');
Route::post('leave/{leaveApplication}/note-store', [AdminHomeController::class, 'noteLeave'])->name('leave.note.store');

Route::get('task/{task}/status', [AdminHomeController::class, 'noteStatus'])->name('task.note.status');



//

// Doctor
Route::get('admin/doctor/add', [DoctorController::class, 'add'])->middleware('role');
Route::post('admin/doctor/add', [DoctorController::class, 'store'])->middleware('role');
Route::get('admin/doctor/list', [DoctorController::class, 'list'])->middleware('role');
Route::get('admin/doctor/edit/{id}/{uid}', [DoctorController::class, 'edit'])->middleware('role');
Route::post('admin/doctor/edit-store', [DoctorController::class, 'editStore'])->middleware('role');
Route::get('admin/doctor/change-status/{id}', [DoctorController::class, 'changeStatus'])->middleware('role');
Route::get('admin/doctor/delete/{id}', [DoctorController::class, 'delete'])->middleware('role');
Route::get('admin/therapy/payment-list', [DoctorController::class, 'paymentList'])->middleware('role');

//coordinator
// Doctor
Route::get('admin/coordinator/add', [CompounderController::class, 'add'])->middleware('role');
Route::post('admin/coordinator/add', [CompounderController::class, 'store'])->middleware('role');
Route::get('admin/coordinator/list', [CompounderController::class, 'list'])->middleware('role');
Route::get('admin/coordinator/edit/{id}/{uid}', [CompounderController::class, 'edit'])->middleware('role');
Route::post('admin/coordinator/edit-store', [CompounderController::class, 'editStore'])->middleware('role');
Route::get('admin/coordinator/change-status/{id}', [CompounderController::class, 'changeStatus'])->middleware('role');
Route::get('admin/coordinator/delete/{id}', [CompounderController::class, 'delete'])->middleware('role');
// Route::get('admin/therapy/payment-list', [DoctorController::class, 'paymentList'])->middleware('role');

Route::get('admin/therapist/add', [TherapistController::class, 'add'])->middleware('role');
Route::post('admin/therapist/add', [TherapistController::class, 'store'])->middleware('role');
Route::get('admin/therapist/list', [TherapistController::class, 'list'])->middleware('role');
Route::get('admin/therapist/edit/{id}/{uid}', [TherapistController::class, 'edit'])->middleware('role');
Route::post('admin/therapist/edit-store', [TherapistController::class, 'editStore'])->middleware('role');
Route::get('admin/therapist/change-status/{id}', [TherapistController::class, 'changeStatus'])->middleware('role');
Route::get('admin/therapist/delete/{id}', [TherapistController::class, 'delete'])->middleware('role');


Route::get('admin/employee/add', [EmployeeController::class, 'add'])->middleware('role');
Route::post('admin/employee/add', [EmployeeController::class, 'store'])->middleware('role');
Route::get('admin/employee/list', [EmployeeController::class, 'list'])->middleware('role');
Route::get('admin/employee/edit/{id}/{uid}', [EmployeeController::class, 'edit'])->middleware('role');
Route::post('admin/employee/edit-store', [EmployeeController::class, 'editStore'])->middleware('role');
Route::get('admin/employee/change-status/{id}', [EmployeeController::class, 'changeStatus'])->middleware('role');
Route::get('admin/employee/delete/{id}', [EmployeeController::class, 'delete'])->middleware('role');


Route::get('admin/accountant/add', [AccountantController::class, 'add'])->middleware('role');
Route::post('admin/accountant/add', [AccountantController::class, 'store'])->middleware('role');
Route::get('admin/accountant/list', [AccountantController::class, 'list'])->middleware('role');
Route::get('admin/accountant/edit/{id}/{uid}', [AccountantController::class, 'edit'])->middleware('role');
Route::post('admin/accountant/edit-store', [AccountantController::class, 'editStore'])->middleware('role');
Route::get('admin/accountant/change-status/{id}', [AccountantController::class, 'changeStatus'])->middleware('role');
Route::get('admin/accountant/delete/{id}', [AccountantController::class, 'delete'])->middleware('role');
// Specialist
Route::get('admin/specialist/add', [SpecialistController::class, 'add'])->middleware('role');
Route::post('admin/specialist/store', [SpecialistController::class, 'store'])->middleware('role');
Route::get('admin/specialist/list', [SpecialistController::class, 'list'])->middleware('role');
Route::get('admin/specialist/edit/{id}', [SpecialistController::class, 'edit'])->middleware('role');
Route::post('admin/specialist/edit-store', [SpecialistController::class, 'editStore'])->middleware('role');
Route::get('admin/specialist/change-status/{id}', [SpecialistController::class, 'changeStatus'])->middleware('role');
Route::get('admin/specialist/delete/{id}', [SpecialistController::class, 'delete'])->middleware('role');

// Therapy
Route::get('admin/therapy/add', [TherapyController::class, 'add'])->middleware('role');
Route::post('admin/therapy/store', [TherapyController::class, 'store'])->middleware('role');
Route::get('admin/therapy/list', [TherapyController::class, 'list'])->middleware('role');
Route::get('admin/therapy/edit/{id}', [TherapyController::class, 'edit'])->middleware('role');
Route::post('admin/therapy/edit-store', [TherapyController::class, 'editStore'])->middleware('role');
Route::get('admin/therapy/change-status/{id}', [TherapyController::class, 'changeStatus'])->middleware('role');
Route::get('admin/therapy/delete/{id}', [TherapyController::class, 'delete'])->middleware('role');

// Employee
// Route::get('admin/employee/add', [EmployeeController::class, 'add'])->middleware('role');
// Route::post('admin/employee/add', [EmployeeController::class, 'store'])->middleware('role');
// Route::get('admin/employee/list', [EmployeeController::class, 'list'])->middleware('role');
// Route::get('admin/employee/manage/{id}', [EmployeeController::class, 'manageEmployee'])->middleware('role');
// Route::post('admin/employee/manage/update_role', [EmployeeController::class, 'updateEmployeeRole'])->middleware('role');
// Route::get('admin/employee/edit/{id}', [EmployeeController::class, 'edit'])->middleware('role');
// Route::post('admin/employee/edit-store', [EmployeeController::class, 'editStore'])->middleware('role');
// Route::get('admin/employee/change-status/{id}', [EmployeeController::class, 'changeStatus'])->middleware('role');
// Route::get('admin/employee/delete/{id}', [EmployeeController::class, 'delete'])->middleware('role');

// Payment
Route::get('admin/payment/new/{id}', [TherapyController::class, 'paymentNew'])->middleware('role');
Route::post('admin/payment/new/store', [TherapyController::class, 'paymentNewStore'])->middleware('role');
Route::get('admin/payment/advanced/{id}', [TherapyController::class, 'paymentAdvanced'])->middleware('role');
Route::post('admin/payment/advanced/store', [TherapyController::class, 'paymentAdvancedStore'])->middleware('role');
Route::get('admin/payment/history/{id}', [TherapyController::class, 'paymentHistory'])->middleware('role');
Route::post('admin/payment/history/store', [TherapyController::class, 'paymentHistoryStore'])->middleware('role');


/**
 * Route section of patient
 *
 * @return
 */
Route::get('patient/home', [HomeController::class, 'patientindex'])->name('home')->middleware('role');
Route::get('patient/appointment', [HomeController::class, 'appointment'])->name('patient.appointment')->middleware('role');
Route::get('patient/appointment/{appointment}/show', [HomeController::class, 'showAppointment'])->name('patient.appointment.show')->middleware('role');

Route::get('patient/appointment/list', [HomeController::class, 'appointmentList'])->middleware('role');
Route::get('patient/appointment/edit/{id?}', [HomeController::class, 'appointmentEdit'])->middleware('role');
Route::post('patient/appointment-update', [HomeController::class, 'appointmentUpdate'])->middleware('role');
Route::get('patient/appointment/delete', [HomeController::class, 'appointmentDelete'])->middleware('role');
Route::get('patient/appointment/prescrip/{id}', [HomeController::class, 'prescription'])->middleware('role');
Route::get('patient/appointment/therapy/{id}', [HomeController::class, 'appointmentTherapy'])->middleware('role');
Route::get('patient/appointment/{appointmentTherapy}/therapy', [HomeController::class, 'history'])->name('patient.therapy.history')->middleware('role');

Route::post('patient/appointment-add', [HomeController::class, 'add'])->middleware('role');
Route::get('patient/profile', [HomeController::class, 'profile'])->middleware('role');
Route::post('patient/profile-update', [HomeController::class, 'profileUpdate'])->middleware('role');
Route::get('patient/payment/history', [HomeController::class, 'paymentHistory'])->middleware('role');


// consultant route section
Route::get('coordinator/home', [\App\Http\Controllers\Compounder\HomeController::class, 'index'])->middleware('role');
// coordinator/appointment/list
Route::get('coordinator/appointment/list', [\App\Http\Controllers\Compounder\AppointmentController::class, 'index'])->middleware('role');

// Route::get('coordinator/appointment/{appointmentTherapy}/therapy', [\App\Http\Controllers\Compounder\AppointmentController::class, 'history'])->name('appointment.therapy.history')->middleware('role');
//appointment.therapy.give

Route::get('coordinator/appointment/{appointment}/show', [\App\Http\Controllers\Compounder\AppointmentController::class, 'show'])->name('compounder.appointment.show')->middleware('role');
Route::get('coordinator/appointment/{appointmentTherapy}/therapy', [\App\Http\Controllers\Compounder\AppointmentController::class, 'history'])->name('compounder.therapy.history')->middleware('role');

Route::post('appointment/{appointment}/discount', [\App\Http\Controllers\Compounder\AppointmentController::class, 'discount'])->name('appointment.discount');



Route::get('accountant/home', [\App\Http\Controllers\Accountant\HomeController::class, 'index'])->middleware('role');
// coordinator/appointment/list
Route::get('accountant/appointment/list', [\App\Http\Controllers\Accountant\AppointmentController::class, 'index'])->middleware('role');
Route::get('accountant/requisition/list', [\App\Http\Controllers\Accountant\RequisitionController::class, 'index']);
Route::get('accountant/requisition/{requisition}/show', [\App\Http\Controllers\Accountant\RequisitionController::class, 'show'])->name('requisition.show');

Route::get('accountant/appointment/{appointment}/show', [\App\Http\Controllers\Accountant\AppointmentController::class, 'show'])->name('accountant.appointment.show')->middleware('role');
Route::get('accountant/appointment/{appointment}/pay', [\App\Http\Controllers\Accountant\AppointmentController::class, 'pay'])->name('appointment.pay')->middleware('role');
//payment.print
Route::get('accountant/payment/{appoinmentPayment}/print', [\App\Http\Controllers\Accountant\AppointmentController::class, 'printPayment'])->name('payment.print')->middleware('role');

//payment.print
Route::get('accountant/payment/{appoinmentPayment}/edit', [\App\Http\Controllers\Accountant\AppointmentController::class, 'editPayment'])->name('payment.edit')->middleware('role');
Route::get('accountant/payment/{appoinmentPayment}/history', [\App\Http\Controllers\Accountant\AppointmentController::class, 'paymentHistory'])->name('payment.history')->middleware('role');

Route::post('accountant/payment/{appoinmentPayment}/update', [\App\Http\Controllers\Accountant\AppointmentController::class, 'updatePayment'])->name('payment.update')->middleware('role');


Route::post('accountant/appointment/{appointment}/paid', [\App\Http\Controllers\Accountant\AppointmentController::class, 'paid'])->name('appointment.paid')->middleware('role');

Route::get('accountant/report/expense', [\App\Http\Controllers\Accountant\AppointmentController::class, 'expenseReport'])->middleware('role');
Route::get('accountant/report/appointment-pay', [\App\Http\Controllers\Accountant\AppointmentController::class, 'appointmentPayReport'])->middleware('role');


Route::get('accountant/requisition/{requisition}/pay', [\App\Http\Controllers\Accountant\RequisitionController::class, 'pay'])->name('requisition.pay')->middleware('role');
Route::post('accountant/requisition/{requisition}/paid', [\App\Http\Controllers\Accountant\RequisitionController::class, 'paid'])->name('requisition.paid')->middleware('role');

Route::resource('accountant/expense-type', ExpenseTypeController::class);
Route::get('accountant/expense-type/remove/{expenseType}', [ExpenseTypeController::class, 'destroy'])->name('expense-type.remove');

Route::resource('accountant/expense', ExpenseController::class);
Route::get('accountant/expense/remove/{expenseType}', [ExpenseController::class, 'destroy'])->name('expense.remove');
Route::get('accountant/expense/pay/{expense}', [ExpenseController::class, 'pay'])->name('expense.pay');
Route::post('accountant/expense/paid/{expense}', [ExpenseController::class, 'paid'])->name('expense.paid');



//appointment.show
Route::resource('accountant/mobile-agent', MobileAgentController::class);
Route::resource('accountant/mobile-agent-type', MobileAgentTypeController::class);
Route::get('accountant/mobile-agent-type/remove/{mobileAgentType}', [MobileAgentTypeController::class, 'destroy'])->name('mobile-agent-type.remove');



//therapist route

// consultant route section
Route::get('therapist/home', [\App\Http\Controllers\Therapist\HomeController::class, 'index'])->middleware('role');
// therapist/appointment/list
Route::get('therapist/appointment/list', [\App\Http\Controllers\Therapist\AppointmentController::class, 'index'])->middleware('role');
Route::get('therapist/appointment/{appointment}/show', [\App\Http\Controllers\Therapist\AppointmentController::class, 'show'])->name('therapist.appointment.show')->middleware('role');

Route::get('therapist/appointment/{appointmentTherapy}/therapy', [\App\Http\Controllers\Therapist\AppointmentController::class, 'history'])->name('appointment.therapy.history')->middleware('role');
Route::get('doctor/appointment/{appointmentTherapy}/therapy', [\App\Http\Controllers\Doctor\AppointmentController::class, 'history'])->name('doctor.therapy.history')->middleware('role');

//appointment.therapy.give
Route::get('therapist/{appointmentTherapy}/give', [\App\Http\Controllers\Therapist\AppointmentController::class, 'give'])->name('appointment.therapy.give');
//therapy.give
Route::post('therapist/{appointmentTherapy}/give', [\App\Http\Controllers\Therapist\AppointmentController::class, 'giveTherapy'])->name('therapy.give');

// Route::get('therapist/appointment/{appointment}/show', [\App\Http\Controllers\Compounder\AppointmentController::class, 'show'])->name('compounder.appointment.show')->middleware('role');

//appointment.discount

// therapist route section

/**
 * doctor route section
 *
 * @return
 */
Route::get('doctor/home', [HomeController::class, 'doctorindex'])->middleware('role');
Route::get('doctor/appointment/list', [DoctorAppointmentController::class, 'index'])->middleware('role');
Route::get('doctor/appointment/{appointment}/show', [DoctorAppointmentController::class, 'show'])->name('doctor.appointment.show')->middleware('role');

Route::get('doctor/appointment/prescription/{id}/{p_id}', [DoctorAppointmentController::class, 'prescription'])->middleware('role');
Route::get('doctor/appointment/therapy/{id}/{p_id}', [DoctorAppointmentController::class, 'therapyForm'])->middleware('role');
Route::get('doctor/appointment/refer/{id}/{p_id}', [DoctorAppointmentController::class, 'referForm'])->middleware('role');
Route::post('doctor/appointment/prescription/store', [DoctorAppointmentController::class, 'store'])->middleware('role');
Route::post('doctor/appointment/therapy/store', [DoctorAppointmentController::class, 'therapyStore'])->middleware('role');
Route::post('doctor/appointment/refer/store', [DoctorAppointmentController::class, 'referStore'])->middleware('role');
Route::get('doctor/therapy/list', [DoctorAppointmentController::class, 'therapyList'])->middleware('role');
Route::get('doctor/therapy/update/{id}/{p_id}', [DoctorAppointmentController::class, 'therapyUpdate'])->middleware('role');
Route::post('doctor/therapy/update/store', [DoctorAppointmentController::class, 'therapyUpdateStore'])->middleware('role');
Route::get('doctor/search/patient', [DoctorAppointmentController::class, 'searchPatientForm'])->middleware('role');
Route::get('doctor/patient/history/{id}', [DoctorAppointmentController::class, 'patientHistory'])->middleware('role');
Route::get('doctor/patient-appointment/view-history/{patient_id}', [DoctorAppointmentController::class, 'patientAppViewHistory'])->middleware('role');
Route::get('doctor/patient-appointment/update-history/{patient_id}', [DoctorAppointmentController::class, 'patientAppUpdateHistory'])->middleware('role');
Route::post('doctor/appointment/therapy/store-another-therapy', [DoctorAppointmentController::class, 'storeAnotherTherapy'])->middleware('role');
Route::get('doctor/search-patient/update-therapy-form/{id}/{p_id}', [DoctorAppointmentController::class, 'searchPatientTherapyUpdate'])->middleware('role');
Route::post('doctor/search-patient/update-therapy/store', [DoctorAppointmentController::class, 'searchPatientStoreTherapyUpdate'])->middleware('role');
Route::get('doctor/search-patient/add-therapy/{id}/{p_id}', [DoctorAppointmentController::class, 'searchPatientTherapyAddForm'])->middleware('role');
Route::post('doctor/search-patient/store-therapy', [DoctorAppointmentController::class, 'searchPatientStoreTherapy'])->middleware('role');

/**
 * employee route section
 *
 * @return
 */
Route::get('employee/home', [\App\Http\Controllers\Employee\HomeController::class, 'index'])->middleware('role');
// employee appointment
// Route::get('employee/appointment/add', [EmployeeController::class, 'appointmentAddForm'])->middleware('role');
Route::post('employee/appointment/assign', [EmployeeController::class, 'appointmentAssign'])->middleware('role');
Route::get('employee/appointment/edit/{id}', [EmployeeController::class, 'appointmentEdit'])->middleware('role');
Route::get('employee/appointment/list', [EmployeeController::class, 'appointmentList'])->middleware('role');
Route::get('employee/appointment/add', [EmployeeController::class, 'appointmentAdd'])->middleware('role');
Route::post('employee/appointment/add-store', [EmployeeController::class, 'appointmentAddStore'])->middleware('role');
Route::resource('employee/leave-application', LeaveApplicationController::class);

// employee doctor
Route::get('employee/doctor/add', [EmployeeController::class, 'doctorAdd'])->middleware('role');
Route::get(
    'employee/doctor/edit/{id}/{uid}',
    [EmployeeController::class, 'doctorEdit']
)->middleware('role');
Route::post(
    'employee/doctor/edit-store',
    [EmployeeController::class, 'doctorEditStore']
)->middleware('role');
Route::get(
    'employee/doctor/change-status/{id}',
    [EmployeeController::class, 'doctorChangeStatus']
)->middleware('role');
Route::get(
    'employee/doctor/delete/{id}',
    [EmployeeController::class, 'doctorDelete']
)->middleware('role');
Route::post('employee/doctor/store', [EmployeeController::class, 'doctorStore'])->middleware('role');
Route::get('employee/doctor/edit/{id}', [EmployeeController::class, 'doctorEdit'])->middleware('role');
Route::get('employee/doctor/list', [EmployeeController::class, 'doctorList'])->middleware('role');


Route::get('employee/requisition/list', [RequisitionController::class, 'index'])->middleware('role');
Route::get('employee/requisition/add', [RequisitionController::class, 'create'])->middleware('role');
Route::post('employee/requisition/store', [RequisitionController::class, 'store'])->name('requisition.store')->middleware('role');
//requisition.approve
Route::get('employee/requisition/approve/{requisition}', [RequisitionController::class, 'approve'])->name('requisition.approve')->middleware('role');



// employee therapy
Route::get('employee/therapy/add', [EmployeeController::class, 'therapyAdd'])->middleware('role');
Route::post('employee/therapy/store', [EmployeeController::class, 'therapyStore'])->middleware('role');
Route::get('employee/therapy/edit/{id}', [EmployeeController::class, 'therapyEdit'])->middleware('role');
Route::post(
    'employee/therapy/edit-store',
    [EmployeeController::class, 'therapyEditStore']
)->middleware('role');
Route::get(
    'employee/therapy/change-status/{id}',
    [EmployeeController::class, 'therapyChangeStatus']
)->middleware('role');
Route::get(
    'employee/therapy/delete/{id}',
    [EmployeeController::class, 'therapyDelete']
)->middleware('role');
Route::get('employee/therapy/list', [EmployeeController::class, 'therapyList'])->middleware('role');

// employee payment
Route::get('employee/payment/add', [EmployeeController::class, 'paymentAdd'])->middleware('role');
Route::get('employee/payment/store', [EmployeeController::class, 'index'])->middleware('role');
Route::get('employee/payment/payment-list', [EmployeeController::class, 'paymentList'])->middleware('role');
Route::get('employee/payment/history/{id}', [EmployeeController::class, 'paymentHistory'])->middleware('role');
Route::get('employee/payment/new/{id}', [EmployeeController::class, 'paymentAddNew'])->middleware('role');
Route::post('employee/payment/store', [EmployeeController::class, 'paymentStore'])->middleware('role');

//task
Route::get('employee/task', [\App\Http\Controllers\Employee\TaskController::class, 'index'])->middleware('role');
//employee/task/add
Route::get('employee/task/add', [\App\Http\Controllers\Employee\TaskController::class, 'create'])->middleware('role');
Route::post('employee/task/store', [\App\Http\Controllers\Employee\TaskController::class, 'store'])->middleware('role');



Route::get('employee/task/{task}/show', [\App\Http\Controllers\Employee\TaskController::class, 'show'])->name('emp.task.show')->middleware('role');
Route::get('employee/task/{task}/assign', [\App\Http\Controllers\Employee\TaskController::class, 'assign'])->name('task.assign')->middleware('role');



// employee patient
Route::get('employee/patient/add', [EmployeeController::class, 'patientAdd'])->middleware('role');
Route::get(
    'employee/patient/edit/{id}/{uid}',
    [EmployeeController::class, 'patientEdit']
)->middleware('role');
Route::post(
    'employee/patient/edit-store',
    [EmployeeController::class, 'patientEditStore']
)->middleware('role');
Route::get(
    'employee/patient/change-status/{id}',
    [EmployeeController::class, 'patientChangeStatus']
)->middleware('role');
Route::get(
    'employee/patient/delete/{id}',
    [EmployeeController::class, 'patientDelete']
)->middleware('role');
Route::post('employee/patient/store', [EmployeeController::class, 'patientStore'])->middleware('role');
Route::get('employee/patient/list', [EmployeeController::class, 'patientList'])->middleware('role');
Route::get('employee/patient/rfid/{id}', [EmployeeController::class, 'patientRFIDForm'])->middleware('role');
Route::post('employee/patient/updateRFID', [EmployeeController::class, 'patientUpdateRFID'])->middleware('role');
