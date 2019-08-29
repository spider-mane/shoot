<?php

namespace WebTheory;

use libphonenumber\NumberFormat;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\PhoneNumberFormat;

/**
 *
 */
class PhoneHelper
{
    /**
     *
     */
    public function __callStatic($name, $args)
    {
        if (method_exists(static::class, $name)) {
            return (new static)->$name(...$args);
        }
    }

    /**
     *
     */
    public function formatUsNumber(string $phoneNumber, string $format = '-')
    {
        $pattern = "(\\d{3})(\\d{3})(\\d{4})";

        $formats = [
            '-' => "\$1-\$2-\$3",
            '.' => "\$1.\$2.\$3",
            ' ' => "\$1 \$2 \$3",
            '(' => "(\$1) \$2-\$3",
            '' => "\$1\$2\$3",
        ];

        $newFormats[] = (new NumberFormat)
            ->setPattern($pattern)
            ->setFormat($formats[$format]);

        $phoneUtil = PhoneNumberUtil::getInstance();

        $phoneNumber = $phoneUtil->parse($phoneNumber, 'US');

        $phoneNumber = $phoneUtil->formatByPattern($phoneNumber, PhoneNumberFormat::NATIONAL, $newFormats);

        return $phoneNumber;
    }

    /**
     *
     */
    public function getPhoneLink($phoneNumber, $region = 'US')
    {
        $phoneUtil = PhoneNumberUtil::getInstance();
        $phoneNumber = $phoneUtil->parse($phoneNumber, $region);
        $phoneNumber = $phoneUtil->format($phoneNumber, PhoneNumberFormat::RFC3966);

        return $phoneNumber;
    }
}
