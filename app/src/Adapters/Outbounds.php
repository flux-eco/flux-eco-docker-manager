<?php

namespace FluxEco\DockerManager\Adapters;

use FluxEco\DockerManager\Core;
use FluxEco\DockerManager\Core\Domain\Models;

class Outbounds implements Core\Ports\Outbounds
{

    private function __construct(
        public Configs $configs
    ) {

    }

    public static function new(Configs $configs) : self
    {
        return new self($configs);
    }

    /** @return Models\DockerProject[] */
    public function getDockerProjects() : array
    {
        $projects = [];
        foreach ($this->configs->projects as $projectId => $projectConfiguration) {
            $project = Models\DockerProject::new($projectId);
            foreach ($projectConfiguration[ConfigurationKeyword::SOURCE_FILES->value] as $locationId => $locationConfiguration) {
                $project->appendSourceFileLocation($locationId,
                    Models\SourceFilesLocation::new(
                        $locationConfiguration[ConfigurationKeyword::SOURCE->value],
                        $projectConfiguration[ConfigurationKeyword::APP_DIRECTORY_PATH->value] . '' . $locationConfiguration[ConfigurationKeyword::APP_TARGET_SUB_PATH->value],
                        Models\SourceFileSourcePathType::fromPath($locationConfiguration[ConfigurationKeyword::SOURCE->value])
                    )
                );
            }
            $projects[] = $project;
        }
        return $projects;
    }
}