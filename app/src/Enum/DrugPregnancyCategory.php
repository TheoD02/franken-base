<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Categories that represent an assessment of the risk of fetal injury due to a drug or pharmaceutical used as directed by the mother during pregnancy.
 *
 * @see https://schema.org/DrugPregnancyCategory
 */
class DrugPregnancyCategory extends Enum
{
    /** @var string A designation by the US FDA signifying that there is positive evidence of human fetal risk based on adverse reaction data from investigational or marketing experience or studies in humans, but potential benefits may warrant use of the drug in pregnant women despite potential risks. */
    public const F_D_ACATEGORY_D = 'https://schema.org/FDAcategoryD';

    /** @var string A designation by the US FDA signifying that studies in animals or humans have demonstrated fetal abnormalities and/or there is positive evidence of human fetal risk based on adverse reaction data from investigational or marketing experience, and the risks involved in use of the drug in pregnant women clearly outweigh potential benefits. */
    public const F_D_ACATEGORY_X = 'https://schema.org/FDAcategoryX';

    /** @var string A designation by the US FDA signifying that animal reproduction studies have failed to demonstrate a risk to the fetus and there are no adequate and well-controlled studies in pregnant women. */
    public const F_D_ACATEGORY_B = 'https://schema.org/FDAcategoryB';

    /** @var string A designation by the US FDA signifying that animal reproduction studies have shown an adverse effect on the fetus and there are no adequate and well-controlled studies in humans, but potential benefits may warrant use of the drug in pregnant women despite potential risks. */
    public const F_D_ACATEGORY_C = 'https://schema.org/FDAcategoryC';

    /** @var string A designation that the drug in question has not been assigned a pregnancy category designation by the US FDA. */
    public const F_D_ANOT_EVALUATED = 'https://schema.org/FDAnotEvaluated';

    /** @var string A designation by the US FDA signifying that adequate and well-controlled studies have failed to demonstrate a risk to the fetus in the first trimester of pregnancy (and there is no evidence of risk in later trimesters). */
    public const F_D_ACATEGORY_A = 'https://schema.org/FDAcategoryA';
}
