<?php

/************************* Basic Function: START *************************/

/**
 * This function check is given variable is empty 
 *  - For string: 1. By default, this also checks if a string is blank or not, but you can change this by sending variable $checkStringIsBlank = false
 *                2. By default, this also ignores if string value = NULL. You can change this by sending variable $ignoreNullString = false
 * @return bool
 */
function isEmpty($Data, $checkStringIsBlank = true, $ignoreNullString = true)
{
    if ($Data == null) // If the variable is null return null
        return true;
    if (gettype($Data) == 'string') { // If the data type is type of String then
        if ($checkStringIsBlank && trim($Data) == "") { // Check if string is blank. And we have to ignore that string
            return true;
        }
        if ($ignoreNullString && trim($Data) == 'NULL') { // Check if a string value is equal to NULL. And we have to ignore that string
            return true;
        }
    } elseif (gettype($Data) == 'int') { // If the data type is a type of integer, then check if it's empty or not
        return empty($Data);
    }

    return false; // Return false if all above cases not full filled. That means variable not empty 
}

/**
 * This function check if given strings is equal 
 * @return bool
 */
function strEqual($str1, $str2)
{
    if (isEmpty($str1) && isEmpty($str2)) {
        return true;    // Returning true if both string is NULL
    }
    if (isEmpty($str1) || isEmpty($str2)) {
        return false;   // Returning false if anyone string is NULL
    }
    if (trim($str1) == trim($str2)) {
        return true;    // Returning true if both string is same  
    }
    return false;       // Return false if all above cases not full filled. That means string is not equal 
}

/************************* Basic Function: END *************************/


/************************* Basic DateTime function:  START *************************/

/**
 * This function returns the current microtime value base on application Timezone
 * @return mixed
 */
function getCurrentTimeStamp()
{
    date_default_timezone_set(config('app.timezone')); // Getting application Timezone
    return microtime(true);
}

/**
 * This function converts microtime to date string
 *      - 1. By default, this function return result with Millie seconds. You also have the option to remove Millie Second from result just send $needMillieSec = false
 *      - 2. By default, this function return format like Y-m-d H: I: s egg: 2000-12-31 24:60:60.1548. You get custom format if you send on at function call
 * @return dateString
 */
function microtimeToDateTime($microtime, $needMillieSec = true, $format = 'Y-m-d H:i:s')
{
    $explodeData = explode(".", $microtime);
    $dateTimeValue = count($explodeData) >= 1 ? $explodeData[0] : null;
    $microTimeValue = count($explodeData) >= 2 ? $explodeData[1] : null;

    if ($needMillieSec) {
        return date($format . '.', $dateTimeValue) . $microTimeValue;
    } else {
        return date($format, $dateTimeValue);
    }
}

/**
 * This function return difference between two microtime as Millie seconds 
 *      - 1. By default, this function uses absolute difference. You also have the option to return results without difference by sending $abs = false
 * @return dateString
 */
function millisecondsBetweenMicrotime($microTimeOne, $microTimeTwo, $abs = true)
{
    $milliseconds = ($microTimeOne - $microTimeTwo) * 1000; // getting difference and converting micro seconds to millie Seconds

    if ($abs) { // Check if result need be Absolute or not
        $milliseconds = ($milliseconds < 0) ? $milliseconds * -1 : $milliseconds;
    }

    return intval($milliseconds);
}
/************************* Basic DateTime function:  END *************************/


/************************* Basic Environment: START *************************/

/**
 * This function return if the current environment is needed Authentication. If function return true, then, We have to authenticate request call before processing it. Otherwise environment, maybe belong to developer or testing, etc., where we can share critical information easily
 * @return bool
 */
function IsAuthEnv()
{
    if (config('app.env') == 'production') { // Production
        return TRUE;
    }
    if (config('app.env') == 'dev') { // Developer acceptance testing
        return FALSE;
    }
    if (config('app.env') == 'uat') { // User acceptance testing
        return FALSE;
    }
    if (config('app.env') == 'local') { // Local
        return FALSE;
    }
    if (config('app.env') == 'testing') { // Testing environment for PHP unit test cases
        return FALSE;
    }
    return TRUE; // By default, setting it true.
}
/************************* Basic Environment: END *************************/
