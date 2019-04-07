<?php

namespace Justin\Exceptions;

/**
 *
 * Class Errors
 *
 * @package Justin\Exceptions
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

        if (method_exists($this->exception, 'getTrace')) {

            return $this->exception->getTrace()[0]['args'];

        }

        return null;

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

            if (property_exists($this->exception, 'exception')) {

                $error = $this->exception->exception;

            } elseif (property_exists($this->exception, 'message')) {

                $error = $this->exception->message;

            }

        } else {

            $error = $this->exception;

        }

        return $error;

    }

}
