<?php

namespace Justin\Exceptions;

/**
 *
 * Class Errors
 *
 * @package Justin
 *
 */
class Errors extends TransferException
{

    /**
     *
     * INIT EXCEPTION
     *
     * @param OBJECT | STRING $message
     *
     */
    public function __construct($message)
    {

        $this->exception = $message;

    }
    /**
     *
     * GET REQUEST DATA
     *
     * @return ARRAY
     *
     */
    public function getRequest()
    {

        return $this->exception->getTrace()[0]['args'];

    }
    /**
     *
     * GET RESPONSE MESSAGE
     *
     * @return STRING
     *
     */
    public function getResponse()
    {

        $error = null;

        if (is_object($this->exception)) {

            $error = $this->exception->message;

        } else {

            $error = $this->exception;

        }

        return $error;

    }

}
