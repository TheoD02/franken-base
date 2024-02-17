<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Any specific branch of medical science or practice. Medical specialities include clinical specialties that pertain to particular organ systems and their respective disease states, as well as allied health specialties. Enumerated type.
 *
 * @see https://schema.org/MedicalSpecialty
 */
class MedicalSpecialty extends Enum
{
    /** @var string A specific branch of medical science that pertains to the health care of women, particularly in the diagnosis and treatment of disorders affecting the female reproductive system. */
    public const GYNECOLOGIC = 'https://schema.org/Gynecologic';

    /** @var string A specific branch of medical science that is concerned with poisons, their nature, effects and detection and involved in the treatment of poisoning. */
    public const TOXICOLOGIC = 'https://schema.org/Toxicologic';

    /** @var string A specific branch of medical science that pertains to diagnosis and treatment of disorders of digestive system. */
    public const GASTROENTEROLOGIC = 'https://schema.org/Gastroenterologic';

    /** @var string Something in medical science that pertains to infectious diseases, i.e. caused by bacterial, viral, fungal or parasitic infections. */
    public const INFECTIOUS = 'https://schema.org/Infectious';

    /** @var string A specific branch of medical science that studies the nerves and nervous system and its respective disease states. */
    public const NEUROLOGIC = 'https://schema.org/Neurologic';

    /** @var string A specific branch of medical science that pertains to the study of the kidneys and its respective disease states. */
    public const RENAL = 'https://schema.org/Renal';

    /** @var string A specific branch of medical science that specializes in the care of infants, children and adolescents. */
    public const PEDIATRIC = 'https://schema.org/Pediatric';

    /** @var string A specific branch of medical science that pertains to diagnosis and treatment of disorders of muscles, ligaments and skeletal system. */
    public const MUSCULOSKELETAL = 'https://schema.org/Musculoskeletal';

    /** @var string A health profession of a person formally educated and trained in the care of the sick or infirm person. */
    public const NURSING = 'https://schema.org/Nursing';

    /** @var string Branch of medicine that pertains to the health services to improve and protect community health, especially epidemiology, sanitation, immunization, and preventive medicine. */
    public const PUBLIC_HEALTH = 'https://schema.org/PublicHealth';

    /** @var string The medical care by a physician, or other health-care professional, who is the patient's first contact with the health-care system and who may recommend a specialist if necessary. */
    public const PRIMARY_CARE = 'https://schema.org/PrimaryCare';

    /** @var string A specific branch of medical science that pertains to study of anesthetics and their application. */
    public const ANESTHESIA = 'https://schema.org/Anesthesia';

    /** @var string A specific branch of medical science that pertains to diagnosis and treatment of disorders of heart and vasculature. */
    public const CARDIOVASCULAR = 'https://schema.org/Cardiovascular';

    /** @var string A specific branch of medical science that pertains to therapeutic or cosmetic repair or re-formation of missing, injured or malformed tissues or body parts by manual and instrumental means. */
    public const PLASTIC_SURGERY = 'https://schema.org/PlasticSurgery';

    /** @var string A specific branch of medical science that is concerned with the ear, nose and throat and their respective disease states. */
    public const OTOLARYNGOLOGIC = 'https://schema.org/Otolaryngologic';

    /** @var string The science or practice of testing visual acuity and prescribing corrective lenses. */
    public const OPTOMETRIC = 'https://schema.org/Optometric';

    /** @var string Radiography is an imaging technique that uses electromagnetic radiation other than visible light, especially X-rays, to view the internal structure of a non-uniformly composed and opaque object such as the human body. */
    public const RADIOGRAPHY = 'https://schema.org/Radiography';

    /** @var string A specific branch of medical science that deals with the evaluation and initial treatment of medical conditions caused by trauma or sudden illness. */
    public const EMERGENCY = 'https://schema.org/Emergency';

    /** @var string The practice of treatment of disease, injury, or deformity by physical methods such as massage, heat treatment, and exercise rather than by drugs or surgery. */
    public const PHYSIOTHERAPY = 'https://schema.org/Physiotherapy';

    /** @var string A specific branch of medical science that is concerned with the study of the cause, origin and nature of a disease state, including its consequences as a result of manifestation of the disease. In clinical care, the term is used to designate a branch of medicine using laboratory tests to diagnose and determine the prognostic significance of illness. */
    public const PATHOLOGY = 'https://schema.org/Pathology';

    /** @var string A specific branch of medical science that deals with benign and malignant tumors, including the study of their development, diagnosis, treatment and prevention. */
    public const ONCOLOGIC = 'https://schema.org/Oncologic';

    /** @var string A specific branch of medical science that deals with the study and treatment of rheumatic, autoimmune or joint diseases. */
    public const RHEUMATOLOGIC = 'https://schema.org/Rheumatologic';

    /** @var string A branch of medicine that is involved in the dental care. */
    public const DENTISTRY = 'https://schema.org/Dentistry';

    /** @var string A specific branch of medical science that is concerned with the study, treatment, and prevention of mental illness, using both medical and psychological therapies. */
    public const PSYCHIATRIC = 'https://schema.org/Psychiatric';

    /** @var string The therapy that is concerned with the maintenance or improvement of respiratory function (as in patients with pulmonary disease). */
    public const RESPIRATORY_THERAPY = 'https://schema.org/RespiratoryTherapy';

    /** @var string The practice or art and science of preparing and dispensing drugs and medicines. */
    public const PHARMACY_SPECIALTY = 'https://schema.org/PharmacySpecialty';

    /** @var string A medical science pertaining to chemical, hematological, immunologic, microscopic, or bacteriological diagnostic analyses or research. */
    public const LABORATORY_SCIENCE = 'https://schema.org/LaboratoryScience';

    /** @var string A specific branch of medical science that pertains to the study of the respiratory system and its respective disease states. */
    public const PULMONARY = 'https://schema.org/Pulmonary';

    /** @var string A specific branch of medical science that pertains to diagnosis and treatment of disorders of endocrine glands and their secretions. */
    public const ENDOCRINE = 'https://schema.org/Endocrine';

    /** @var string Podiatry is the care of the human foot, especially the diagnosis and treatment of foot disorders. */
    public const PODIATRIC = 'https://schema.org/Podiatric';

    /** @var string A specific branch of medical science that pertains to hereditary transmission and the variation of inherited characteristics and disorders. */
    public const GENETIC = 'https://schema.org/Genetic';

    /** @var string A specific branch of medical science that pertains to diagnosis and treatment of disorders of blood and blood producing organs. */
    public const HEMATOLOGIC = 'https://schema.org/Hematologic';

    /** @var string A nurse-like health profession that deals with pregnancy, childbirth, and the postpartum period (including care of the newborn), besides sexual and reproductive health of women throughout their lives. */
    public const MIDWIFERY = 'https://schema.org/Midwifery';

    /** @var string A specific branch of medical science that pertains to treating diseases, injuries and deformities by manual and instrumental means. */
    public const SURGICAL = 'https://schema.org/Surgical';

    /** @var string Something relating to or practicing dermatology. */
    public const DERMATOLOGIC = 'https://schema.org/Dermatologic';

    /** @var string A specific branch of medical science that pertains to diagnosis and treatment of disorders of skin. */
    public const DERMATOLOGY = 'https://schema.org/Dermatology';

    /** @var string The scientific study and treatment of defects, disorders, and malfunctions of speech and voice, as stuttering, lisping, or lalling, and of language disturbances, as aphasia or delayed language acquisition. */
    public const SPEECH_PATHOLOGY = 'https://schema.org/SpeechPathology';

    /** @var string Dietetics and nutrition as a medical specialty. */
    public const DIET_NUTRITION = 'https://schema.org/DietNutrition';

    /** @var string A specific branch of medical science that is concerned with the diagnosis and treatment of diseases pertaining to the urinary tract and the urogenital system. */
    public const UROLOGIC = 'https://schema.org/Urologic';

    /** @var string A specific branch of medical science that specializes in the care of women during the prenatal and postnatal care and with the delivery of the child. */
    public const OBSTETRIC = 'https://schema.org/Obstetric';

    /** @var string A specific branch of medical science that is concerned with the diagnosis and treatment of diseases, debilities and provision of care to the aged. */
    public const GERIATRIC = 'https://schema.org/Geriatric';

    /** @var string A field of public health focusing on improving health characteristics of a defined population in relation with their geographical or environment areas. */
    public const COMMUNITY_HEALTH = 'https://schema.org/CommunityHealth';
}
