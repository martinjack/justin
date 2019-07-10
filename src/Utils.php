<?php

namespace Justin;

use Justin\Contracts\iUtils;
use Justin\Exceptions\JustinUtilsException;

/**
 *
 * Class Utils
 *
 * @package Justin
 *
 */
class Utils implements iUtils
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
    public function dateParse($date, $timestamp = true, $type = 0)
    {

        if (is_array($date)) {

            foreach ($date as $key => $item) {

                $date[$key] = $this->parse(

                    $item, $timestamp, $type

                );

            }

        } else {

            $date = $this->parse(

                $date, $timestamp, $type

            );
        }

        return $date;

    }
    /**
     *
     * PARSE
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
    private function parse($date, $timestamp, $type)
    {

        if ($timestamp) {

            $data = strtotime(

                $date

            );

        } else {

            $data = date_parse(

                $date

            );

            if ($data['errors'] || $data['warnings']) {

                throw new JustinUtilsException(

                    'Invalid parse date format. Example format: 2018-09-05T00:00:00'

                );

            }

            if ($type) {

                $format = null;

                $date = strtotime($date);

                switch ($type) {

                    case 1:$format = 'Y-m-d H:i:s';
                        break;
                    case 2:$format = 'Ymd H:i:s';
                        break;
                    case 3:$format = 'd-m-Y H:i:s';
                        break;
                    case 4:$format = 'dmY H:i:s';
                        break;
                    case 5:$format = 'H:i:s';
                        break;

                }

                if ($format) {

                    $data = date(

                        $format, $date

                    );

                }

            }

        }

        return $data;

    }

}
