<?php

namespace FluxEco\DockerManager\Core\Domain\Models;

class SourceFilesLocation
{
    private function __construct(
        public string $sourcePath,
        public string $targetPath,
        public SourceFileSourcePathType $sourceFileSourcePathType
    ) {

    }

    public static function new(
        string $sourcePath,
        string $targetPath,
        SourceFileSourcePathType $sourceFileSourcePathType
    ) : self {
        return new self(...get_defined_vars());
    }
}