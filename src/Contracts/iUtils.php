<?php

namespace Justin\Contracts;

/**
 *
 * Interface iUtils
 *
 * @package Justin\Contracts
 *
 */
interface iUtils
{

    /**
     *
     * DATE PARSE
     *
     * @param STRING $date
     *
     * @param BOOLEAN $timestamp
     *
     * @param INTEGER $type
     *
     * @throws JustinUtilsException
     *
     * @return ARRAY | STRING
     *
     */
    public function dateParse($date, $timestamp = true, $type = 0);

}
