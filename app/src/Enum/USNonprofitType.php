<?php

declare(strict_types=1);

namespace App\Enum;

use ApiPlatform\Metadata\Post;
use MyCLabs\Enum\Enum;

/**
 * USNonprofitType: Non-profit organization type originating from the United States.
 *
 * @see https://schema.org/USNonprofitType
 */
class USNonprofitType extends Enum
{
    /** @var string Nonprofit501q: Non-profit type referring to Credit Counseling Organizations. */
    public const NONPROFIT501Q = 'https://schema.org/Nonprofit501q';

    /** @var string Nonprofit501c6: Non-profit type referring to Business Leagues, Chambers of Commerce, Real Estate Boards. */
    public const NONPROFIT501C6 = 'https://schema.org/Nonprofit501c6';

    /** @var string Nonprofit501c16: Non-profit type referring to Cooperative Organizations to Finance Crop Operations. */
    public const NONPROFIT501C16 = 'https://schema.org/Nonprofit501c16';

    /** @var string Nonprofit501c24: Non-profit type referring to Section 4049 ERISA Trusts. */
    public const NONPROFIT501C24 = 'https://schema.org/Nonprofit501c24';

    /** @var string Nonprofit501e: Non-profit type referring to Cooperative Hospital Service Organizations. */
    public const NONPROFIT501E = 'https://schema.org/Nonprofit501e';

    /** @var string Nonprofit501c17: Non-profit type referring to Supplemental Unemployment Benefit Trusts. */
    public const NONPROFIT501C17 = 'https://schema.org/Nonprofit501c17';

    /** @var string Nonprofit501c7: Non-profit type referring to Social and Recreational Clubs. */
    public const NONPROFIT501C7 = 'https://schema.org/Nonprofit501c7';

    /** @var string Nonprofit501a: Non-profit type referring to Farmers’ Cooperative Associations. */
    public const NONPROFIT501A = 'https://schema.org/Nonprofit501a';

    /** @var string Nonprofit527: Non-profit type referring to political organizations. */
    public const NONPROFIT527 = 'https://schema.org/Nonprofit527';

    /** @var string Nonprofit501c9: Non-profit type referring to Voluntary Employee Beneficiary Associations. */
    public const NONPROFIT501C9 = 'https://schema.org/Nonprofit501c9';

    /** @var string Nonprofit501n: Non-profit type referring to Charitable Risk Pools. */
    public const NONPROFIT501N = 'https://schema.org/Nonprofit501n';

    /** @var string Nonprofit501c19: Non-profit type referring to Post or Organization of Past or Present Members of the Armed Forces. */
    public const NONPROFIT501C19 = 'https://schema.org/Nonprofit501c19';

    /** @var string Nonprofit501f: Non-profit type referring to Cooperative Service Organizations. */
    public const NONPROFIT501F = 'https://schema.org/Nonprofit501f';

    /** @var string Nonprofit501c12: Non-profit type referring to Benevolent Life Insurance Associations, Mutual Ditch or Irrigation Companies, Mutual or Cooperative Telephone Companies. */
    public const NONPROFIT501C12 = 'https://schema.org/Nonprofit501c12';

    /** @var string Nonprofit501c23: Non-profit type referring to Veterans Organizations. */
    public const NONPROFIT501C23 = 'https://schema.org/Nonprofit501c23';

    /** @var string Nonprofit501c25: Non-profit type referring to Real Property Title-Holding Corporations or Trusts with Multiple Parents. */
    public const NONPROFIT501C25 = 'https://schema.org/Nonprofit501c25';

    /** @var string Nonprofit501c10: Non-profit type referring to Domestic Fraternal Societies and Associations. */
    public const NONPROFIT501C10 = 'https://schema.org/Nonprofit501c10';

    /** @var string Nonprofit501c26: Non-profit type referring to State-Sponsored Organizations Providing Health Coverage for High-Risk Individuals. */
    public const NONPROFIT501C26 = 'https://schema.org/Nonprofit501c26';

    /** @var string Nonprofit501c21: Non-profit type referring to Black Lung Benefit Trusts. */
    public const NONPROFIT501C21 = 'https://schema.org/Nonprofit501c21';

    /** @var string Nonprofit501c18: Non-profit type referring to Employee Funded Pension Trust (created before 25 June 1959). */
    public const NONPROFIT501C18 = 'https://schema.org/Nonprofit501c18';

    /** @var string Nonprofit501c27: Non-profit type referring to State-Sponsored Workers' Compensation Reinsurance Organizations. */
    public const NONPROFIT501C27 = 'https://schema.org/Nonprofit501c27';

    /** @var string Nonprofit501c14: Non-profit type referring to State-Chartered Credit Unions, Mutual Reserve Funds. */
    public const NONPROFIT501C14 = 'https://schema.org/Nonprofit501c14';

    /** @var string Nonprofit501d: Non-profit type referring to Religious and Apostolic Associations. */
    public const NONPROFIT501D = 'https://schema.org/Nonprofit501d';

    /** @var string Nonprofit501k: Non-profit type referring to Child Care Organizations. */
    public const NONPROFIT501K = 'https://schema.org/Nonprofit501k';

    /** @var string Nonprofit501c2: Non-profit type referring to Title-holding Corporations for Exempt Organizations. */
    public const NONPROFIT501C2 = 'https://schema.org/Nonprofit501c2';

    /** @var string Nonprofit501c4: Non-profit type referring to Civic Leagues, Social Welfare Organizations, and Local Associations of Employees. */
    public const NONPROFIT501C4 = 'https://schema.org/Nonprofit501c4';

    /** @var string Nonprofit501c3: Non-profit type referring to Religious, Educational, Charitable, Scientific, Literary, Testing for Public Safety, Fostering National or International Amateur Sports Competition, or Prevention of Cruelty to Children or Animals Organizations. */
    public const NONPROFIT501C3 = 'https://schema.org/Nonprofit501c3';

    /** @var string Nonprofit501c15: Non-profit type referring to Mutual Insurance Companies or Associations. */
    public const NONPROFIT501C15 = 'https://schema.org/Nonprofit501c15';

    /** @var string Nonprofit501c5: Non-profit type referring to Labor, Agricultural and Horticultural Organizations. */
    public const NONPROFIT501C5 = 'https://schema.org/Nonprofit501c5';

    /** @var string Nonprofit501c13: Non-profit type referring to Cemetery Companies. */
    public const NONPROFIT501C13 = 'https://schema.org/Nonprofit501c13';

    /** @var string Nonprofit501c20: Non-profit type referring to Group Legal Services Plan Organizations. */
    public const NONPROFIT501C20 = 'https://schema.org/Nonprofit501c20';

    /** @var string Nonprofit501c1: Non-profit type referring to Corporations Organized Under Act of Congress, including Federal Credit Unions and National Farm Loan Associations. */
    public const NONPROFIT501C1 = 'https://schema.org/Nonprofit501c1';

    /** @var string Nonprofit501c8: Non-profit type referring to Fraternal Beneficiary Societies and Associations. */
    public const NONPROFIT501C8 = 'https://schema.org/Nonprofit501c8';

    /** @var string Nonprofit501c22: Non-profit type referring to Withdrawal Liability Payment Funds. */
    public const NONPROFIT501C22 = 'https://schema.org/Nonprofit501c22';

    /** @var string Nonprofit501c11: Non-profit type referring to Teachers' Retirement Fund Associations. */
    public const NONPROFIT501C11 = 'https://schema.org/Nonprofit501c11';

    /** @var string Nonprofit501c28: Non-profit type referring to National Railroad Retirement Investment Trusts. */
    public const NONPROFIT501C28 = 'https://schema.org/Nonprofit501c28';
}
