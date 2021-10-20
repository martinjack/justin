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
     * AMOUNT FILTERS
     *
     * @var INTEGER
     *
     */
    protected $amount_filters = 0;
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
     * SET FILTER PARAMS
     *
     * @param ARRAY $data
     *
     * @return OBJECT
     *
     */
    public function setParams($data)
    {
        $params = isset($this->filter['params']) ? $this->filter['params'] : [];

        $this->filter['params'] = array_merge($params, $data);

        return $this;
    }
    /**
     *
     * GET FILTER
     *
     * @param ARRAY $filter
     *
     * @param INTEGER $limit
     *
     * @param BOOLEAN $lang
     *
     * @return ARRAY
     *
     */
    protected function getFilter($filter, $limit = 0, $lang = true)
    {

        if ($lang) {

            $this->filter['language'] = $this->language;

            $this->setParams([

                'language' => $this->language,

            ]);

        }

        if ($filter) {

            $this->filter['filter'] = [

                $filter,

            ];

        }

        if ($limit) {

            $this->filter['TOP'] = $limit;

        }

        return $this->filter;

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
    public function limit($limit = 0)
    {

        $this->filter['TOP'] = $limit;

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

        $this->filter['filter'][$this->amount_filters]['name'] = $val;

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

        $this->filter['filter'][$this->amount_filters]['leftValue'] = $val;

        $this->amount_filters += 1;

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

        $this->filter['filter'][$this->amount_filters]['rightValue'] = $val;

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

        $this->filter['filter'][$this->amount_filters]['comparison'] = 'equal';

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

        $this->filter['filter'][$this->amount_filters]['comparison'] = 'not';

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

        $this->filter['filter'][$this->amount_filters]['comparison'] = 'less';

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

        $this->filter['filter'][$this->amount_filters]['comparison'] = 'more';

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

        $this->filter['filter'][$this->amount_filters]['comparison'] = 'in';

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

        $this->filter['filter'][$this->amount_filters]['comparison'] = 'between';

        if (!$vals) {

            return $this;

        }

        return $this
            ->leftValue($vals[$this->amount_filters])
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

        $this->filter['filter'][$this->amount_filters]['comparison'] = 'not in';

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

        $this->filter['filter'][$this->amount_filters]['comparison'] = 'less or equal';

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

        $this->filter['filter'][$this->amount_filters]['comparison'] = 'more or equal';

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

        $this->filter['filter'][$this->amount_filters]['comparison'] = 'like';

        if (!$val) {

            return $this;

        }

        return $this
            ->leftValue($val);

    }

}
