<?php

use Module\Api\Enum\ValidationErrorCodeEnum;

return array(
    'This value should be false.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_BE_FALSE->value,
    'This value should be true.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_BE_TRUE->value,
    'This value should be of type {{ type }}.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_BE_OF_TYPE->value,
    'This value should be blank.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_BE_BLANK->value,
    'The value you selected is not a valid choice.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_BE_VALID_CHOICE->value,
    'You must select at least {{ limit }} choice.' => ValidationErrorCodeEnum::ERR_MUST_SELECT_AT_LEAST_N_CHOICES->value,
    'You must select at least {{ limit }} choices.' => ValidationErrorCodeEnum::ERR_MUST_SELECT_AT_LEAST_N_CHOICES->value,
    'You must select at most {{ limit }} choice.' => ValidationErrorCodeEnum::ERR_MUST_SELECT_AT_MOST_N_CHOICES->value,
    'You must select at most {{ limit }} choices.' => ValidationErrorCodeEnum::ERR_MUST_SELECT_AT_MOST_N_CHOICES->value,
    'One or more of the given values is invalid.' => ValidationErrorCodeEnum::ERR_ONE_OR_MORE_INVALID_VALUES->value,
    'This field was not expected.' => ValidationErrorCodeEnum::ERR_FIELD_NOT_EXPECTED->value,
    'This field is missing.' => ValidationErrorCodeEnum::ERR_FIELD_MISSING->value,
    'This value is not a valid date.' => ValidationErrorCodeEnum::ERR_VALUE_NOT_VALID_DATE->value,
    'This value is not a valid datetime.' => ValidationErrorCodeEnum::ERR_VALUE_NOT_VALID_DATETIME->value,
    'This value is not a valid email address.' => ValidationErrorCodeEnum::ERR_VALUE_NOT_VALID_EMAIL->value,
    'The file could not be found.' => ValidationErrorCodeEnum::ERR_FILE_NOT_FOUND->value,
    'The file is not readable.' => ValidationErrorCodeEnum::ERR_FILE_NOT_READABLE->value,
    'The file is too large ({{ size }} {{ suffix }}). Allowed maximum size is {{ limit }} {{ suffix }}.' => ValidationErrorCodeEnum::ERR_FILE_TOO_LARGE->value,
    'The mime type of the file is invalid ({{ type }}). Allowed mime types are {{ types }}.' => ValidationErrorCodeEnum::ERR_MIME_TYPE_INVALID->value,
    'This value should be {{ limit }} or less.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_BE_LESS_THAN_OR_EQUAL_TO->value,
    'This value is too long. It should have {{ limit }} character or less.|This value is too long. It should have {{ limit }} characters or less.' => ValidationErrorCodeEnum::ERR_VALUE_TOO_LONG->value,
    'This value should be {{ limit }} or more.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_BE_GREATER_THAN_OR_EQUAL_TO->value,
    'This value is too short. It should have {{ limit }} character or more.|This value is too short. It should have {{ limit }} characters or more.' => ValidationErrorCodeEnum::ERR_VALUE_TOO_SHORT->value,
    'This value should not be blank.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_NOT_BE_BLANK->value,
    'This value should not be null.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_NOT_BE_NULL->value,
    'This value should be null.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_BE_NULL->value,
    'This value is not valid.' => ValidationErrorCodeEnum::ERR_VALUE_NOT_VALID->value,
    'This value is not a valid time.' => ValidationErrorCodeEnum::ERR_VALUE_NOT_VALID_TIME->value,
    'This value is not a valid URL.' => ValidationErrorCodeEnum::ERR_VALUE_NOT_VALID_URL->value,
    'The two values should be equal.' => ValidationErrorCodeEnum::ERR_TWO_VALUES_SHOULD_BE_EQUAL->value,
    'The file is too large. Allowed maximum size is {{ limit }} {{ suffix }}.' => ValidationErrorCodeEnum::ERR_FILE_TOO_LARGE->value,
    'The file is too large.' => ValidationErrorCodeEnum::ERR_FILE_TOO_LARGE->value,
    'The file could not be uploaded.' => ValidationErrorCodeEnum::ERR_FILE_COULD_NOT_BE_UPLOADED->value,
    'This value should be a valid number.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_BE_A_VALID_NUMBER->value,
    'This file is not a valid image.' => ValidationErrorCodeEnum::ERR_FILE_IS_NOT_A_VALID_IMAGE->value,
    'This is not a valid IP address.' => ValidationErrorCodeEnum::ERR_VALUE_IS_NOT_A_VALID_IP_ADDRESS->value,
    'This value is not a valid language.' => ValidationErrorCodeEnum::ERR_VALUE_IS_NOT_A_VALID_LANGUAGE->value,
    'This value is not a valid locale.' => ValidationErrorCodeEnum::ERR_VALUE_IS_NOT_A_VALID_LOCALE->value,
    'This value is not a valid country.' => ValidationErrorCodeEnum::ERR_VALUE_IS_NOT_A_VALID_COUNTRY->value,
    'This value is already used.' => ValidationErrorCodeEnum::ERR_RESOURCE_MUST_BE_UNIQUE->value,
    'The size of the image could not be detected.' => ValidationErrorCodeEnum::ERR_IMAGE_SIZE_COULD_NOT_BE_DETECTED->value,
    'The image width is too big ({{ width }}px). Allowed maximum width is {{ max_width }}px.' => ValidationErrorCodeEnum::ERR_IMAGE_WIDTH_TOO_BIG->value,
    'The image width is too small ({{ width }}px). Minimum width expected is {{ min_width }}px.' => ValidationErrorCodeEnum::ERR_IMAGE_WIDTH_TOO_SMALL->value,
    'The image height is too big ({{ height }}px). Allowed maximum height is {{ max_height }}px.' => ValidationErrorCodeEnum::ERR_IMAGE_HEIGHT_TOO_BIG->value,
    'The image height is too small ({{ height }}px). Minimum height expected is {{ min_height }}px.' => ValidationErrorCodeEnum::ERR_IMAGE_HEIGHT_TOO_SMALL->value,
    'This value should be the user\'s current password.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_BE_USER_CURRENT_PASSWORD->value,
    'This value should have exactly {{ limit }} character.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_HAVE_EXACTLY_N_CHARACTERS->value,
    'This value should have exactly {{ limit }} characters.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_HAVE_EXACTLY_N_CHARACTERS->value,
    'The file was only partially uploaded.' => ValidationErrorCodeEnum::ERR_FILE_WAS_ONLY_PARTIALLY_UPLOADED->value,
    'No file was uploaded.' => ValidationErrorCodeEnum::ERR_NO_FILE_WAS_UPLOADED->value,
    'No temporary folder was configured in php.ini.' => ValidationErrorCodeEnum::ERR_NO_TEMPORARY_FOLDER_CONFIGURED_IN_PHP_INI->value,
    'Cannot write temporary file to disk.' => ValidationErrorCodeEnum::ERR_CANNOT_WRITE_TEMPORARY_FILE_TO_DISK->value,
    'A PHP extension caused the upload to fail.' => ValidationErrorCodeEnum::ERR_PHP_EXTENSION_CAUSED_THE_UPLOAD_TO_FAIL->value,
    'This collection should contain {{ limit }} element or more.' => ValidationErrorCodeEnum::ERR_COLLECTION_SHOULD_CONTAIN_N_OR_MORE_ELEMENTS->value,
    'This collection should contain {{ limit }} elements or more.' => ValidationErrorCodeEnum::ERR_COLLECTION_SHOULD_CONTAIN_N_OR_MORE_ELEMENTS->value,
    'This collection should contain {{ limit }} element or less.' => ValidationErrorCodeEnum::ERR_COLLECTION_SHOULD_CONTAIN_N_OR_LESS_ELEMENTS->value,
    'This collection should contain {{ limit }} elements or less.' => ValidationErrorCodeEnum::ERR_COLLECTION_SHOULD_CONTAIN_N_OR_LESS_ELEMENTS->value,
    'This collection should contain exactly {{ limit }} element.' => ValidationErrorCodeEnum::ERR_COLLECTION_SHOULD_CONTAIN_EXACTLY_N_ELEMENTS->value,
    'This collection should contain exactly {{ limit }} elements.' => ValidationErrorCodeEnum::ERR_COLLECTION_SHOULD_CONTAIN_EXACTLY_N_ELEMENTS->value,
    'Invalid card number.' => ValidationErrorCodeEnum::ERR_INVALID_CARD_NUMBER->value,
    'Unsupported card type or invalid card number.' => ValidationErrorCodeEnum::ERR_UNSUPPORTED_CARD_TYPE_OR_INVALID_CARD_NUMBER->value,
    'This is not a valid International Bank Account Number (IBAN).' => ValidationErrorCodeEnum::ERR_VALUE_IS_NOT_A_VALID_IBAN->value,
    'This value is not a valid ISBN-10.' => ValidationErrorCodeEnum::ERR_VALUE_IS_NOT_A_VALID_ISBN_10->value,
    'This value is not a valid ISBN-13.' => ValidationErrorCodeEnum::ERR_VALUE_IS_NOT_A_VALID_ISBN_13->value,
    'This value is neither a valid ISBN-10 nor a valid ISBN-13.' => ValidationErrorCodeEnum::ERR_VALUE_IS_NEITHER_A_VALID_ISBN_10_NOR_A_VALID_ISBN_13->value,
    'This value is not a valid ISSN.' => ValidationErrorCodeEnum::ERR_VALUE_IS_NOT_A_VALID_ISSN->value,
    'This value is not a valid currency.' => ValidationErrorCodeEnum::ERR_VALUE_IS_NOT_A_VALID_CURRENCY->value,
    'This value should be equal to {{ compared_value }}.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_BE_EQUAL_TO->value,
    'This value should be greater than {{ compared_value }}.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_BE_GREATER_THAN->value,
    'This value should be greater than or equal to {{ compared_value }}.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_BE_GREATER_THAN_OR_EQUAL_TO->value,
    'This value should be identical to {{ compared_value_type }} {{ compared_value }}.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_BE_IDENTICAL_TO->value,
    'This value should be less than {{ compared_value }}.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_BE_LESS_THAN->value,
    'This value should be less than or equal to {{ compared_value }}.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_BE_LESS_THAN_OR_EQUAL_TO->value,
    'This value should not be equal to {{ compared_value }}.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_NOT_BE_EQUAL_TO->value,
    'This value should not be identical to {{ compared_value_type }} {{ compared_value }}.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_NOT_BE_IDENTICAL_TO->value,
    'The image ratio is too big ({{ ratio }}). Allowed maximum ratio is {{ max_ratio }}.' => ValidationErrorCodeEnum::ERR_IMAGE_RATIO_TOO_BIG->value,
    'The image ratio is too small ({{ ratio }}). Minimum ratio expected is {{ min_ratio }}.' => ValidationErrorCodeEnum::ERR_IMAGE_RATIO_TOO_SMALL->value,
    'The image is square ({{ width }}x{{ height }}px). Square images are not allowed.' => ValidationErrorCodeEnum::ERR_IMAGE_IS_SQUARE->value,
    'The image is landscape oriented ({{ width }}x{{ height }}px). Landscape oriented images are not allowed.' => ValidationErrorCodeEnum::ERR_IMAGE_IS_LANDSCAPE->value,
    'The image is portrait oriented ({{ width }}x{{ height }}px). Portrait oriented images are not allowed.' => ValidationErrorCodeEnum::ERR_IMAGE_IS_PORTRAIT->value,
    'An empty file is not allowed.' => ValidationErrorCodeEnum::ERR_EMPTY_FILE_NOT_ALLOWED->value,
    'The host could not be resolved.' => ValidationErrorCodeEnum::ERR_HOST_COULD_NOT_BE_RESOLVED->value,
    'This value does not match the expected {{ charset }} charset.' => ValidationErrorCodeEnum::ERR_VALUE_DOES_NOT_MATCH_THE_EXPECTED_CHARSET->value,
    'This is not a valid Business Identifier Code (BIC).' => ValidationErrorCodeEnum::ERR_VALUE_IS_NOT_A_VALID_BIC->value,
    'Error' => ValidationErrorCodeEnum::ERR_ERROR->value,
    'This is not a valid UUID.' => ValidationErrorCodeEnum::ERR_VALUE_IS_NOT_A_VALID_UUID->value,
    'This value should be a multiple of {{ compared_value }}.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_BE_A_MULTIPLE_OF->value,
    'This Business Identifier Code (BIC) is not associated with IBAN {{ iban }}.' => ValidationErrorCodeEnum::ERR_BIC_NOT_ASSOCIATED_WITH_IBAN->value,
    'This value should be valid JSON.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_BE_VALID_JSON->value,
    'This collection should contain only unique elements.' => ValidationErrorCodeEnum::ERR_COLLECTION_SHOULD_CONTAIN_ONLY_UNIQUE_ELEMENTS->value,
    'This value should be positive.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_BE_POSITIVE->value,
    'This value should be either positive or zero.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_BE_EITHER_POSITIVE_OR_ZERO->value,
    'This value should be negative.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_BE_NEGATIVE->value,
    'This value should be either negative or zero.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_BE_EITHER_NEGATIVE_OR_ZERO->value,
    'This value is not a valid timezone.' => ValidationErrorCodeEnum::ERR_VALUE_IS_NOT_A_VALID_TIMEZONE->value,
    'This password has been leaked in a data breach, it must not be used. Please use another password.' => ValidationErrorCodeEnum::ERR_PASSWORD_LEAKED->value,
    'This value should be between {{ min }} and {{ max }}.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_BE_BETWEEN->value,
    'This value is not a valid hostname.' => ValidationErrorCodeEnum::ERR_VALUE_IS_NOT_A_VALID_HOSTNAME->value,
    'The number of elements in this collection should be a multiple of {{ compared_value }}.' => ValidationErrorCodeEnum::ERR_NUMBER_OF_ELEMENTS_SHOULD_BE_A_MULTIPLE_OF->value,
    'This value should satisfy at least one of the following constraints:' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_SATISFY_AT_LEAST_ONE_OF_THE_FOLLOWING_CONSTRAINTS->value,
    'Each element of this collection should satisfy its own set of constraints.' => ValidationErrorCodeEnum::ERR_EACH_ELEMENT_OF_THIS_COLLECTION_SHOULD_SATISFY_ITS_OWN_SET_OF_CONSTRAINTS->value,
    'This value is not a valid International Securities Identification Number (ISIN).' => ValidationErrorCodeEnum::ERR_VALUE_IS_NOT_A_VALID_ISIN->value,
    'This value should be a valid expression.' => ValidationErrorCodeEnum::ERR_VALUE_SHOULD_BE_A_VALID_EXPRESSION->value,
    'This value is not a valid CSS color.' => ValidationErrorCodeEnum::ERR_VALUE_IS_NOT_A_VALID_CSS_COLOR->value,
    'This value is not a valid CIDR notation.' => ValidationErrorCodeEnum::ERR_VALUE_IS_NOT_A_VALID_CIDR->value,
    'The value of the netmask should be between {{ min }} and {{ max }}.' => ValidationErrorCodeEnum::ERR_VALUE_OF_THE_NETMASK_SHOULD_BE_BETWEEN->value,
    'The filename is too long. It should have {{ filename_max_length }} character or less.' => ValidationErrorCodeEnum::ERR_FILENAME_IS_TOO_LONG->value,
    'The filename is too long. It should have {{ filename_max_length }} characters or less.' => ValidationErrorCodeEnum::ERR_FILENAME_IS_TOO_LONG->value,
    'The password strength is too low. Please use a stronger password.' => ValidationErrorCodeEnum::ERR_PASSWORD_STRENGTH_TOO_LOW->value,
    'This value contains characters that are not allowed by the current restriction-level.' => ValidationErrorCodeEnum::ERR_VALUE_CONTAINS_CHARACTERS_THAT_ARE_NOT_ALLOWED_BY_THE_CURRENT_RESTRICTION_LEVEL->value,
    'Using invisible characters is not allowed.' => ValidationErrorCodeEnum::ERR_USING_INVISIBLE_CHARACTERS_IS_NOT_ALLOWED->value,
    'Mixing numbers from different scripts is not allowed.' => ValidationErrorCodeEnum::ERR_MIXING_NUMBERS_FROM_DIFFERENT_SCRIPTS_IS_NOT_ALLOWED->value,
    'Using hidden overlay characters is not allowed.' => ValidationErrorCodeEnum::ERR_USING_HIDDEN_OVERLAY_CHARACTERS_IS_NOT_ALLOWED->value,
);
