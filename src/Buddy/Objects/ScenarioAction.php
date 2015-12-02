<?php
/**
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Buddy\Objects;

class ScenarioAction extends Object
{
    const TYPE_FTP = 'FTP';
    const TYPE_FTPS = 'FTPS';
    const TYPE_SFTP = 'SFTP';
    const TYPE_AMAZON_S3 = 'AMAZON_S3';
    const TYPE_SSH_COMMAND = 'SSH_COMMAND';

    const AUTH_MODE_PASS = 'PASS';
    const AUTH_MODE_PRIVATE_KEY = 'PRIVATE_KEY';
    const AUTH_MODE_PRIVATE_KEY_AND_PASS = 'PRIVATE_KEY_AND_PASS';

    const STATUS_INPROGRESS = 'INPROGRESS';
    const STATUS_ENQUEUED = 'ENQUEUED';
    const STATUS_TERMINATED = 'TERMINATED';
    const STATUS_SUCCESSFUL = 'SUCCESSFUL';
    const STATUS_FAILED = 'FAILED';
    const STATUS_INITIAL = 'INITIAL';

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $revision;

    /**
     * @var string
     */
    protected $localPath;

    /**
     * @var string
     */
    protected $remotePath;

    /**
     * @var string
     */
    protected $workingDirectory;

    /**
     * @var string
     */
    protected $bucketName;

    /**
     * @var string
     */
    protected $accessKey;

    /**
     * @var string
     */
    protected $secretKey;

    /**
     * @var bool
     */
    protected $publicAccess;

    /**
     * @var string
     */
    protected $cloudfrontId;

    /**
     * @var bool
     */
    protected $reducedRedundancy;

    /**
     * @var array
     */
    protected $commands;

    /**
     * @var string
     */
    protected $login;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var bool
     */
    protected $activeMode;

    /**
     * @var string
     */
    protected $host;

    /**
     * @var int
     */
    protected $port;

    /**
     * @var string
     */
    protected $authenticationMode;

    /**
     * @var string
     */
    protected $serverKey;

    /**
     * @var string
     */
    protected $passphrase;

    /**
     * ScenarioAction constructor.
     * @param array $json
     * @param array $headers
     * @param int $status
     */
    public function __construct(array $json = [], array $headers = [], $status = 200)
    {
        parent::__construct($json, $headers, $status);
        $this->setFromJson('id');
        $this->setFromJson('name');
        $this->setFromJson('type');
        $this->setFromJson('status');
        $this->setFromJson('revision');
        $this->setFromJson('localPath', 'local_path');
        $this->setFromJson('remotePath', 'remote_path');
        $this->setFromJson('workingDirectory', 'working_directory');
        $this->setFromJson('bucketName', 'bucket_name');
        $this->setFromJson('accessKey', 'access_key');
        $this->setFromJson('secretKey', 'secret_key');
        $this->setFromJson('publicAccess', 'public_access');
        $this->setFromJson('cloudfrontId', 'cloudfront_id');
        $this->setFromJson('reducedRedundancy', 'reduced_redundancy');
        $this->setFromJson('login');
        $this->setFromJson('password');
        $this->setFromJson('activeMode', '$active_mode');
        $this->setFromJson('host');
        $this->setFromJson('port');
        $this->setFromJson('authenticationMode', 'authentication_mode');
        $this->setFromJson('serverKey', 'server_key');
        $this->setFromJson('passphrase');
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setName($val)
    {
        $this->name = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setType($val)
    {
        $this->type = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getRevision()
    {
        return $this->revision;
    }

    /**
     * @return string
     */
    public function getLocalPath()
    {
        return $this->localPath;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setLocalPath($val)
    {
        $this->localPath = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getRemotePath()
    {
        return $this->remotePath;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setRemotePath($val)
    {
        $this->remotePath = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getWorkingDirectory()
    {
        return $this->workingDirectory;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setWorkingDirectory($val)
    {
        $this->workingDirectory = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getBucketName()
    {
        return $this->bucketName;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setBucketName($val)
    {
        $this->bucketName = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccessKey()
    {
        return $this->accessKey;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setAccessKey($val)
    {
        $this->accessKey = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setSecretKey($val)
    {
        $this->secretKey = $val;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getPublicAccess()
    {
        return $this->publicAccess;
    }

    /**
     * @param bool $val
     * @return $this
     */
    public function setPublicAccess($val)
    {
        $this->publicAccess = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getCloudfrontId()
    {
        return $this->cloudfrontId;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setCloudfrontId($val)
    {
        $this->cloudfrontId = $val;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getReducedRedundancy()
    {
        return $this->reducedRedundancy;
    }

    /**
     * @param bool $val
     * @return $this
     */
    public function setReducedRedundancy($val)
    {
        $this->reducedRedundancy = $val;
        return $this;
    }

    /**
     * @return array
     */
    public function getCommands()
    {
        return $this->commands;
    }

    /**
     * @param array $val
     * @return $this
     */
    public function setCommands($val)
    {
        $this->commands = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setLogin($val)
    {
        $this->login = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setPassword($val)
    {
        $this->password = $val;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getActiveMode()
    {
        return $this->activeMode;
    }

    /**
     * @param bool $val
     * @return $this
     */
    public function setActiveMode($val)
    {
        $this->activeMode = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setHost($val)
    {
        $this->host = $val;
        return $this;
    }

    /**
     * @param int $val
     * @return $this
     */
    public function setPort($val)
    {
        $this->port = $val;
        return $this;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getAuthenticationMode()
    {
        return $this->authenticationMode;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setAuthenticationMode($val)
    {
        $this->authenticationMode = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getServerKey()
    {
        return $this->serverKey;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setServerKey($val)
    {
        $this->serverKey = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassphrase()
    {
        return $this->passphrase;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setPassphrase($val)
    {
        $this->passphrase = $val;
        return $this;
    }
}
