<?php

namespace FluxEco\DockerManager\Core\Ports;

use FluxEco\DockerManager\Core\Domain\Models;

interface Outbounds
{
    /** @return Models\DockerProject[] */
    public function getDockerProjects() : array;
}