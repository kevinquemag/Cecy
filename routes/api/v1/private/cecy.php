<?php

use App\Http\Controllers\V1\Cecy\AuthorityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Cecy\CatalogueController;
use App\Http\Controllers\V1\Cecy\ClassroomController;
use App\Http\Controllers\V1\Cecy\CourseController;
use App\Http\Controllers\V1\Cecy\DetailAttendanceController;
use App\Http\Controllers\V1\Cecy\DetailPlanificationController;
use App\Http\Controllers\V1\Cecy\InstitutionController;
use App\Http\Controllers\V1\Cecy\TopicController;
use App\Http\Controllers\V1\Cecy\PrerequisiteController;
use App\Http\Controllers\V1\Cecy\PlanificationController;
use App\Http\Controllers\V1\Cecy\RequirementController;
use App\Http\Controllers\V1\Cecy\SchoolPeriodController;
use App\Http\Controllers\V1\Cecy\InstructorController;
use \App\Http\Controllers\V1\Cecy\DetailSchoolPeriodController;
use App\Http\Controllers\V1\Cecy\PhotographicRecordController;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use App\Http\Controllers\V1\Cecy\RegistrationController;
use App\Http\Controllers\V1\Cecy\CertificateController;
use App\Http\Controllers\V1\Cecy\AttendanceController;
use App\Http\Controllers\V1\Cecy\ParticipantController;

/***********************************************************************************************************************
 * CATALOGUES
 **********************************************************************************************************************/
Route::prefix('catalogue/{catalogue}')->group(function () {
    Route::prefix('file')->group(function () {
        Route::get('{file}/download', [CatalogueController::class, 'downloadFile']);
        Route::get('download', [CatalogueController::class, 'downloadFiles']);
        Route::get('', [CatalogueController::class, 'indexFiles']);
        Route::get('{file}', [CatalogueController::class, 'showFile']);
        Route::post('', [CatalogueController::class, 'uploadFile']);
        Route::post('{file}', [CatalogueController::class, 'updateFile']);
        Route::delete('{file}', [CatalogueController::class, 'destroyFile']);
        Route::patch('', [CatalogueController::class, 'destroyFiles']);
    });
    Route::prefix('image')->group(function () {
        Route::get('{image}/download', [CatalogueController::class, 'downloadImage'])->withoutMiddleware('auth:sanctum');
        Route::get('', [CatalogueController::class, 'indexImages']);
        Route::get('{image}', [CatalogueController::class, 'showImage']);
        Route::post('', [CatalogueController::class, 'uploadImage']);
        Route::post('{image}', [CatalogueController::class, 'updateImage']);
        Route::delete('{image}', [CatalogueController::class, 'destroyImage']);
        Route::patch('', [CatalogueController::class, 'destroyImages']);
    });
});

/***********************************************************************************************************************
 * INSTITUTIONS
 **********************************************************************************************************************/

Route::apiResource('institutions', InstitutionController::class);


Route::prefix('institution')->group(function () {
    Route::patch('{institution}', [InstitutionController::class, 'destroys']);
});

/***********************************************************************************************************************
 * PLANIFICATIONS
 **********************************************************************************************************************/
//Route::apiResource('planifications',[PlanificationController::class]);

Route::prefix('planification')->group(function () {
    Route::get('planifications-period-state', [PlanificationController::class, 'getPlanificationsByPeriodState']);
    Route::get('by-detail-planification', [PlanificationController::class, 'getPlanificationsByDetailPlanification']);
    Route::get('course_parallels-works', [PlanificationController::class, 'getCoursesParallelsWorkdays']);
    Route::get('planfications-course/{course}', [PlanificationController::class, 'getPlanificationsByCourse']);
    Route::get('kpis/{state}', [PlanificationController::class, 'getKpi']);
    Route::put('{planification}', [PlanificationController::class, 'updateStatePlanification']);
});

Route::prefix('planification/{planification}')->group(function () {
    Route::get('', [PlanificationController::class, 'getPlanitification']);
    Route::put('dates-and-needs-planifications', [PlanificationController::class, 'updateDatesAndNeedsInPlanification']);
    Route::post('create-planifications-course', [PlanificationController::class, 'storePlanificationByCourse']);
    Route::put('planifications-cecy', [PlanificationController::class, 'updatePlanificationByCecy']);
    Route::put('assign-code-planification', [PlanificationController::class, 'assignCodeToPlanification']);
    Route::put('approve-planification', [PlanificationController::class, 'approvePlanification']);
    Route::get('/curricular-design', [PlanificationController::class, 'curricularDesign']);
    Route::get('/informe-final', [PlanificationController::class, 'informeFinal']);


});




/***********************************************************************************************************************
 * DETAIL PLANIFICATIONS
 **********************************************************************************************************************/
Route::prefix('detailPlanification')->group(function () {
    Route::get('{planification}', [DetailPlanificationController::class, 'getDetailPlanificationsByPlanification']);
    Route::get('/detail-course/{course}', [DetailPlanificationController::class, 'getDetailPlanificationsByCourse']);
    Route::post('', [DetailPlanificationController::class, 'registerDetailPlanification']);
    Route::patch('', [DetailPlanificationController::class, 'destroysDetailPlanifications']);
    Route::get('responsible', [DetailPlanificationController::class, 'getDetailPlanificationsByResponsibleCourse']);
});

Route::prefix('detailPlanification/{detailPlanification}')->group(function () {
    Route::get('', [DetailPlanificationController::class, 'showDetailPlanification']);
    Route::put('', [DetailPlanificationController::class, 'updateDetailPlanification']);
    Route::put('/cecy', [DetailPlanificationController::class, 'updatedetailPlanificationByCecy']);
    Route::delete('', [DetailPlanificationController::class, 'deleteDetailPlanification']);
});




/***********************************************************************************************************************
 * COURSES
 **********************************************************************************************************************/

Route::prefix('courses')->group(function () {
    Route::get('', [CourseController::class, 'getCourses']);
    Route::post('', [CourseController::class, 'storeNewCourse']);
    Route::get('private-courses-participant', [CourseController::class, 'getPrivateCoursesByParticipantType']);
    Route::get('private-courses-category/{category}', [CourseController::class, 'getPrivateCoursesByParticipantTypeAndCategory']);
    Route::get('by-responsible', [CourseController::class, 'getCoursesByResponsibleCourse']);
    Route::get('by-instructor/{instructor}', [CourseController::class, 'getCoursesByInstructor']);
    Route::get('by-coodinator', [CourseController::class, 'getCoursesByCoordinator']);
    Route::get('kpi', [CourseController::class, 'getCoursesKPI']);
    Route::get('year-schedule', [CourseController::class, 'showYearSchedule']);
    Route::get('career/{career}', [CourseController::class, 'getCoursesByCareer']);
    Route::put('{course}', [CourseController::class, 'updateStateCourse']);
});

Route::prefix('courses')->group(function () {
    Route::get('', [CourseController::class, 'getCourses']);
    // Route::get('inform-course-needs/{course}', 'App\Http\Controllers\V1\Cecy\CourseController@informCourseNeeds');

    // Route::get('inform-course-needs/{course}', [CourseController::class, 'informCourseNeeds']);

});

Route::prefix('courses/{course}')->group(function () {
    Route::get('', [CourseController::class, 'show']);
    Route::prefix('')->group(function () {

        Route::get('/topics', [TopicController::class, 'getTopics']);
        Route::get('/topics/all', [TopicController::class, 'getAllTopics']);
        Route::post('/topics', [TopicController::class, 'storesTopics']);
        Route::put('/topics', [TopicController::class, 'updateTopics']);
        Route::delete('/topics/{topic}', [TopicController::class, 'destroyTopic']);
        Route::get('/instructors', [TopicController::class, 'getInstructors']);
    });
    Route::prefix('')->group(function () {
        Route::get('/prerequisites/all', [PrerequisiteController::class, 'getPrerequisitesAll']);
        Route::get('/prerequisites', [PrerequisiteController::class, 'getPrerequisites']);
        Route::post('/prerequisites', [PrerequisiteController::class, 'storePrerequisite']);
        Route::put('/prerequisites/{prerequisite}', [PrerequisiteController::class, 'updatePrerequisite']);
        Route::delete('/prerequisites/{prerequisite}', [PrerequisiteController::class, 'destroyPrerequisite']);
        Route::patch('/prerequisites/destroys', [PrerequisiteController::class, 'destroysPrerequisites']);
    });
    Route::prefix('')->group(function () {
        Route::put('/curricular-design', [CourseController::class, 'updateCurricularDesignCourse']);
        Route::patch('/general-information', [CourseController::class, 'updateGeneralInformationCourse']);
        Route::patch('/assign-code', [CourseController::class, 'assignCodeToCourse']);
        Route::patch('/not-approve-reason', [CourseController::class, 'notApproveCourseReason']);
        Route::get('/inform-course-needs', [CourseController::class, 'informCourseNeeds']);
        Route::get('/final-report', [CourseController::class, 'showCourseFinalReport']);
        // Route::get('inform-course-needs/{course}', 'App\Http\Controllers\V1\Cecy\CourseController@informCourseNeeds');
    });
    Route::prefix('image')->group(function () {
        Route::get('{image}', [CourseController::class, 'indexPublicImages']);
        Route::post('', [CourseController::class, 'uploadPublicImage']);
    });
});



Route::get('/inform', function () {
    $pdf = PDF::loadView('reports/informe-final');
    $pdf->setOptions([
        'page-size' => 'a4'
    ]);

    return $pdf->inline('Informe.pdf');
});

/***********************************************************************************************************************
 * DETAIL ATTENDANCES
 **********************************************************************************************************************/

Route::prefix('detailAttendance')->group(function () {
    Route::get('participant/{registration}', [DetailAttendanceController::class, 'showAttedanceParticipant']);
    Route::patch('/{detailAttendance}', [DetailAttendanceController::class, 'updatDetailAttendanceTeacher']);
    Route::get('/{detail_planification}', [DetailAttendanceController::class, 'getDetailAttendancesByParticipant']);
    Route::get('no-paginate/{detail_planification}', [DetailAttendanceController::class, 'getDetailAttendancesByParticipantWithOutPaginate']);
    Route::get('/current-date/{detail_planification}', [DetailAttendanceController::class, 'getCurrentDateDetailAttendance']);
});

Route::prefix('detailAttendance/{detailAttendance}')->group(function () {
    Route::prefix('')->group(function () {
        Route::patch('save-detail-attendance', [DetailAttendanceController::class, 'saveDetailAttendance']);
    });
});


/***********************************************************************************************************************
 * CERTIFICATES
 **********************************************************************************************************************/
Route::prefix('certificate')->group(function () {

    Route::get('pdf-student', [CertificateController::class, 'generatePdf']);
    Route::post('pdf-studentData', [CertificateController::class, 'importData']);
    Route::get('pdf-students', [CertificateController::class, 'exportToXlsl']);
    Route::post('pdf-instructors', [CertificateController::class, 'generatePdfInstructor']);
    Route::post('registration/{registration}/catalogue/{catalogue}/file/{file}', [CertificateController::class, 'downloadCertificateByParticipant']);
    Route::get('catalogue/{catalogue}/file/{file}', [CertificateController::class, 'downloadFileCertificates']);
    Route::post('catalogue/{catalogue}', [CertificateController::class, 'uploadFileCertificate']);
    Route::post('firm/catalogue/{catalogue}', [CertificateController::class, 'uploadFileCertificateFirm']);

    
});

/***********************************************************************************************************************
 * SCHOOL PERIODS
 **********************************************************************************************************************/

Route::apiResource('school-periods', SchoolPeriodController::class);

Route::prefix('school-period')->group(function () {
    Route::patch('{school-period}', [SchoolPeriodController::class, 'destroys']);
});

/***********************************************************************************************************************
 * CLASSROOMS
 **********************************************************************************************************************/

Route::apiResource('classroom', ClassroomController::class);

Route::prefix('classroom')->group(function () {
    Route::patch('/{classroom}', [ClassroomController::class, 'destroys']);
});

/***********************************************************************************************************************
 * INSTRUCTORS
 **********************************************************************************************************************/
Route::apiResource('instructors', InstructorController::class);

Route::prefix('instructor')->group(function () {
    Route::post('create', [InstructorController::class, 'storeInstructor']);
    Route::get('courses', [InstructorController::class, 'getCourses']);
    Route::get('instructor-courses', [InstructorController::class, 'getInstructorByCourses']);
    Route::get('instructor-information', [InstructorController::class, 'getInstructorsInformationByCourse']);
    Route::put('type-instructor/{instructor}', [InstructorController::class, 'updateTypeInstructors']);
    Route::get('destroy/{instructor}', [InstructorController::class, 'destroyInstructors']);
});

/***********************************************************************************************************************
 * REGISTRATIONS
 **********************************************************************************************************************/
Route::prefix('registration')->group(function () {
    Route::post('register-student/{detailPlanification}', [RegistrationController::class, 'registerStudent']);
    Route::post('register-student', [RegistrationController::class, 'registerStudent']);
    Route::get('participant/{detailPlanification}', [RegistrationController::class, 'getParticipant']);
    Route::patch('nullify-registration', [RegistrationController::class, 'nullifyRegistration']);
    Route::patch('nullify-registrations', [RegistrationController::class, 'nullifyRegistrations']);
    Route::patch('participant-grades/{registration}', [RegistrationController::class, 'updateGradesParticipant']);
});
/***********************************************************************************************************************
 * PARTICIPANTS
 **********************************************************************************************************************/

Route::prefix('participant')->group(function () {
    Route::put('update-registration/{registration}', [ParticipantController::class, 'participantRegistrationStateModification']);
    Route::get('detail-planification/{detailPlanification}', [ParticipantController::class, 'getParticipantsByPlanification']);
    Route::get('information/{registration}', [ParticipantController::class, 'getParticipantInformation']);
    Route::patch('participant-registration/{registration}', [ParticipantController::class, 'registerParticipant']);
});
/***********************************************************************************************************************
 * DETAIL SCHOOL PERIOD
 **********************************************************************************************************************/
Route::apiResource('detail-school-periods', DetailSchoolPeriodController::class);
Route::prefix('detail-school-period')->group(function () {
    Route::patch('/{detail-school-period}', [DetailSchoolPeriodController::class, 'destroys']);
});

/*
******************************************************************************************************************
 * REQUERIMENTS
 **********************************************************************************************************************/


Route::prefix('requirement')->group(function () {
    Route::get('', [RequirementController::class, 'getAllRequirement']);
    Route::get('/{requirements}', [RequirementController::class, 'getRequirement']);
    Route::post('/{requirements}', [RequirementController::class, 'storeRequirement']);
    Route::put('/{requirements}', [RequirementController::class, 'updateRequirement']);
    Route::delete('/{requirements}', [RequirementController::class, 'destroy']);
});

Route::prefix('requirement')->group(function () {
    Route::get('file', [RequirementController::class, 'showFile']);
    Route::get('image', [RequirementController::class, 'showImage']);
});

/***********************************************************************************************************************
 * AUTHORITIES
 **********************************************************************************************************************/

Route::apiResource('authorities', AuthorityController::class);


Route::prefix('authority')->group(function () {
    Route::patch('{authority}', [AuthorityController::class, 'destroys']);
});

/***********************************************************************************************************************
 * ATTENDANCES
 **********************************************************************************************************************/

Route::apiResource('attendances', AttendanceController::class);

Route::prefix('attendance')->group(function () {
    Route::get('detail/{detailPlanification}', [AttendanceController::class, 'getAttendancesByDetailPlanification']);
});

Route::prefix('pdf')->group(function () {
    Route::get('photographic-record/{course}', [AttendanceController::class, 'showPhotographicRecord']);
    Route::get('year-schedule', [CourseController::class, 'showYearSchedule']);

    // Route::get('inform-course-needs/{course}', 'App\Http\Controllers\V1\Cecy\CourseController@informCourseNeeds');

    // Route::get('inform-course-needs/{course}', [CourseController::class, 'informCourseNeeds']);

});

/***********************************************************************************************************************
 * RECORDS
 **********************************************************************************************************************/

Route::apiResource('records', PhotographicRecordController::class);

Route::prefix('record')->group(function () {
    Route::get('{photographicRecord}', [PhotographicRecordController::class, 'show']);
    Route::get('detail/{detailPlanification}', [PhotographicRecordController::class, 'getDetails']);
});

/*****************************************
 * REGISTRATIONS 
 ****************************************/

Route::prefix('registration')->group(function () {
    Route::get('courses-by-participant', [RegistrationController::class, 'getCoursesByParticipant']);
    Route::get('courses-by-participant/{registration}', [RegistrationController::class, 'getCoursesByParticipant']);
    //ruta para consulta las notas de registration
    //Route::get('courses-by-participant', [RegistrationController::class, 'getCoursesByParticipant']);
    Route::get('records-returned-by-registration', [RegistrationController::class, 'recordsReturnedByRegistration']);
    Route::get('show-participants', [RegistrationController::class, 'showParticipants']);
    Route::get('download-file', [RegistrationController::class, 'downloadFile']);
    Route::post('nullify-registrations', [RegistrationController::class, 'nullifyRegistrations']);
    Route::patch('nullify-registration/{registration}', [RegistrationController::class, 'nullifyRegistration']);
    Route::get('show-record-competitor/{detailPlanification}', [RegistrationController::class, 'showRecordCompetitor']);
    Route::patch('show-participant-grades', [RegistrationController::class, 'ShowParticipantGrades']);
    Route::put('upload-file', [RegistrationController::class, 'uploadFile']);
    Route::get('download-file-grades', [RegistrationController::class, 'downloadFileGrades']);
    Route::get('show-file', [RegistrationController::class, 'showFile']);
    Route::patch('destroy-file', [RegistrationController::class, 'destroyFile']);
});
