<?php

namespace Justin\Contracts;

/**
 *
 * Interface iFilter
 *
 * @package Justin
 *
 */
interface iFilter
{
    /**
     *
     * FILTER
     *
     * @param ARRAY $data
     *
     * @return OBJECT
     *
     */
    public function filter($data);
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
    public function limit($limit = 10);
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
    public function name($val);
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
    public function leftValue($val);
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
    public function rightValue($val);
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
    public function equal($val = '');
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
    public function not($val = '');
    /**
     *
     * LESS
     * МЕНЬШЕ ЗНАЧЕНИЕ ПОЛЯ ПО ФИЛЬТРУ
     * МЕНШЕ ЗНАЧЕННЯ ПОЛЯ ПО ФІЛЬТРУ
     *
     * @return OBJECT
     *
     */
    public function less($val = '');
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
    public function more($val = '');
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
    public function in($vals = []);
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
    public function between($vals = []);
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
    public function notIn($vals = []);
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
    public function lessEqual($val = '');
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
    public function moreEqual($val = '');
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
    public function like($val = '');
}
