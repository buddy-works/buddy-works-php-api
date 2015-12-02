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

class User extends Object
{
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
    protected $avatarUrl;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var bool
     */
    protected $admin;

    /**
     * @var bool
     */
    protected $workspaceOwner;

    /**
     * @var PermissionSet
     */
    protected $permissionSet;

    /**
     * User constructor.
     * @param array $json
     * @param array $headers
     * @param int $status
     */
    public function __construct(array $json = [], array $headers = [], $status = 200)
    {
        parent::__construct($json, $headers, $status);
        $this->setFromJson('id');
        $this->setFromJson('name');
        $this->setFromJson('avatarUrl', 'avatar_url');
        $this->setFromJson('title');
        $this->setFromJson('email');
        $this->setFromJson('admin');
        $this->setFromJson('workspaceOwner', 'workspace_owner');
        $this->setFromJsonAsObject('Buddy\Objects\PermissionSet', 'permissionSet', 'permission_set');
    }

    /**
     * @return bool
     */
    public function getWorkspaceOwner()
    {
        return $this->workspaceOwner;
    }

    /**
     * @return bool
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param bool $val
     * @return $this
     */
    public function setAdmin($val)
    {
        $this->admin = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setEmail($val)
    {
        $this->email = $val;
        return $this;
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
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setTitle($val)
    {
        $this->title = $val;
        return $this;
    }

    /**
     * @return PermissionSet
     */
    public function getPermissionSet()
    {
        return $this->permissionSet;
    }

    /**
     * @param PermissionSet $val
     * @return $this
     */
    public function setPermissionSet($val)
    {
        $this->permissionSet = $val;
        return $this;
    }
}
