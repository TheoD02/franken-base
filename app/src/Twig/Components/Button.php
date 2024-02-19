<?php

namespace App\Twig\Components;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use Symfony\UX\TwigComponent\Attribute\PreMount;

use function array_keys;
use function dd;
use function self;

#[AsTwigComponent]
final class Button
{
    private const VARIANTS = [
        'primary' => 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800',
        'secondary' => 'py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700',
        'danger' => 'focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900',
    ];

    public string $variant = 'primary';

    public string $text;

    public string $class;

    public string $as = 'button';

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults([
            'variant' => 'primary',
            'text' => 'Click me',
            'as' => 'button',
            'href' => null,
            'type' => 'null',
        ]);

        $resolver->setRequired(['text', 'variant']);

        // Text
        $resolver->setAllowedTypes('text', 'string');

        // Variant
        $resolver->setAllowedValues('variant', array_keys(self::VARIANTS));

        // As
        $resolver->setAllowedValues('as', ['button', 'a']);

        // Href
        $resolver->setAllowedTypes('href', ['null', 'string']);

        $resolved = $resolver->resolve($data);

        if ($resolved['href'] === null) {
            unset($resolved['href']);
        }

        return $resolved;
    }

    #[PostMount]
    public function postMount(): void
    {
        $this->class = self::VARIANTS[$this->variant];
    }
}
