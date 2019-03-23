<?php

namespace Justin;

use Justin\Contracts\iFilter;

/**
 *
 * Class Filter
 *
 * @package Justin
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
     * УКАЗЫВАЕМ ЗНАЧЕНИЕ ПОЛЯ ПО ЛЕВОЙ ГРАНИЦЕ ФИЛЬТРА
     * ВКАЗУЄМО ЗНАЧЕННЯ ПОЛЕ ПО ЛІВІЙ ГРАНИЦІ ФІЛЬТРУ
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
     * УКАЗЫВАЕМ ЗНАЧЕНИЕ ПОЛЯ ПО ПРАВОЙ ГРАНИЦЕ ФИЛЬТРА
     * ВКАЗУЄМО ЗНАЧЕННЯ ПОЛЯ ПО ПРАВІЙ ГРАНИЦІ ФІЛЬТРУ
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
     * ВЕРНУТЬ ЗНАЧЕНИЕ, КОТОРОЕ РАВНЯЕТСЯ ЗНАЧЕНИЮ ПОЛЯ ПО ФИЛЬТРУ
     * ПОВЕРНУТИ ЗНАЧЕННЯ, ЯКЕ ДОРІВНЮЄ ЗНАЧЕННЮ ПОЛЯ ПО ФІЛЬТРУ
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
     * ВЕРНУТЬ ЗНАЧЕНИЯ, КОТОРЫЕ НЕ РАВНЯЮТСЯ ЗНАЧЕНИЮ ПОЛЯ ПО ФИЛЬТРУ
     * ПОВЕРНУТИ ЗНАЧЕННЯ, ЯКІ НЕ ДОРІВНЮЮТЬ ЗНАЧЕННЮ ПОЛЯ ПО ФІЛЬТРУ
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
     * ВЕРНУТЬ ЗНАЧЕНИЯ, КОТОРЫЕ МЕНЬШЕ ЗНАЧЕНИЯ ПОЛЯ ПО ФИЛЬТРУ
     * ПОВЕРНУТИ ЗНАЧЕННЯ, ЯКІ МЕНШЕ ЗНАЧЕННЯ ПОЛЯ ПО ФІЛЬТРУ
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
     * ВЕРНУТЬ ЗНАЧЕНИЯ, КОТОРЫЕ БОЛЬШЕ ЗНАЧЕНИЯ ПОЛЯ ПО ФИЛЬТРУ
     * ПОВЕРНУТИ ЗНАЧЕННЯ, ЯКІ БІЛЬШЕ ЗНАЧЕННЯ ПОЛЯ ПО ФІЛЬТРУ
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
     * ВЕРНУТЬ ЗНАЧЕНИЯ, КОТОРЫЕ ЕСТЬ В СОСТАВЕ СПИСКА ПОЛЕЙ ПО ФИЛЬТРУ
     * ПОВЕРНУТИ ЗНАЧЕННЯ, ЯКІ Є В СКЛАДІ СПИСКУ ПОЛІВ ПО ФІЛЬТРУ
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
     * ВЕРНУТЬ ЗНАЧЕНИЯ, КОТОРЫЕ РАВНЯЮТСЯ ГРАНИЦЕ ЗНАЧЕНИЮ ПОЛЕЙ (leftValue до rightValue) ПО ФИЛЬТРУ
     * ПОВЕРНУТИ ЗНАЧЕННЯ, ЯКІ ДОРІВНЮЄ ГРАНИЦІ ЗНАЧЕННЯМ ПОЛІВ (leftValue до rightValue) ПО ФІЛЬТРУ
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
     * ВЕРНУТЬ ЗНАЧЕНИЯ, КОТОРЫХ НЕТ В СОСТАВЕ СПИСКА ПОЛЕЙ ПО ФИЛЬТРУ
     * ПОВЕРНУТИ ЗНАЧЕННЯ, ЯКИХ НЕМАЄ В СКЛАДІ СПИСКУ ПОЛІВ ПО ФІЛЬТРУ
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
     * ВЕРНУТЬ ЗНАЧЕНИЯ, КОТОРЫЙ МЕНЬШЕ ИЛИ РАВНЯЮТСЯ ЗНАЧЕНИЮ ПОЛЯ ПО ФИЛЬТРУ
     * ПОВЕРНУТИ ЗНАЧЕННЯ, ЯКІ МЕНШЕ АБО ДОРІВНЮЮТЬ ЗНАЧЕННЮ ПОЛЯ ПО ФІЛЬТРУ
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
     * ВЕРНУТЬ ЗНАЧЕНИЯ, КОТОРЫЕ БОЛЬШЕ ИЛИ РАВНЯЮТСЯ ЗНАЧЕНИЮ ПОЛЯ ПО ФИЛЬТРУ
     * ПОВЕРНТИ ЗНАЧЕННЯ, ЯКІ БІЛЬШЕ АБО ДОРІВНЮЮТЬ ЗНАЧЕННЮ ПОЛЯ ПО ФІЛЬТРУ
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
     * ВЕРНУТЬ ЗНАЧЕНИЯ, КОТОРЫЕ ПОХОЖИ НА ЗНАЧЕНИЕ ПОЛЯ ПО ФИЛЬТРУ
     * ПОВЕРНУТИ ЗНАЧЕННЯ, ЯКІ СХОЖІ НА ЗНАЧЕННЯ ПОЛЯ ПО ФІЛЬТРУ
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
