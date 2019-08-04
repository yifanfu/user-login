<?php


namespace App\Service;


use App\Annotation\InternalUser;
use Doctrine\Common\Annotations\Reader;
use ReflectionClass;
use ReflectionException;

class UserService
{
    /** @var Reader $reader */
    private $reader;

    /**
     * UserService constructor.
     * @param Reader $reader
     */
    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @param string $userEntityClass
     * @return bool
     */
    public function isInternalUser(string $userEntityClass)
    {
        try {
            $reflClass = new ReflectionClass($userEntityClass);
            $classAnnotations = $this->reader->getClassAnnotations($reflClass);
            foreach ($classAnnotations as $classAnnotation) {
                if ($classAnnotation instanceof InternalUser) {
                    return true;
                }
            }
            return false;
        } catch (ReflectionException $exception) {
            // TODO add logging
            return false;
        }
    }
}