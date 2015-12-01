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

class SourceContent extends Object
{
    const CONTENT_TYPE_FILE = 'FILE';
    const CONTENT_TYPE_DIR = 'DIR';
    const CONTENT_TYPE_SYMLINK = 'SYMLINK';
    const CONTENT_TYPE_SUB_MODULE = 'SUB_MODULE';
    const CONTENT_TYPE_EXTERNAL = 'EXTERNAL';

    const ENCODING_BASE64 = 'base64';

    /**
     * @var string
     */
    protected $contentType;

    /**
     * @var string
     */
    protected $encoding;

    /**
     * @var int
     */
    protected $size;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var string
     */
    protected $branch;

    /**
     * SourceContent constructor.
     * @param array $json
     * @param array $headers
     * @param int $status
     */
    public function __construct(array $json = [], array $headers = [], $status = 200)
    {
        parent::__construct($json, $headers, $status);
        $this->setFromJson('contentType', 'content_type');
        $this->setFromJson('encoding');
        $this->setFromJson('size');
        $this->setFromJson('name');
        $this->setFromJson('path');
        $this->setFromJson('content');
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setBranch($val)
    {
        $this->branch = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getBranch()
    {
        return $this->branch;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setMessage($val)
    {
        $this->message = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @return string
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setPath($val)
    {
        $this->path = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setContent($val)
    {
        $this->content = $val;
        return $this;
    }
}
