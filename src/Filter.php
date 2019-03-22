<?php

namespace Justin;

use Justin\Contracts\iFilter;

/**
 *
 * Class Filter
 *
 */
class Filter implements iFilter
{
    /**
     *
     * FILTER
     *
     * @var ARRAY
     *
     */
    protected $filter = [];
    /**
     *
     * LIMIT
     *
     * @var INTEGER
     *
     */
    protected $limit = 15;
    /**
     *
     * FILTER
     *
     * @param ARRAY $data
     *
     * @return OBJECT
     *
     */
    public function filter($data)
    {

        $this->filter = [

            $data,

        ];

        return $this;

    }
    /**
     *
     * GET FILTER
     *
     * @param ARRAY $filter
     *
     * @return ARRAY
     *
     */
    protected function getFilter($filter)
    {

        if ($filter) {

            $this->filter = [

                $filter,

            ];

        }

        return $this->filter;

    }
    /**
     *
     * GET LIMIT
     *
     * @param INTEGER $limit
     *
     * @return INTEGER
     *
     */
    protected function getLimit($limit = 15)
    {

        if ($limit) {

            $this->limit = $limit;

        }

        return $this->limit;

    }
    /**
     *
     * LIMIT
     * ЛИМИТ ПОКАЗА ДАННЫХ
     * ЛІМІТ ПОКАЗУ ДАНИХ
     *
     * @param INTEGER $limit
     *
     * @param OBJECT
     *
     */
    public function limit($limit = 10)
    {

        $this->limit = $limit;

        return $this;

    }
    /**
     *
     * NAME
     * НАЗВАНИЕ ПОЛЯ
     * НАЗВА ПОЛЯ
     *
     * @param STRING $val
     *
     * @return OBJECT
     *
     */
    public function name($val)
    {

        $this->filter[0]['name'] = $val;

        return $this;

    }
    /**
     *
     * LEFT VALUE
     * ЗНАЧЕНИЕ ПОЛЯ ФИЛЬТРА ПО ЛЕВОЙ ГРАНИЦЕ
     * ЗНАЧЕННЯ ПОЛЯ ФІЛЬТРУ ПО ЛІВІЙ ГРАНИЦІ
     *
     * @param STRING $val
     *
     * @return OBJECT
     *
     */
    public function leftValue($val)
    {

        $this->filter[0]['leftValue'] = $val;

        return $this;

    }
    /**
     *
     * RIGHT VALUE
     * ЗНАЧЕНИЕ ПОЛЯ ФИЛЬТРА ПО ПРАВОЙ ГРАНИЦЕ
     * ЗНАЧЕННЯ ПОЛЯ ФІЛЬТРУ ПО ПРАВІЙ ГРАНИЦІ
     *
     * @param STRING $val
     *
     * @return OBJECT
     *
     */
    public function rightValue($val)
    {

        $this->filter[0]['rightValue'] = $val;

        return $this;

    }
    /**
     *
     * EQUAL
     * РАВНЯЕТСЯ ПОЛЮ ПО ФИЛЬТРУ
     * ДОРІВНЮЄ ПОЛЮ ПО ФІЛЬТРУ
     *
     * @param STRING $val
     *
     * @return OBJECT
     *
     */
    public function equal($val = '')
    {

        $this->filter[0]['comparison'] = 'equal';

        if (!$val) {

            return $this;

        }

        return $this
            ->leftValue($val);

    }
    /**
     *
     * NOT
     * НЕ РАВНАЕТСЯ ПОЛЮ ПО ФИЛЬТРУ
     * НІ ДОРІВНЮЄ ПОЛЮ ПО ФІЛЬТРУ
     *
     * @param STRING $val
     *
     * @return OBJECT
     *
     */
    public function not($val = '')
    {

        $this->filter[0]['comparison'] = 'not';

        if (!$val) {

            return $this;

        }

        return $this
            ->leftValue($val);

    }
    /**
     *
     * LESS
     * МЕНЬШЕ ЗНАЧЕНИЕ ПОЛЯ ПО ФИЛЬТРУ
     * МЕНШЕ ЗНАЧЕННЯ ПОЛЯ ПО ФІЛЬТРУ
     *
     * @return OBJECT
     *
     */
    public function less($val = '')
    {

        $this->filter[0]['comparison'] = 'less';

        if (!$val) {

            return $this;

        }

        return $this
            ->leftValue($val);

    }
    /**
     *
     * MORE
     * ВЕРНУТЬ БОЛЬШЕ ЗНАЧЕНИЯ ПОЛЯ ПО ФИЛЬТРУ
     * ПОВЕРНУТИ БІЛЬШЕ ЗНАЧЕННЯ ПОЛЯ ПО ФІЛЬТРУ
     *
     * @param STRING $val
     *
     * @return OBJECT
     *
     */
    public function more($val = '')
    {

        $this->filter[0]['comparison'] = 'more';

        if (!$val) {

            return $this;

        }

        return $this
            ->leftValue($val);

    }
    /**
     *
     * IN
     * ВЕРНУТЬ ЗНАЧЕНИЯ, КОТОРЫЕ В СОСТАВЕ ПОЛЯ ПО ФИЛЬТРУ
     * ПОВЕРНУТИ ЗНАЧЕННЯ, ЯКІ В СКЛАДІ ПОЛЯ ПО ФІЛЬТРУ
     *
     * @param ARRAY $vals
     *
     * @return OBJECT
     *
     */
    public function in($vals = [])
    {

        $this->filter[0]['comparison'] = 'in';

        if (!$vals) {

            return $this;

        }

        return $this
            ->leftValue($vals);

    }
    /**
     *
     * BETWEEN
     * ВЕРНУТЬ ЗНАЧЕНИЯ, КОТОРЫЕ РАВНЯЮТСЯ ГРАНИЦЕ ПОЛЯ ПО ФИЛЬТРУ
     * ПОВЕРНУТИ ЗНАЧЕННЯ, ЯКІ ДОРІВНЮЄ ГРАНИЦІ ПОЛЯ ПО ФІЛЬТРУ
     *
     * @param ARRAY $vals
     *
     * @return OBJECT
     *
     */
    public function between($vals = [])
    {

        $this->filter[0]['comparison'] = 'between';

        if (!$vals) {

            return $this;

        }

        return $this
            ->leftValue($vals[0])
            ->rightValue($vals[1]);

    }
    /**
     *
     * NOT IN
     * ВЕРНУТЬ ЗНАЧЕНИЯ, КОТОРЫХ НЕТ В СОСТАВЕ ПОЛЯ ПО ФИЛЬТРУ
     * ПОВЕРНУТИ ЗНАЧЕННЯ, ЯКИХ НЕМАЄ В СКЛАДІ ПОЛЯ ПО ФІЛЬТРУ
     *
     * @param ARRAY $vals
     *
     * @return OBJECT
     *
     */
    public function notIn($vals = [])
    {

        $this->filter[0]['comparison'] = 'not in';

        if (!$vals) {

            return $this;

        }

        return $this
            ->leftValue($vals);

    }
    /**
     *
     * LESS OR EQUAL
     * ВЕРНУТЬ ЗНАЧЕНИЯ, КОТОРЫЙ МЕНЬШЕ ИЛИ РАВНЯЮТСЯ ПОЛЮ ПО ФИЛЬТРУ
     * ПОВЕРНУТИ ЗНАЧЕННЯ, ЯКІ МЕНШЕ АБО ДОРІВНЮЮТЬ ПОЛЮ ПО ФІЛЬТРУ
     *
     * @param STRING $val
     *
     * @return OBJECT
     *
     */
    public function lessEqual($val = '')
    {

        $this->filter[0]['comparison'] = 'less or equal';

        if (!$val) {

            return $this;

        }

        return $this
            ->leftValue($val);

    }
    /**
     *
     * MORE OR EQUAL
     * ВЕРНУТЬ ЗНАЧЕНИЯ, КОТОРЫЕ БОЛЬШЕ ИЛИ РАВНЯЮТСЯ ПОЛЮ ПО ФИЛЬТРУ
     * ПОВЕРНТИ ЗНАЧЕННЯ, ЯКІ БІЛЬШЕ АБО ДОРІВНЮЮТЬ ПОЛЮ ПО ФІЛЬТРУ
     *
     * @param STRING $val
     *
     * @return OBJECT
     *
     */
    public function moreEqual($val = '')
    {

        $this->filter[0]['comparison'] = 'more or equal';

        if (!$val) {

            return $this;

        }

        return $this->leftValue($val);

    }
    /**
     *
     * LIKE
     * ВЕРНУТЬ ЗНАЧЕНИЯ, КОТОРЫЕ ПОХОЖИ НА ПОЛЕ ПО ФИЛЬТРУ
     * ПОВЕРНУТИ ЗНАЧЕННЯ, ЯКІ СХОЖІ НА ПОЛЕ ПО ФІЛЬТРУ
     *
     * @param STRING $val
     *
     * @return OBJECT
     *
     */
    public function like($val = '')
    {

        $this->filter[0]['comparison'] = 'like';

        if (!$val) {

            return $this;

        }

        return $this
            ->leftValue($val);

    }

}
