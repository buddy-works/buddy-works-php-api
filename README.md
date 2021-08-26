# Buddy Works APIs PHP SDK

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%208.0-8892BF.svg)](https://php.net/)
[![buddy branch](https://app.buddy.works/buddy-works/buddy-works-php-api/repository/branch/master/badge.svg?token=be04e77cb21d0e7e611853e903e521ba233e01d46699a1e6dc00f85a853cbdd6 "buddy branch")](https://app.buddy.works/buddy-works/buddy-works-php-api/repository/branch/master)
[![Latest Stable Version](https://poser.pugx.org/buddy-works/buddy-works-php-api/v/stable?format=flat)](https://packagist.org/packages/buddy-works/buddy-works-php-api)
![GitHub](https://img.shields.io/github/license/buddy-works/buddy-works-php-api)

Official PHP client library for [Buddy Build Server with CI](https://buddy.works).

## Installation

This library is distributed on `packagist` and is working with `composer`. In order to add it as a dependency, run the following command:

``` sh
composer require buddy-works/buddy-works-php-api
```

### Compatibility

| PHP version | SDK version |
| --------------- | ---------------------- |
| ^8.0 | 1.4 |
| ^7.3 | 1.3 |
| ^7.2 | 1.2 |
| 5.5  | 1.1 |
 
## Usage of OAUTH

First you need to add application in your [Buddy ID](https://app.buddy.works/my-apps).

You will then obtain clientId & clientSecret to execute this code:

```php
$buddy = new Buddy\Buddy([
  'clientId' => 'your-client-id',
  'clientSecret' => 'your-client-secret'
]);
try {
  $url = $buddy->getOAuth()->getAuthorizeUrl([
    Buddy\BuddyOAuth::SCOPE_MANAGE_EMAILS
  ], 'state', 'redirectUrl');  
} catch(Buddy\Exceptions\BuddySDKException $e) {
  echo 'Buddy SDK return an error: ' . $e->getMessage();
  exit;
}
```

`scopes` are arrays of strings - [help](https://buddy.works/api/reference/getting-started/oauth#supported-scopes)

`state` should be an unguessable random string. It is used to protect against cross-site request forgery attacks.

`redirectUrl` is optional [more](https://buddy.works/api/reference/getting-started/oauth#web-application-flow)

You should redirect the user to the created URL. Upon authorization, the user should get back to your page (configured in application or passed to the method)

`query params` will get you the code & state. State should be the same as you passed before. Code is used in next step to exchange for access token:

```php
$buddy = new Buddy\Buddy([
  'clientId' => 'your-client-id',
  'clientSecret' => 'your-client-secret'
]);
try {
  $auth = $buddy->getOAuth()->getAccessToken('state');
} catch(Buddy\Exceptions\BuddyResponseException $e) {
  echo 'Buddy API return an error: ' . $e->getMessage();
  exit;
} catch(Buddy\Exceptions\BuddySDKException $e) {
  echo 'Buddy SDK return an error: ' . $e->getMessage();
  exit;
}
var_dump($auth);
```

State should be the same as in getAuthorizeUrl method. 

## Usage of direct tokens

You can also use [API Tokens](https://app.buddy.works/api-tokens).

That functionality is provided for testing purposes and will only work for individual tokens generated per user.

All requests will be called on behalf of the user who provided token.

## API's

For detailed info what send for which method, error codes, rates & limits - check [Buddy documentation](https://buddy.works/api/reference/getting-started/overview)

To start using api you should pass to Buddy constructor acquired access token.

```php
$buddy = new Buddy\Buddy([
  'accessToken' => 'your access token'
]);
```
 
### Workspaces

Get workspaces
```php
try {
    $resp = $buddy->getApiWorkspaces()->getWorkspaces([$accessToken]);
    var_dump($resp);
    exit;
} catch (Buddy\Exceptions\BuddyResponseException $e) {
    echo $e->getMessage();
    exit;
} catch (Buddy\Exceptions\BuddySDKException $e) {
    echo $e->getMessage();
    exit;
}
```

Get workspace
```php
    $buddy->getApiWorkspaces()->getWorkspace($domain, [$accessToken]);
```

### Webhooks

Get webhooks
```php
    $buddy->getApiWebhooks()->getWebhooks($domain, [$accessToken]);
```

Add webhook
```php
    $buddy->getApiWebhooks()->addWebhook($data, $domain, [$accessToken]);
```

Get webhook
```php
    $buddy->getApiWebhooks()->getWebhook($domain, $webhookId, [$accessToken]);
```

Edit webhook
```php
    $buddy->getApiWebhooks()->editWebhook($data, $domain, $webhookId, [$accessToken]);
```

Delete webhook
```php
    $buddy->getApiWebhooks()->deleteWebhook($domain, $webhookId, [$accessToken]);
```

### Tags

Get tags
```php
    $buddy->getApiTags()->getTags($domain, $projectName, [$accessToken]);
```

Get tag
```php
    $buddy->getApiTags()->getTag($domain, $projectName, $name, [$accessToken]);
```

### Ssh Keys

Get keys
```php
    $buddy->getApiSshKeys()->getKeys([$accessToken]);
```

Add key
```php
    $buddy->getApiSshKeys()->addKey($data, [$accessToken]);
```

Delete key
```php
    $buddy->getApiSshKeys()->deleteKey($keyId, [$accessToken]);
```

Get key
```php
    $buddy->getApiSshKeys()->getKey($keyId, [$accessToken]);
```

### Source

Get contents
```php
    $buddy->getApiSource()->getContents($domain, $projectName, [$path], [$filters], [$accessToken]);
```

Add file
```php
    $buddy->getApiSource()->addFile($data, $domain, $projectName, [$accessToken]);
```

Edit file
```php
    $buddy->getApiSource()->editFile($data, $domain, $projectName, $path, [$accessToken]);
```

Delete file
```php
    $buddy->getApiSource()->deleteFile($data, $domain, $projectName, $path, [$accessToken]);
```

### Projects

Get projects
```php
    $buddy->getApiProjects()->getProjects($domain, [$filters], [$accessToken]);
```

Add project
```php
    $buddy->getApiProjects()->addProject($data, $domain, [$accessToken]);
```

Get projects
```php
    $buddy->getApiProjects()->getProject($domain, $projectName, [$accessToken]);
```

Edit project
```php
    $buddy->getApiProjects()->editProject($data, $domain, $projectName, [$accessToken]);
```

Delete project
```php
    $buddy->getApiProjects()->deleteProject($domain, $projectName, [$accessToken]);
```

Get project members
```php
    $buddy->getApiProjects()->getProjectMembers($domain, $projectName, [$filters], [$accessToken]);
```

Add project member
```php
    $buddy->getApiProjects()->addProjectMember($domain, $projectName, $userId, $permissionId, [$accessToken]);
```

Get project member
```php
    $buddy->getApiProjects()->getProjectMember($domain, $projectName, $userId, [$accessToken]);
```

Edit project member
```php
    $buddy->getApiProjects()->editProjectMember($domain, $projectName, $userId, $permissionId, [$accessToken]);
```

Delete project member
```php
    $buddy->getApiProjects()->deleteProjectMember($domain, $projectName, $userId, [$accessToken]);
```

### Profile

Get user
```php
    $buddy->getApiProfile()->getAuthenticatedUser([$accessToken]);
```

Edit user
```php
    $buddy->getApiProfile()->editAuthenticatedUser($data, [$accessToken]);
```

### Pipelines

Get pipelines
```php
    $buddy->getApiPipelines()->getPipelines($domain, $projectName, [$filters], [$accessToken]);
```

Add pipeline
```php
    $buddy->getApiPipelines()->addPipeline($data, $domain, $projectName, [$accessToken]);
```

Get pipeline
```php
    $buddy->getApiPipelines()->getPipeline($domain, $projectName, $pipelineId, [$accessToken]);
```

Edit pipeline
```php
    $buddy->getApiPipelines()->editPipeline($data, $domain, $projectName, $pipelineId, [$accessToken]);
```

Delete pipeline
```php
    $buddy->getApiPipelines()->deletePipeline($domain, $projectName, $pipelineId, [$accessToken]);
```

Get pipeline actions
```php
    $buddy->getApiPipelines()->getPipelineActions($domain, $projectName, $pipelineId, [$accessToken]);
```

Add pipeline action
```php
    $buddy->getApiPipelines()->addPipelineAction($data, $domain, $projectName, $pipelineId, [$accessToken]);
```

Get pipeline action
```php
    $buddy->getApiPipelines()->getPipelineAction($domain, $projectName, $pipelineId, $actionId, [$accessToken]);
```

Edit pipeline action
```php
    $buddy->getApiPipelines()->editPipelineAction($data, $domain, $projectName, $pipelineId, $actionId, [$accessToken]);
```

Delete pipeline action
```php
    $buddy->getApiPipelines()->deletePipelineAction($domain, $projectName, $pipelineId, $actionId, [$accessToken]);
```

### Permissions

Get permissions
```php
    $buddy->getApiPermissions()->getWorkspacePermissions($domain, [$accessToken]);
```

Add permission
```php
    $buddy->getApiPermissions()->addWorkspacePermission($data, $domain, [$accessToken]);
```

Get permission
```php
    $buddy->getApiPermissions()->getWorkspacePermission($domain, $permissionId, [$accessToken]);
```

Edit permission
```php
    $buddy->getApiPermissions()->editWorkspacePermission($data, $domain, $permissionId, [$accessToken]);
```

Delete permission
```php
    $buddy->getApiPermissions()->deleteWorkspacePermission($domain, $permissionId, [$accessToken]);
```

### Members

Get members
```php
    $buddy->getApiMembers()->getWorkspaceMembers($domain, [$filters], [$accessToken]);
```

Add member
```php
    $buddy->getApiMembers()->addWorkspaceMember($domain, $email, [$accessToken]);
```

Get member
```php
    $buddy->getApiMembers()->getWorkspaceMember($domain, $userId, [$accessToken]);
```

Edit member
```php
    $buddy->getApiMembers()->editWorkspaceMember($domain, $userId, $isAdmin, [$accessToken]);
```

Delete member
```php
    $buddy->getApiMembers()->deleteWorkspaceMember($domain, $userId, [$accessToken]);
```

Get member projects
```php
    $buddy->getApiMembers()->getWorkspaceMemberProjects($domain, $userId, [$filters], [$accessToken]);
```

### Integrations

Get integrations
```php
    $buddy->getApiIntegrations()->getIntegrations([$accessToken]);
```

Get integration
```php
    $buddy->getApiIntegrations()->getIntegration($integrationId, [$accessToken]);
```

### Groups

Get groups
```php
    $buddy->getApiGroups()->getGroups($domain, [$accessToken]);
```

Add group
```php
    $buddy->getApiGroups()->addGroup($data, $domain, [$accessToken]);
```

Get group
```php
    $buddy->getApiGroups()->getGroup($domain, $groupId, [$accessToken]);
```

Edit group
```php
    $buddy->getApiGroups()->editGroup($data, $domain, $groupId, [$accessToken]);
```

Delete group
```php
    $buddy->getApiGroups()->deleteGroup($domain, $groupId, [$accessToken]);
```

Get group members
```php
    $buddy->getApiGroups()->getGroupMembers($domain, $groupId, [$accessToken]);
```

Add group member
```php
    $buddy->getApiGroups()->addGroupMember($domain, $groupId, $userId, [$accessToken]);
```

Get group member
```php
    $buddy->getApiGroups()->getGroupMember($domain, $groupId, $userId, [$accessToken]);
```

Delete group member
```php
    $buddy->getApiGroups()->deleteGroupMember($domain, $groupId, $userId, [$accessToken]);
```

### Executions

Get executions
```php
    $buddy->getApiExecutions()->getExecutions($domain, $projectName, $pipelineId, [$filters], [$accessToken]);
```

Run execution
```php
    $buddy->getApiExecutions()->runExecution($data, $domain, $projectName, $pipelineId, [$accessToken]);
```

Get execution
```php
    $buddy->getApiExecutions()->getExecution($domain, $projectName, $pipelineId, $executionId, [$accessToken]);
```

Cancel execution
```php
    $buddy->getApiExecutions()->cancelExecution($domain, $projectName, $pipelineId, $executionId, [$accessToken]);
```

Retry execution
```php
    $buddy->getApiExecutions()->retryRelease($domain, $projectName, $pipelineId, $executionId, [$accessToken]);
```

### Emails

Get emails
```php
    $buddy->getApiEmails()->getAuthenticatedUserEmails([$accessToken]);
```

Add email
```php
    $buddy->getApiEmails()->addAuthenticatedUserEmail($email, [$accessToken]);
```

Delete email
```php
    $buddy->getApiEmails()->deleteAuthenticatedUserEmail($email, [$accessToken]);  
```

### Commits

Get commits
```php
    $buddy->getApiCommits()->getCommits($domain, $projectName, [$filters], [$accessToken]);
```

Get commit
```php
    $buddy->getApiCommits()->getCommit($domain, $projectName, $revision, [$accessToken]);
```

Compare commits
```php
    $buddy->getApiCommits()->getCompare($domain, $projectName, $base, $head, [$filters], [$accessToken]);
```

### Branches

Get branches
```php
    $buddy->getApiBranches()->getBranches($domain, $projectName, [$accessToken]);
```

Get branch
```php
    $buddy->getApiBranches()->getBranch($domain, $projectName, $name, [$accessToken]);
```

Add branch
```php
    $buddy->getApiBranches()->addBranch($data, $domain, $projectName, [$accessToken]);
```

Delete branch
```php
    $buddy->getApiBranches()->deleteBranch($domain, $projectName, $name, [$force], [$accessToken]);
```

## License

Please see the [license file](https://github.com/buddy-works/buddy-works-php-api/blob/master/LICENSE) for more information.
