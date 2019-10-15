<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bundle\ThemeBundle\Tests\DependencyInjection\FilesystemSource;

use Matthias\SymfonyConfigTest\PhpUnit\ConfigurationTestCaseTrait;
use Bundle\ThemeBundle\Configuration\Filesystem\FilesystemConfigurationSourceFactory;
use Bundle\ThemeBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    use ConfigurationTestCaseTrait;

    /**
     * @test
     */
    public function it_uses_app_themes_filesystem_as_the_default_source(): void
    {
        $this->assertProcessedConfigurationEquals(
            [
                ['sources' => ['filesystem' => null]],
            ],
            ['sources' => ['filesystem' => [
                'directories' => ['%kernel.root_dir%/themes'],
                'filename' => 'composer.json',
                'enabled' => true,
            ]]],
            'sources'
        );
    }

    /**
     * @test
     */
    public function it_does_not_add_default_theme_directories_if_there_are_some_defined_by_user(): void
    {
        $this->assertProcessedConfigurationEquals(
            [
                ['sources' => ['filesystem' => ['directories' => ['/custom/path', '/custom/path2']]]],
            ],
            ['sources' => ['filesystem' => [
                'directories' => ['/custom/path', '/custom/path2'],
                'filename' => 'composer.json',
                'enabled' => true,
            ]]],
            'sources.filesystem'
        );
    }

    /**
     * @test
     */
    public function it_uses_the_last_theme_directories_passed_and_rejects_the_other_ones(): void
    {
        $this->assertProcessedConfigurationEquals(
            [
                ['sources' => ['filesystem' => ['directories' => ['/custom/path', '/custom/path2']]]],
                ['sources' => ['filesystem' => ['directories' => ['/last/custom/path']]]],
            ],
            ['sources' => ['filesystem' => [
                'directories' => ['/last/custom/path'],
                'filename' => 'composer.json',
                'enabled' => true,
            ]]],
            'sources.filesystem'
        );
    }

    /**
     * @test
     */
    public function it_is_invalid_to_pass_a_string_as_theme_directories(): void
    {
        $this->assertPartialConfigurationIsInvalid(
            [
                ['directories' => '/string/not/array'],
            ],
            'sources.filesystem'
        );
    }

    /**
     * @test
     */
    public function it_throws_an_error_if_trying_to_set_theme_directories_to_an_empty_array(): void
    {
        $this->assertPartialConfigurationIsInvalid(
            [
                ['directories' => []],
            ],
            'sources.filesystem'
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getConfiguration(): ConfigurationInterface
    {
        return new Configuration([
            new FilesystemConfigurationSourceFactory(),
        ]);
    }
}
