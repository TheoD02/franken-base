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
 * The publication format of the book.
 *
 * @see https://schema.org/BookFormatType
 */
class BookFormatType extends Enum
{
	/** @var string Book format: Paperback. */
	public const PAPERBACK = 'https://schema.org/Paperback';

	/** @var string Book format: GraphicNovel. May represent a bound collection of ComicIssue instances. */
	public const GRAPHIC_NOVEL = 'https://schema.org/GraphicNovel';

	/** @var string Book format: Ebook. */
	public const E_BOOK = 'https://schema.org/EBook';

	/** @var string Book format: Audiobook. This is an enumerated value for use with the bookFormat property. There is also a type 'Audiobook' in the bib extension which includes Audiobook specific properties. */
	public const AUDIOBOOK_FORMAT = 'https://schema.org/AudiobookFormat';

	/** @var string Book format: Hardcover. */
	public const HARDCOVER = 'https://schema.org/Hardcover';
}
