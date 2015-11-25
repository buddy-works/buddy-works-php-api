#!/usr/bin/env bash

vendor/bin/phpcs src --standard=psr2 -spn
vendor/bin/phpunit --coverage-text


