<?php

declare(strict_types=1);

namespace Component\Resource\Metadata;

interface MetadataInterface
{
    /**
     * @return string
     */
    public function getAlias(): string;

    /**
     * @return string
     */
    public function getApplicationName(): string;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getHumanizedName(): string;

    /**
     * @return string
     */
    public function getPluralName(): string;

    /**
     * @return string
     */
    public function getDriver(): string;

    /**
     * @return ?string
     */
    public function getTemplatesNamespace();

    /**
     * @param string $name
     *
     * @return string|array
     *
     * @throws \InvalidArgumentException
     */
    public function getParameter(string $name);

    /**
     * Return all the metadata parameters.
     *
     * @return array
     */
    public function getParameters(): array;

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasParameter(string $name): bool;

    /**
     * @param string $name
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function getClass(string $name): string;

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasClass(string $name): bool;

    /**
     * @param string $serviceName
     *
     * @return string
     */
    public function getServiceId(string $serviceName): string;

    /**
     * @param string $permissionName
     *
     * @return string
     */
    public function getPermissionCode(string $permissionName): string;
}
