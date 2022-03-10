<?php

namespace App\Http\Resources\V1\Cecy\Courses;

use App\Http\Resources\V1\Cecy\Catalogues\CatalogueResource;
use App\Http\Resources\V1\Cecy\Instructors\InstructorResource;
use App\Http\Resources\V1\Cecy\Planifications\PlanificationResource;
use App\Http\Resources\V1\Core\CareerResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursePublicPrivateResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            // 'academicPeriod' => CatalogueResource::make($this->academicPeriod),
            // 'area' => CatalogueResource::make($this->area),
            // 'entityCertification' => CatalogueResource::make($this->entityCertification),
            // 'career' => CareerResource::make($this->career),
            'category' => CatalogueResource::make($this->category),
            // 'formationType' => CatalogueResource::make($this->formationType),
            // 'certifiedType' => CatalogueResource::make($this->certifiedType),
            // 'complianceIndicator' => CatalogueResource::make($this->complianceIndicator),
            // 'control' => CatalogueResource::make($this->control),
            // 'courseType' => CatalogueResource::make($this->courseType),
            // 'frequency' => CatalogueResource::make($this->frequency),
            // 'modality' => CatalogueResource::make($this->modality),
            // 'meanVerification' => CatalogueResource::make($this->meanVerification),
            // 'responsible' => InstructorResource::make($this->responsible),
            // 'speciality' => CatalogueResource::make($this->speciality),
            'state' => CatalogueResource::make($this->state),
            'planifications' => PlanificationResource::collection($this->planifications),
            // 'catalogues' => CatalogueResource::collection($this->catalogues),
            // 'abbreviation' => $this->abbreviation,
            // 'alignment' => $this->alignment,
            // 'approvedAt' => $this->approved_at,
            // 'bibliographies' => $this->bibliographies,
            'code' => $this->code,
            'cost' => $this->cost,
            // 'duration' => $this->duration,
            // 'evaluationMechanisms' => $this->evaluation_mechanisms,
            // 'expiredAt' => $this->expired_at,
            // 'facilities' => $this->facilities,
            'free' => $this->free,
            'name' => $this->name,
            // 'needs' => $this->needs,
            // 'neededAt' => $this->needed_at,
            // 'recordNumber' => $this->record_number,
            // 'learningEnvironments' => $this->learning_environments,
            // 'localProposal' => $this->local_proposal,
            // 'objective' => $this->objective,
            // 'observation' => $this->observation,
            // 'practicalPhase' => $this->practical_phase,
            // 'practiceHours' => $this->practice_hours,
            // 'proposedAt' => $this->proposed_at,
            // 'project' => $this->project,
            // 'requiredInstallingSources' => $this->required_installing_sources,
            // 'setecName' => $this->setec_name,
        ];
    }
}
