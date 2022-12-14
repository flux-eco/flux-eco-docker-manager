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
            $project = Models\DockerProject::new($projectId, $projectConfiguration[ConfigurationKeyword::NAME->value], (object) array_map(fn(array $scheduledDeployment) : object => (object) $scheduledDeployment, $projectConfiguration[ConfigurationKeyword::SCHEDULED_DEPLOYMENTS->value]));
            foreach ($projectConfiguration as $composeName => $composeConfiguration) {
                if (in_array($composeName, [ConfigurationKeyword::NAME->value, ConfigurationKeyword::SCHEDULED_DEPLOYMENTS->value])) {
                    continue;
                }
                foreach ($composeConfiguration[ConfigurationKeyword::SOURCE_FILES->value] as $locationId => $locationConfiguration) {
                    $project->appendSourceFileLocation($locationId,
                        Models\SourceFilesLocation::new(
                            $locationConfiguration[ConfigurationKeyword::SOURCE->value],
                            $composeConfiguration[ConfigurationKeyword::APP_DIRECTORY_PATH->value] . '' . $locationConfiguration[ConfigurationKeyword::APP_TARGET_SUB_PATH->value],
                            Models\SourceFileSourcePathType::fromPath($locationConfiguration[ConfigurationKeyword::SOURCE->value]),
                            $composeConfiguration[ConfigurationKeyword::COMPOSE_FILE_PATH_PATH->value],
                            (object) ($composeConfiguration[ConfigurationKeyword::CONTAINER_URLS->value] ?? [])
                        )
                    );
                }
            }
            $projects[] = $project;
        }
        return $projects;
    }
}