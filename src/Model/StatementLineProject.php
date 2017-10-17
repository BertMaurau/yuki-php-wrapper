<?php

/*
 * Copyright 2017 Bert Maurau.
 *
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

namespace Yuki\Model;

require_once __DIR__ . '\StatementLine.php';

/**
 * Description of StatementLineProject
 *
 * @author Bert Maurau
 */
class StatementLineProject extends StatementLine
{

    private $projectCode;
    private $projectName;

    public function getProjectCode()
    {
        return $this -> projectCode;
    }

    public function getProjectName()
    {
        return $this -> projectName;
    }

    public function setProjectCode($projectCode)
    {
        $this -> projectCode = $projectCode;
        return $this;
    }

    public function setProjectName($projectName)
    {
        $this -> projectName = $projectName;
        return $this;
    }

}
