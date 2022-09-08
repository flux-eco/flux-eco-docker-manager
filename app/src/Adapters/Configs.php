<?php

namespace FluxEco\DockerManager\Adapters;

class Configs
{
    private function __construct(
        public array $projects
    ) {

    }

    public static function new(string $configurationDirectory) : self
    {
        $configuration = yaml_parse(file_get_contents($configurationDirectory . '/' . ConfigurationKeyword::CONFIGURATION_FILE_NAME->value));
        $projectRefs = $configuration[ConfigurationKeyword::PROJECTS->value];

        foreach ($projectRefs as $projectId => $projectRef) {
            $projects[$projectId] = yaml_parse(file_get_contents($configurationDirectory . '/' . $projectRef['$ref']));
        }

        return new self($projects);
    }

}