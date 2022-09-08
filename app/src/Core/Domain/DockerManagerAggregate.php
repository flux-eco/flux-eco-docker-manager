<?php

namespace FluxEco\DockerManager\Core\Domain;
use FluxEco\DockerManager\Core\Domain\Models;

class DockerManagerAggregate
{
    /** @var Models\DockerProject[] */
    public array $dockerProjects = [];

    private function __construct()
    {

    }

    /** @param Models\DockerProject[] $projects */
    public static function fromProjects(array $projects) : self
    {
        $new = new self();
        foreach ($projects as $project) {
            $new->appendDockerProject($project->projectId, $project);
        }
        return $new;
    }

    public function appendDockerProject(string $projectId, Models\DockerProject $dockerProject) : void
    {
        if (key_exists($projectId, $this->dockerProjects)) {
            return;
        }

        $this->applyAppendDockerProject($projectId, $dockerProject);
    }

    private function applyAppendDockerProject(string $projectName, Models\DockerProject $dockerProject) : void
    {
        $this->dockerProjects[$projectName] = $dockerProject;
    }
}