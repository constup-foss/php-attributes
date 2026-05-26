<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Exceptions;

use ConstupFoss\PhpExerr\Library\LibraryException;

abstract class ConstupPhpAttributesException extends LibraryException
{
    protected string $libraryName = 'constup/php-attributes';
}
