<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * HealthAspectEnumeration enumerates several aspects of health content online, each of which might be described using \[\[hasHealthAspect\]\] and \[\[HealthTopicContent\]\].
 *
 * @see https://schema.org/HealthAspectEnumeration
 */
class HealthAspectEnumeration extends Enum
{
    /** @var string Other prominent or relevant topics tied to the main topic. */
    public const RELATED_TOPICS_HEALTH_ASPECT = 'https://schema.org/RelatedTopicsHealthAspect';

    /** @var string Content about the real life experience of patients or people that have lived a similar experience about the topic. May be forums, topics, Q-and-A and related material. */
    public const PATIENT_EXPERIENCE_HEALTH_ASPECT = 'https://schema.org/PatientExperienceHealthAspect';

    /** @var string Information about how or where to find a topic. Also may contain location data that can be used for where to look for help if the topic is observed. */
    public const HOW_OR_WHERE_HEALTH_ASPECT = 'https://schema.org/HowOrWhereHealthAspect';

    /** @var string Content that discusses practical and policy aspects for getting access to specific kinds of healthcare (e.g. distribution mechanisms for vaccines). */
    public const GETTING_ACCESS_HEALTH_ASPECT = 'https://schema.org/GettingAccessHealthAspect';

    /** @var string Stages that can be observed from a topic. */
    public const STAGES_HEALTH_ASPECT = 'https://schema.org/StagesHealthAspect';

    /** @var string Information about actions or measures that can be taken to avoid getting the topic or reaching a critical situation related to the topic. */
    public const PREVENTION_HEALTH_ASPECT = 'https://schema.org/PreventionHealthAspect';

    /** @var string Content discussing ingredients-related aspects of a health topic. */
    public const INGREDIENTS_HEALTH_ASPECT = 'https://schema.org/IngredientsHealthAspect';

    /** @var string Information about questions that may be asked, when to see a professional, measures before seeing a doctor or content about the first consultation. */
    public const SEE_DOCTOR_HEALTH_ASPECT = 'https://schema.org/SeeDoctorHealthAspect';

    /** @var string Content about the allergy-related aspects of a health topic. */
    public const ALLERGIES_HEALTH_ASPECT = 'https://schema.org/AllergiesHealthAspect';

    /** @var string Content about how to screen or further filter a topic. */
    public const SCREENING_HEALTH_ASPECT = 'https://schema.org/ScreeningHealthAspect';

    /** @var string Related topics may be treated by a Topic. */
    public const MAY_TREAT_HEALTH_ASPECT = 'https://schema.org/MayTreatHealthAspect';

    /** @var string Content that discusses and explains how a particular health-related topic works, e.g. in terms of mechanisms and underlying science. */
    public const HOW_IT_WORKS_HEALTH_ASPECT = 'https://schema.org/HowItWorksHealthAspect';

    /** @var string Content about the safety-related aspects of a health topic. */
    public const SAFETY_HEALTH_ASPECT = 'https://schema.org/SafetyHealthAspect';

    /** @var string Typical progression and happenings of life course of the topic. */
    public const PROGNOSIS_HEALTH_ASPECT = 'https://schema.org/PrognosisHealthAspect';

    /** @var string Information about the risk factors and possible complications that may follow a topic. */
    public const RISKS_OR_COMPLICATIONS_HEALTH_ASPECT = 'https://schema.org/RisksOrComplicationsHealthAspect';

    /** @var string Content about contagion mechanisms and contagiousness information over the topic. */
    public const CONTAGIOUSNESS_HEALTH_ASPECT = 'https://schema.org/ContagiousnessHealthAspect';

    /** @var string Content discussing pregnancy-related aspects of a health topic. */
    public const PREGNANCY_HEALTH_ASPECT = 'https://schema.org/PregnancyHealthAspect';

    /** @var string Content about common misconceptions and myths that are related to a topic. */
    public const MISCONCEPTIONS_HEALTH_ASPECT = 'https://schema.org/MisconceptionsHealthAspect';

    /** @var string Overview of the content. Contains a summarized view of the topic with the most relevant information for an introduction. */
    public const OVERVIEW_HEALTH_ASPECT = 'https://schema.org/OverviewHealthAspect';

    /** @var string Content about the benefits and advantages of usage or utilization of topic. */
    public const BENEFITS_HEALTH_ASPECT = 'https://schema.org/BenefitsHealthAspect';

    /** @var string Treatments or related therapies for a Topic. */
    public const TREATMENTS_HEALTH_ASPECT = 'https://schema.org/TreatmentsHealthAspect';

    /** @var string Information about the causes and main actions that gave rise to the topic. */
    public const CAUSES_HEALTH_ASPECT = 'https://schema.org/CausesHealthAspect';

    /** @var string Content about the effectiveness-related aspects of a health topic. */
    public const EFFECTIVENESS_HEALTH_ASPECT = 'https://schema.org/EffectivenessHealthAspect';

    /** @var string Self care actions or measures that can be taken to sooth, health or avoid a topic. This may be carried at home and can be carried/managed by the person itself. */
    public const SELF_CARE_HEALTH_ASPECT = 'https://schema.org/SelfCareHealthAspect';

    /** @var string Information about coping or life related to the topic. */
    public const LIVING_WITH_HEALTH_ASPECT = 'https://schema.org/LivingWithHealthAspect';

    /** @var string Symptoms or related symptoms of a Topic. */
    public const SYMPTOMS_HEALTH_ASPECT = 'https://schema.org/SymptomsHealthAspect';

    /** @var string Side effects that can be observed from the usage of the topic. */
    public const SIDE_EFFECTS_HEALTH_ASPECT = 'https://schema.org/SideEffectsHealthAspect';

    /** @var string Content about how, when, frequency and dosage of a topic. */
    public const USAGE_OR_SCHEDULE_HEALTH_ASPECT = 'https://schema.org/UsageOrScheduleHealthAspect';

    /** @var string Categorization and other types related to a topic. */
    public const TYPES_HEALTH_ASPECT = 'https://schema.org/TypesHealthAspect';
}
