<?php

namespace FluxEco\DockerManager\Core\Domain\Models;

class DockerProject
{
    private array $sourceFilesLocations;

    private function __construct(
        public readonly string $projectId
    ) {

    }

    public static function new(
        string $projectId
    ) : self {
        return new self(...get_defined_vars());
    }

    public function appendSourceFileLocation(string $locationId, SourceFilesLocation $sourceFilesLocation)
    {
        $this->sourceFilesLocations[$locationId] = $sourceFilesLocation;
    }

    /**
     * @return SourceFilesLocation[]
     */
    public function getSourceFileLocations() : array
    {
        return $this->sourceFilesLocations;
    }
}