<?php
/**
 * Class: Common
 *
 * This abstract is designed to make in-class hook binding more easily
 * automated. Simply call the ::init() function from functions.php to
 * register all actions and filters within.
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

namespace glantz\base;

class common {
	
	/**
	 * Parse Arguments
	 *
	 * Make sure user arguments follow a default
	 * format. Unlike `wp_parse_args()`-type functions,
	 * only keys from the template are allowed.
	 *
	 * @param mixed $args User arguments.
	 * @param mixed $defaults Default values/format.
	 * @param bool $strict Strict type enforcement.
	 * @param bool $recursive Recursively apply formatting if inner values are also arrays.
	 * @return array Parsed arguments.
	 */
	public static function parse_args(
		$args, $defaults, bool $strict=true, bool $recursive=true
	) {
		static::cast_array($defaults);
		if (empty($defaults)) { return array(); }

		static::cast_array($args);
		if (empty($args)) { return $defaults; }

		foreach ($defaults as $k=>$v) {
			if (\array_key_exists($k, $args)) {
				// Recurse if the default is a populated associative array.
				if (
					$recursive &&
					\is_array($defaults[$k]) &&
					(static::array_type($defaults[$k]) === 'associative')
				) {
					$defaults[$k] = static::parse($args[$k], $defaults[$k], $strict, $recursive);
				}
				// Otherwise just replace.
				else {
					$defaults[$k] = $args[$k];
					if ($strict && (null !== $v)) {
						switch (\strtolower(\gettype($v))) {
							case 'string':
								static::cast_string($defaults[$k]);
								break;
							case 'int':
							case 'integer':
								static::cast_int($defaults[$k]);
								break;
							case 'double':
							case 'float':
							case 'number':
								static::cast_float($defaults[$k]);
								break;
							case 'bool':
							case 'boolean':
								static::cast_bool($defaults[$k]);
								break;
							case 'array':
								static::cast_array($defaults[$k]);
								break;
						}
					}
				}
			}
		}

		return $defaults;
	}

	// Weird numbers.
	const NUMBER_CHARS = array(
		"\xef\xbc\x90"=>0,
		"\xef\xbc\x91"=>1,
		"\xef\xbc\x92"=>2,
		"\xef\xbc\x93"=>3,
		"\xef\xbc\x94"=>4,
		"\xef\xbc\x95"=>5,
		"\xef\xbc\x96"=>6,
		"\xef\xbc\x97"=>7,
		"\xef\xbc\x98"=>8,
		"\xef\xbc\x99"=>9,
		"\xd9\xa0"=>0,
		"\xd9\xa1"=>1,
		"\xd9\xa2"=>2,
		"\xd9\xa3"=>3,
		"\xd9\xa4"=>4,
		"\xd9\xa5"=>5,
		"\xd9\xa6"=>6,
		"\xd9\xa7"=>7,
		"\xd9\xa8"=>8,
		"\xd9\xa9"=>9,
		"\xdb\xb0"=>0,
		"\xdb\xb1"=>1,
		"\xdb\xb2"=>2,
		"\xdb\xb3"=>3,
		"\xdb\xb4"=>4,
		"\xdb\xb5"=>5,
		"\xdb\xb6"=>6,
		"\xdb\xb7"=>7,
		"\xdb\xb8"=>8,
		"\xdb\xb9"=>9,
		"\xe1\xa0\x90"=>0,
		"\xe1\xa0\x91"=>1,
		"\xe1\xa0\x92"=>2,
		"\xe1\xa0\x93"=>3,
		"\xe1\xa0\x94"=>4,
		"\xe1\xa0\x95"=>5,
		"\xe1\xa0\x96"=>6,
		"\xe1\xa0\x97"=>7,
		"\xe1\xa0\x98"=>8,
		"\xe1\xa0\x99"=>9,
	);

	// Truthy bools.
	const TRUE_BOOLS = array(
		'1',
		'on',
		'true',
		'yes',
	);

	// Falsey bools.
	const FALSE_BOOLS = array(
		'0',
		'off',
		'false',
		'no',
	);

	/**
	 * Return the first value of an array.
	 *
	 * @param array $arr Array.
	 * @return mixed Value. False on error.
	 */
	private static function array_pop_top(array &$arr) {
		if (empty($arr)) { return false; }

		\reset($arr);
		return $arr[\key($arr)];
	}

	/**
	 * Array Type
	 *
	 * "associative": If there are string keys.
	 * "sequential": If the keys are sequential numbers.
	 * "indexed": If the keys are at least numeric.
	 * FALSE: Any other condition.
	 *
	 * @param array $arr Array.
	 * @return string|bool Type. False on failure.
	 */
	private static function array_type(&$arr=null) {
		if (! \is_array($arr) || empty($arr)) { return false; }

		$keys = \array_keys($arr);
		$count = \count($keys);
		if (\range(0, $count - 1) === $keys) {
			return 'sequential';
		}
		elseif (\count(\array_filter($keys, 'is_numeric')) === $count) {
			return 'indexed';
		}
		else { return 'associative'; }
	}

	/**
	 * To Array
	 *
	 * @param mixed $value Variable.
	 * @return void Nothing.
	 */
	private static function cast_array(&$value=null) {
		// Short circuit.
		if (! \is_array($value)) {
			try {
				$value = (array) $value;
			} catch (\Throwable $e) {
				$value = array();
			}
		}
	}

	/**
	 * To Bool
	 *
	 * @param mixed $value Variable.
	 * @return void Nothing.
	 */
	private static function cast_bool(&$value=false) {
		if (! \is_bool($value)) {
			// Evaluate special cases.
			if (\is_string($value)) {
				$value = \strtolower($value);
				if (\in_array($value, static::TRUE_BOOLS, true)) {
					$value = true;
					return;
				}
				elseif (\in_array($value, static::FALSE_BOOLS, true)) {
					$value = false;
					return;
				}
			}
			elseif (\is_array($value)) {
				$value = ! empty($value);
				return;
			}

			if (! \is_bool($value)) {
				try {
					$value = (bool) $value;
				} catch (\Throwable $e) {
					$value = false;
				}
			}
		}
	}

	/**
	 * To Float
	 *
	 * @param mixed $value Variable.
	 * @return void Nothing.
	 */
	private static function cast_float(&$value=0) {
		if (! \is_float($value)) {
			// Flatten single-entry arrays.
			if (\is_array($value)) {
				if (1 === \count($value)) {
					$value = static::array_pop_top($value);
				}

				// If we're still an array, call it quits.
				if (\is_array($value)) {
					$value = 0.0;
					return;
				}
			}

			if (\is_string($value)) {
				// Replace number chars.
				$from = \array_keys(static::NUMBER_CHARS);
				$to = \array_values(static::NUMBER_CHARS);
				$value = \str_replace($from, $to, $value);

				// Convert from cents.
				if (\preg_match('/^\-?[\d,]*\.?\d+¢$/', $value)) {
					$value = \preg_replace('/[^\-\d\.]/', '', $value);
					static::cast_float($value);
					$value /= 100;
				}
				// Convert from percent.
				elseif (\preg_match('/^\-?[\d,]*\.?\d+%$/', $value)) {
					$value = \preg_replace('/[^\-\d\.]/', '', $value);
					static::cast_float($value);
					$value /= 100;
				}
			}

			if (! \is_float($value)) {
				try {
					$value = (float) \filter_var(
						$value,
						\FILTER_SANITIZE_NUMBER_FLOAT,
						\FILTER_FLAG_ALLOW_FRACTION
					);
				} catch (\Throwable $e) {
					$value = 0.0;
				}
			}
		}
	}

	/**
	 * To Int
	 *
	 * @param mixed $value Variable.
	 * @return void Nothing.
	 */
	private static function cast_int(&$value=0) {
		// Short circuit.
		if (\is_int($value)) { return; }

		// Flatten single-entry arrays.
		if (\is_array($value)) {
			if (1 === \count($value)) {
				$value = static::array_pop_top($value);
			}

			// If we're still an array, call it quits.
			if (\is_array($value)) {
				$value = 0;
				return;
			}
		}

		// Evaluate special cases.
		if (\is_string($value)) {
			$value = \strtolower($value);
			if (\in_array($value, static::TRUE_BOOLS, true)) {
				$value = 1;
				return;
			}
			elseif (\in_array($value, static::FALSE_BOOLS, true)) {
				$value = 0;
				return;
			}
		}

		if (! \is_int($value)) {
			static::cast_float($value);
			$value = (int) $value;
		}
	}

	/**
	 * To String
	 *
	 * @param mixed $value Variable.
	 * @return void Nothing.
	 */
	private static function cast_string(&$value='') {
		// Flatten single-entry arrays.
		if (\is_array($value)) {
			if (1 === \count($value)) {
				$value = static::array_pop_top($value);
			}

			// If we're still an array, call it quits.
			if (\is_array($value)) {
				$value = '';
				return;
			}
		}

		if (! is_string($value)) {
			try {
				$value = (string) $value;
			} catch (\Throwable $e) {
				$value = '';
			}
		}
	}
}
