<?php

namespace FluxEco\DockerManager\Adapters;

enum ConfigurationKeyword: string
{
    case PROJECTS = 'projects';
    case SOURCE_FILES = 'source-files';
    case APP_TARGET_SUB_PATH = 'appTargetSubPath';
    case SOURCE = 'source';
    case CONFIGURATION_FILE_NAME = 'configuration.yaml';
    case APP_DIRECTORY_PATH = 'appDirectoryPath';
    case COMPOSE_FILE_PATH_PATH = 'composeFilePath';
    case CONTAINER_URLS = 'container-urls';
    case NAME = 'name';
    case SCHEDULED_DEPLOYMENTS = 'scheduledDeployments';
}