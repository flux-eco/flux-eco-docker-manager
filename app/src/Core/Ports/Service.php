<?php

namespace FluxEco\DockerManager\Core\Ports;

use  FluxEco\DockerManager\Core\Domain;

class Service
{
    private function __construct(private Outbounds $outbounds)
    {

    }

    public static function new(Outbounds $outbounds) : self
    {
        return new self($outbounds);
    }

    public function provideApplicationSourceFiles() : void
    {
        $projects = $this->outbounds->getDockerProjects();

        $dockerManagerAggregate = Domain\DockerManagerAggregate::fromProjects($projects);
        foreach ($dockerManagerAggregate->dockerProjects as $project) {
            $this->downloadAndProvideSourceFiles($project->getSourceFileLocations());
        }
    }

    /** @param Domain\Models\SourceFilesLocation[] $sourceFileLocations */
    private function downloadAndProvideSourceFiles(array $sourceFileLocations) : void
    {
        foreach ($sourceFileLocations as $sourceFileLocation) {
            if (file_exists($sourceFileLocation->targetPath) == false) {
                mkdir($sourceFileLocation->targetPath, 0777, true);
            }

            echo $sourceFileLocation->targetPath;
            switch ($sourceFileLocation->sourceFileSourcePathType) {
                case Domain\Models\SourceFileSourcePathType::GZ_URL:
                    echo exec('curl -SL '.escapeshellarg($sourceFileLocation->sourcePath).' | tar -xz --strip-components=1 -C ' .escapeshellarg($sourceFileLocation->targetPath));
                    break;
                default:
                    throw new \Exception('unknown source location type: ' . $sourceFileLocation->sourceFileSourcePathType->value);
                    break;
            }
        }
    }
}