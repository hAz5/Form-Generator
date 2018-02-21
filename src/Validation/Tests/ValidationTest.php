<?php

namespace Neo\Validation\Tests;

use Neo\Validation\Boolean;
use Neo\Validation\Callback;
use Neo\Validation\Equal;
use Neo\Validation\Exception;
use Neo\Validation\File;
use Neo\Validation\InArray;
use Neo\Validation\Integer;
use Neo\Validation\Ip;
use Neo\Validation\IsChecked;
use Neo\Validation\Email;
use Neo\Validation\NotEmpty;
use Neo\Validation\Regexp;
use Neo\Validation\Str;
use Neo\Validation\Url;
use Neo\Validation\Slug;
use Neo\Validation\Date;
use PHPUnit_Framework_TestCase;

/**
 * Class ValidationTest
 *
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class ValidationTest extends PHPUnit_Framework_TestCase
{
    /**
     * Valid slug expression test
     *
     */
    public function testValidSlug()
    {
        $validator = new Slug();
        $this->assertTrue($validator->validate('this-is-01-valid-slug'));
        $this->assertEquals('slug', $validator->getName());
    }

    /**
     * inValid slug expression test
     *
     * @expectedException \Neo\Validation\Exception
     */
    public function testInvalidSlug()
    {
        $validator = new Slug();
        $validator->validate('This is not valid slug'); // Expect exception here
    }

    /**
     * Valid email test
     *
     * @param string $email Email
     *
     * @dataProvider provideValidEmails
     */
    public function testValidEmail($email)
    {
        $validator = new Email();
        $this->assertTrue($validator->validate($email));
        $this->assertEquals('email', $validator->getName());
        $this->assertEquals('', $validator->getParameters());
    }

    /**
     * Invalid email test
     *
     * @param string $email Email
     *
     * @expectedException \Neo\Validation\Exception
     * @dataProvider providerInValidEmails
     */
    public function testInvalidEmail($email)
    {
        $validator = new Email();
        $validator->validate($email); // Expect exception here
    }

    /**
     * Valid emails provider
     *
     * @return array
     */
    public function provideValidEmails()
    {
        $data = explode(PHP_EOL, file_get_contents(__DIR__ . '/Fixture/valid.mail'));
        $result = [];
        foreach ($data as $email) {
            if (!empty($email)) {
                $result[] = [$email];
            }
        }

        return $result;
    }

    /**
     * Invalid emails provider
     *
     * @return array
     */
    public function providerInValidEmails()
    {
        $data = explode(PHP_EOL, file_get_contents(__DIR__ . '/Fixture/invalid.mail'));
        $result = [];
        foreach ($data as $email) {
            if (!empty($email)) {
                $result[] = [$email];
            }
        }

        return $result;
    }

    /**
     *Valid url test
     *
     * @param string $url Url
     *
     * @dataProvider provideValidUrls
     */
    public function testValidUrl($url)
    {
        $validator = new Url();
        $this->assertTrue($validator->validate($url));
        $this->assertEquals('url', $validator->getName());
        $this->assertEquals('', $validator->getParameters());
    }

    /**
     * Invalid url test
     *
     * @param string $url Url
     *
     * @expectedException \Neo\Validation\Exception
     * @dataProvider providerInValidUrls
     */
    public function testInvalidUrl($url)
    {
        $validator = new Url();
        $validator->validate($url); // Expect exception here
    }

    /**
     * Valid urls provider
     *
     * @return array
     */
    public function provideValidUrls()
    {
        $data = explode(PHP_EOL, file_get_contents(__DIR__ . '/Fixture/valid.url'));
        $result = [];
        foreach ($data as $email) {
            if (!empty($email)) {
                $result[] = [$email];
            }
        }

        return $result;
    }

    /**
     * Invalid urls provider
     *
     * @return array
     */
    public function providerInValidUrls()
    {
        $data = explode(PHP_EOL, file_get_contents(__DIR__ . '/Fixture/invalid.url'));
        $result = [];
        foreach ($data as $email) {
            if (!empty($email)) {
                $result[] = [$email];
            }
        }

        return $result;
    }

    /**
     * Valid ip test
     *
     * @param string $validIp Ip
     *
     * @dataProvider providerValidIp
     */
    public function testValidIp($validIp)
    {
        $validator = new Ip();
        $this->assertTrue($validator->validate($validIp));
        $this->assertEquals('ip', $validator->getName());
        $this->assertEquals('', $validator->getParameters());
    }

    /**
     * Invalid ip test
     *
     * @param string $invalidIp Ip
     *
     * @dataProvider providerInValidUrls
     * @expectedException \Neo\Validation\Exception
     */
    public function testInvalidIp($invalidIp)
    {
        $validator = new Ip();
        $validator->validate($invalidIp);
    }

    /**
     * Valid ip provider
     *
     * @return array
     */
    public function providerValidIp()
    {
        $data = explode(PHP_EOL, file_get_contents(__DIR__ . '/Fixture/valid.ip'));
        $result = [];
        foreach ($data as $ip) {
            if (!empty($ip)) {
                $result[] = [$ip];
            }
        }

        return $result;
    }

    /**
     * Invalid ip provider
     *
     * @return array
     */
    public function providerInValidIp()
    {
        $data = explode(PHP_EOL, file_get_contents(__DIR__ . '/Fixture/invalid.ip'));
        $result = [];
        foreach ($data as $ip) {
            if (!empty($ip)) {
                $result[] = [$ip];
            }
        }

        return $result;
    }

    /**
     * Valid integer test
     *
     * @param int $value Integer value
     * @param int $min   Minimum value
     * @param int $max   Maximum value
     *
     * @dataProvider providerValidInteger
     */
    public function testValidInteger($value, $min, $max)
    {
        $validator = new Integer(
            [
                'min_range' => $min,
                'max_range' => $max
            ]
        );
        $this->assertTrue($validator->validate($value));
        $this->assertEquals('integer', $validator->getName());
        $result = [];
        if ($min !== false) {
            $result[] = $min;
        } else {
            $result[] = '';
        }
        if ($max !== false) {
            $result[] = $max;
        } else {
            $result[] = '';
        }
        $this->assertEquals(join(',', $result), $validator->getParameters());
    }

    /**
     * Invalid integer test
     *
     * @param int $value Integer value
     * @param int $min   Minimum value
     * @param int $max   Maximum value
     *
     * @dataProvider providerInValidInteger
     * @expectedException \Neo\Validation\Exception
     */
    public function testInvalidInteger($value, $min, $max)
    {
        $validator = new Integer(
            [
                'min_range' => $min,
                'max_range' => $max
            ]
        );
        $validator->validate($value);
    }

    /**
     * Valid integer provider
     *
     * @return array
     */
    public function providerValidInteger()
    {
        $data = explode(PHP_EOL, file_get_contents(__DIR__ . '/Fixture/valid.integer'));
        $result = [];
        foreach ($data as $all) {
            if (!empty($all)) {
                $all = explode(',', $all);
                if (!$all[1]) {
                    $all[1] = false;
                }
                if (!$all[2]) {
                    $all[2] = false;
                }
                $result[] = $all;
            }
        }

        return $result;
    }

    /**
     * Invalid integer provider
     *
     * @return array
     */
    public function providerInValidInteger()
    {
        $data = explode(PHP_EOL, file_get_contents(__DIR__ . '/Fixture/invalid.integer'));
        $result = [];
        foreach ($data as $all) {
            if (!empty($all)) {
                $all = explode(',', $all);
                if (!$all[1]) {
                    $all[1] = false;
                }
                if (!$all[2]) {
                    $all[2] = false;
                }
                $result[] = $all;
            }
        }

        return $result;
    }

    /**
     * Valid regular expression test
     *
     * @param mixed  $value  Value
     * @param string $regexp regular expression
     *
     * @dataProvider providerValidRegexp
     */
    public function testValidRegexp($value, $regexp)
    {
        $validator = new Regexp(
            [
                'regexp' => $regexp
            ]
        );
        $this->assertTrue($validator->validate($value));
        $this->assertEquals('regexp', $validator->getName());
        $this->assertEquals($regexp, $validator->getParameters());
    }

    /**
     * Valid regular expression provider
     *
     * @return array
     */
    public function providerValidRegexp()
    {
        $data = explode(PHP_EOL, file_get_contents(__DIR__ . '/Fixture/valid.regexp'));
        $result = [];
        foreach ($data as $regexp) {
            if (!empty($regexp)) {
                $result[] = explode('|', $regexp);
            }
        }

        return $result;
    }

    /**
     * Invalid regular expression test
     *
     * @param mixed  $value  Value
     * @param string $regexp regular expression
     *
     * @dataProvider providerInValidRegexp
     * @expectedException \Neo\Validation\Exception
     */
    public function testInvalidRegexp($value, $regexp)
    {
        $validator = new Regexp(
            [
                'regexp' => $regexp
            ]
        );
        $validator->validate($value);
    }

    /**
     * Invalid regular expression provider
     *
     * @return array
     */
    public function providerInValidRegexp()
    {
        $data = explode(PHP_EOL, file_get_contents(__DIR__ . '/Fixture/invalid.regexp'));
        $result = [];
        foreach ($data as $regexp) {
            if (!empty($regexp)) {
                $result[] = explode('|', $regexp);
            }
        }

        return $result;
    }

    /**
     * Valid in array test
     *
     * @param string $value           Search string in array
     * @param array  $array           Array
     * @param bool   $caseInsensitive Case insensitive
     *
     * @dataProvider providerValidArray
     */
    public function testValidInArray($value, array $array, $caseInsensitive)
    {
        $validator = new InArray(
            [
                'haystack' => $array,
                'case_insensitive' => $caseInsensitive
            ]
        );

        $this->assertTrue($validator->validate($value));
        $this->assertEquals('in_array', $validator->getName());
        $this->assertEquals(join(',', $array), $validator->getParameters());
    }

    /**
     * Valid array provider
     *
     * @return array
     */
    public function providerValidArray()
    {
        $data = explode(PHP_EOL, file_get_contents(__DIR__ . '/Fixture/valid.inarray'));
        $result = [];
        foreach ($data as $array) {
            if (!empty($array)) {
                $dummy = explode('|', $array);
                $dummy[1] = explode(',', $dummy[1]);
                $result[] = $dummy;
            }
        }

        return $result;
    }

    /**
     * Invalid in array test
     *
     * @param string $value           Search string in array
     * @param array  $array           Array
     * @param bool   $caseInsensitive Case insensitive
     *
     * @dataProvider providerInValidArray
     * @expectedException \Neo\Validation\Exception
     */
    public function testInvalidInArray($value, array $array, $caseInsensitive)
    {
        $validator = new InArray(
            [
                'haystack' => $array,
                'case_insensitive' => $caseInsensitive
            ]
        );
        $validator->validate($value);
    }

    /**
     * Invalid array provider
     *
     * @return array
     */
    public function providerInValidArray()
    {
        $data = explode(PHP_EOL, file_get_contents(__DIR__ . '/Fixture/invalid.inarray'));
        $result = [];
        foreach ($data as $array) {
            if (!empty($array)) {
                $dummy = explode('|', $array);
                $dummy[1] = explode(',', $dummy[1]);
                $result[] = $dummy;
            }
        }

        return $result;
    }

    /**
     * Valid string test
     *
     * @param string $value   Value
     * @param int    $min     Minimum string
     * @param int    $max     Maximum string
     * @param int    $minWord Minimum word
     * @param int    $maxWord Maximum word
     *
     * @dataProvider providerValidString
     */
    public function testValidString($value, $min, $max, $minWord, $maxWord)
    {
        $validator = new Str(
            [
                'min_length' => $min,
                'max_length' => $max,
                'min_word' => $minWord,
                'max_word' => $maxWord
            ]
        );

        $this->assertTrue($validator->validate($value));
        $this->assertEquals('string', $validator->getName());

        $result = [];
        if ($min !== false) {
            $result[] = $min;
        } else {
            $result[] = '';
        }

        if ($max !== false) {
            $result[] = $max;
        } else {
            $result[] = '';
        }

        if ($minWord !== false) {
            $result[] = $minWord;
        } else {
            $result[] = '';
        }

        if ($maxWord !== false) {
            $result[] = $maxWord;
        } else {
            $result[] = '';
        }

        $this->assertEquals(join(',', $result), $validator->getParameters());
    }

    /**
     * Valid string provider
     *
     * @return array
     */
    public function providerValidString()
    {
        $data = explode(PHP_EOL, file_get_contents(__DIR__ . '/Fixture/valid.string'));
        $result = [];

        foreach ($data as $all) {
            if (!empty($all)) {
                $all = explode(',', $all);

                if (!$all[1]) {
                    $all[1] = false;
                }

                if (!$all[2]) {
                    $all[2] = false;
                }

                if (!$all[3]) {
                    $all[3] = false;
                }

                if (!$all[4]) {
                    $all[4] = false;
                }

                $result[] = $all;
            }
        }

        return $result;
    }

    /**
     * Valid string test
     *
     * @param string $value   Value
     * @param int    $min     Minimum string
     * @param int    $max     Maximum string
     * @param int    $minWord Minimum word
     * @param int    $maxWord Maximum word
     *
     * @dataProvider providerInValidString
     * @expectedException \Neo\Validation\Exception
     */
    public function testInvalidString($value, $min, $max, $minWord, $maxWord)
    {
        $validator = new Str(
            [
                'min_length' => $min,
                'max_length' => $max,
                'min_word' => $minWord,
                'max_word' => $maxWord,
            ]
        );
        $validator->validate($value);
    }

    /**
     * Invalid string provider
     *
     * @return array
     */
    public function providerInValidString()
    {
        $data = explode(PHP_EOL, file_get_contents(__DIR__ . '/Fixture/invalid.string'));
        $result = [];

        foreach ($data as $all) {
            if (!empty($all)) {
                $all = explode(',', $all);
                if (!$all[1]) {
                    $all[1] = false;
                }

                if (!$all[2]) {
                    $all[2] = false;
                }

                if (!$all[3]) {
                    $all[3] = false;
                }

                if (!$all[4]) {
                    $all[4] = false;
                }
                $result[] = $all;
            }
        }

        return $result;
    }

    /**
     * Boolean test
     */
    public function testBoolean()
    {
        $array = [true, 'true', 'on', 'yes', 1, 0, false, 'false', 'off', 'no'];
        $validator = new Boolean();

        foreach ($array as $val) {
            $this->assertTrue($validator->validate($val));
        }
    }

    /**
     * Valid boolean test
     */
    public function testValidBoolean()
    {
        $array = [true, 'true', 'on', 1, 'yes'];
        $validator = new IsChecked();
        foreach ($array as $val) {
            $this->assertTrue($validator->validate($val));
        }
    }

    /**
     * Invalid boolean test
     *
     * @expectedException \Neo\Validation\Exception
     */
    public function testInValidBoolean()
    {
        $array = [false, 'false', 'off', 0, 'anything', 'no'];
        $validator = new IsChecked();
        foreach ($array as $val) {
            $this->assertTrue($validator->validate($val));
        }
    }

    /**
     * Not empty test
     */
    public function testNotEmpty()
    {
        $array = [
            'string',
            ['x'],
            5,
            0
        ];
        $validator = new NotEmpty();
        foreach ($array as $val) {
            $this->assertTrue($validator->validate($val));
        }
    }


    /**
     * Not empty test
     *
     * @expectedException \Neo\Validation\Exception
     */
    public function testIsEmpty()
    {
        $array = [
            '',
            null
        ];
        $validator = new NotEmpty();
        foreach ($array as $val) {
            $validator->validate($val);
        }
    }

    /**
     * Valid date test
     */
    public function testValidDate()
    {
        $array = ['2014-01-01', '1980-12-30'];
        $validator = new Date();
        foreach ($array as $val) {
            $this->assertTrue($validator->validate($val));
        }
    }

    /**
     * Invalid date test
     *
     * @expectedException \Neo\Validation\Exception
     */
    public function testInvalidDate()
    {
        $validator = new Date();
        $validator->validate('2014-1-1');
    }

    /**
     * Valid equal
     */
    public function testValidEqual()
    {
        $equalTen = new Equal(['equal' => 10]);
        $equalIntTen = new Equal(['equal' => 10, 'type_check' => true]);

        $this->assertTrue($equalTen->validate(10));
        $this->assertTrue($equalTen->validate('10'));
        $this->assertTrue($equalIntTen->validate(10));
        $this->setExpectedException('\Neo\Validation\Exception');
        $equalIntTen->validate('10');
    }

    /**
     * Test Callback validation
     *
     * @return void
     */
    public function testCallback()
    {
        $callback = function ($data) {
            return ($data % 2 == 0) ? true : false;
        };

        $validator = new Callback(['callback' => $callback, 'message' => 'Is odd!']);
        $this->assertTrue($validator->validate(2));
        $this->setExpectedException('\Neo\Validation\Exception');
        $this->assertFalse($validator->validate(1));
    }
}
