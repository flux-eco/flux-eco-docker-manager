<?php

namespace FluxEco\DockerManager\Core\Domain\Models;

enum SourceFileSourcePathType: string
{
    case GZ_URL = 'gz';

    public static function fromPath(string $path) : self
    {
        return match (self::GZ_URL->value) {
            pathinfo($path, PATHINFO_EXTENSION) => self::GZ_URL
        };
    }
}