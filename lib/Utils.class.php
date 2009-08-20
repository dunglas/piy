<?php
/**
 * Some utilities.
 *
 */
class Utils {
	/**
	 * Generate an unique id.
	 *
	 * @return String unique id.
	 */
	public static function generateHash() {
		return md5(uniqid(rand(), true));
	}
}
?>