<?php

namespace App\Enum;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use MyCLabs\Enum\Enum;

/**
 * Codes for use with the \[\[mediaAuthenticityCategory\]\] property, indicating the authenticity of a media object (in the context of how it was published or shared). In general these codes are not mutually exclusive, although some combinations (such as 'original' versus 'transformed', 'edited' and 'staged') would be contradictory if applied in the same \[\[MediaReview\]\]. Note that the application of these codes is with regard to a piece of media shared or published in a particular context.
 *
 * @see https://schema.org/MediaManipulationRatingEnumeration
 */
class MediaManipulationRatingEnumeration extends Enum
{
	/** @var string Content coded 'edited or cropped content' in a \[\[MediaReview\]\], considered in the context of how it was published or shared. For a \[\[VideoObject\]\] to be 'edited or cropped content': The video has been edited or rearranged. This category applies to time edits, including editing multiple videos together to alter the story being told or editing out large portions from a video. For an \[\[ImageObject\]\] to be 'edited or cropped content': Presenting a part of an image from a larger whole to mislead the viewer. For an \[\[ImageObject\]\] with embedded text to be 'edited or cropped content': Presenting a part of an image from a larger whole to mislead the viewer. For an \[\[AudioObject\]\] to be 'edited or cropped content': The audio has been edited or rearranged. This category applies to time edits, including editing multiple audio clips together to alter the story being told or editing out large portions from the recording. */
	public const EDITED_OR_CROPPED_CONTENT = 'https://schema.org/EditedOrCroppedContent';

	/** @var string Content coded 'missing context' in a \[\[MediaReview\]\], considered in the context of how it was published or shared. For a \[\[VideoObject\]\] to be 'missing context': Presenting unaltered video in an inaccurate manner that misrepresents the footage. For example, using incorrect dates or locations, altering the transcript or sharing brief clips from a longer video to mislead viewers. (A video rated 'original' can also be missing context.) For an \[\[ImageObject\]\] to be 'missing context': Presenting unaltered images in an inaccurate manner to misrepresent the image and mislead the viewer. For example, a common tactic is using an unaltered image but saying it came from a different time or place. (An image rated 'original' can also be missing context.) For an \[\[ImageObject\]\] with embedded text to be 'missing context': An unaltered image presented in an inaccurate manner to misrepresent the image and mislead the viewer. For example, a common tactic is using an unaltered image but saying it came from a different time or place. (An 'original' image with inaccurate text would generally fall in this category.) For an \[\[AudioObject\]\] to be 'missing context': Unaltered audio presented in an inaccurate manner that misrepresents it. For example, using incorrect dates or locations, or sharing brief clips from a longer recording to mislead viewers. (Audio rated “original” can also be missing context.) */
	public const DECONTEXTUALIZED_CONTENT = 'https://schema.org/DecontextualizedContent';

	/** @var string Content coded 'transformed content' in a \[\[MediaReview\]\], considered in the context of how it was published or shared. For a \[\[VideoObject\]\] to be 'transformed content': or all of the video has been manipulated to transform the footage itself. This category includes using tools like the Adobe Suite to change the speed of the video, add or remove visual elements or dub audio. Deepfakes are also a subset of transformation. For an \[\[ImageObject\]\] to be 'transformed content': Adding or deleting visual elements to give the image a different meaning with the intention to mislead. For an \[\[ImageObject\]\] with embedded text to be 'transformed content': Adding or deleting visual elements to give the image a different meaning with the intention to mislead. For an \[\[AudioObject\]\] to be 'transformed content': Part or all of the audio has been manipulated to alter the words or sounds, or the audio has been synthetically generated, such as to create a sound-alike voice. */
	public const TRANSFORMED_CONTENT = 'https://schema.org/TransformedContent';

	/** @var string Content coded 'as original media content' in a \[\[MediaReview\]\], considered in the context of how it was published or shared. For a \[\[VideoObject\]\] to be 'original': No evidence the footage has been misleadingly altered or manipulated, though it may contain false or misleading claims. For an \[\[ImageObject\]\] to be 'original': No evidence the image has been misleadingly altered or manipulated, though it may still contain false or misleading claims. For an \[\[ImageObject\]\] with embedded text to be 'original': No evidence the image has been misleadingly altered or manipulated, though it may still contain false or misleading claims. For an \[\[AudioObject\]\] to be 'original': No evidence the audio has been misleadingly altered or manipulated, though it may contain false or misleading claims. */
	public const ORIGINAL_MEDIA_CONTENT = 'https://schema.org/OriginalMediaContent';

	/** @var string Content coded 'staged content' in a \[\[MediaReview\]\], considered in the context of how it was published or shared. For a \[\[VideoObject\]\] to be 'staged content': A video that has been created using actors or similarly contrived. For an \[\[ImageObject\]\] to be 'staged content': An image that was created using actors or similarly contrived, such as a screenshot of a fake tweet. For an \[\[ImageObject\]\] with embedded text to be 'staged content': An image that was created using actors or similarly contrived, such as a screenshot of a fake tweet. For an \[\[AudioObject\]\] to be 'staged content': Audio that has been created using actors or similarly contrived. */
	public const STAGED_CONTENT = 'https://schema.org/StagedContent';

	/** @var string Content coded 'satire or parody content' in a \[\[MediaReview\]\], considered in the context of how it was published or shared. For a \[\[VideoObject\]\] to be 'satire or parody content': A video that was created as political or humorous commentary and is presented in that context. (Reshares of satire/parody content that do not include relevant context are more likely to fall under the “missing context” rating.) For an \[\[ImageObject\]\] to be 'satire or parody content': An image that was created as political or humorous commentary and is presented in that context. (Reshares of satire/parody content that do not include relevant context are more likely to fall under the “missing context” rating.) For an \[\[ImageObject\]\] with embedded text to be 'satire or parody content': An image that was created as political or humorous commentary and is presented in that context. (Reshares of satire/parody content that do not include relevant context are more likely to fall under the “missing context” rating.) For an \[\[AudioObject\]\] to be 'satire or parody content': Audio that was created as political or humorous commentary and is presented in that context. (Reshares of satire/parody content that do not include relevant context are more likely to fall under the “missing context” rating.) */
	public const SATIRE_OR_PARODY_CONTENT = 'https://schema.org/SatireOrParodyContent';
}
