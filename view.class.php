<?= PHP_OPEN_TAG ?>
<?php /** @type \ReflectionClass $class */ ?>


    <?= implode(' ', Reflection::getModifierNames($class->getModifiers())) ?>
    class <?= $class->getShortName() ?>
    <?php if ($class->getParentClass()) : ?>
        extends <?= $class->getParentClass()->getName() ?>
    <?php endif ?>
    <?php if ($class->getInterfaces()) : ?>
        implements <?= implode(', ', $class->getInterfaceNames()) ?>
    <?php endif ?>
    {
        <?php foreach ($class->getConstants() as $const => $value) : ?>
            const <?= $const ?> = '<?= $value ?>';
        <?php endforeach ?>

        <?php foreach ($class->getProperties() as $prop) : ?>
            <?php if ($prop->getDeclaringClass()->getName() == $class->getName()) : ?>
                /**
                 * @var $<?= $prop->getName() ?>

                 */
                <?= implode(' ', Reflection::getModifierNames($prop->getModifiers())) ?>
                $<?= $prop->getName() ?>;
            <?php endif ?>
        <?php endforeach ?>

        <?php foreach ($class->getMethods() as $method) : ?>
            <?php if ($method->getDeclaringClass()->getName() == $class->getName()) : ?>
                /**
                <?php foreach ($method->getParameters() as $param) : ?>
                    * @param<?php if ($param->isArray()) : ?> array<?php else : ?> mixed<?php endif ?> $<?= $param->getName() ?><?php if ($param->isOptional()) : ?> optional<?php endif ?>

                <?php endforeach ?>
                 */
                <?= implode(' ', Reflection::getModifierNames($method->getModifiers())) ?>
                function <?= $method->getName() ?>(
                    <?php foreach ($method->getParameters() as $i => $param) : ?>
                        <?= $i ? ',' : '' ?>
                        $<?= $param->getName() ?>
                        <?php if ($param->isOptional()) : ?>
                            = <?= $param->isDefaultValueAvailable() ? $param->getDefaultValue() : 'UNKNOWN_DEFAULT_VALUE' ?>
                        <?php endif ?>
                    <?php endforeach ?>
                ) {}
            <?php endif ?>
        <?php endforeach ?>

    }

