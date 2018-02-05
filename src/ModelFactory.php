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

namespace Yuki;

/**
 * Description of ModelFactory
 *
 * @author Bert Maurau
 */
class ModelFactory
{

    const NAMESAPCE_REF = 'Yuki\\Model\\';

    public static function checkModel($modelName)
    {
        $modelRef = self::NAMESAPCE_REF . $modelName;
        return class_exists($modelRef, false);
    }

    public static function getModel($modelName)
    {
        $modelRef = self::NAMESAPCE_REF . $modelName;
        return new $modelRef;
    }

    public static function getName($model)
    {
        $className = get_class($model);
        return (substr($className, strrpos($className, '\\') + 1));
    }

}
